<?php
/**
 * 音悦台采集控制器
 */
class YinyuetaiControl extends CommonControl {
	/**
	 * 默认执行
	 */
	public function index() {
		header ( 'Content-type:text/xml;charset:utf-8;filename:音悦台代理.xml' ); // 定义文件头
		echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n"; // 输出XML格式
		if ($id = Q ( "get.id" )) {
			$xml = $this->cache_collect("yinyuetai_" . $id);
			if ($xml != 1 && !$xml) {
				echo $xml;
			}else{
				$xml = $this->listpage($id);
				$xml = $xml["xml"];
				$this->cache_collect($id, 1, $xml, "yinyuetai_");
				echo $xml;
			}
		} elseif (Q ( "get.vname" )) {
			$vName = $this->listpage ( Q ( "get.vname" ) );
			echo $vName["vName"];
		} else {
			$xml = "";
			for($i = 1; $i <= 3; $i ++) {
				$url = file_data ( 'http://mv.yinyuetai.com/all?pageType=page&page=' . $i . '&tab=allmv&parenttab=mv&sort=weekViews' );
				$preg = '/<div class="thumb thumb_mv">.*<a href="http:\/\/v\.yinyuetai\.com\/video\/(\d+)" target="_blank">/iUs';
				preg_match_all ( $preg, $url, $arr );
				foreach ( $arr [1] as $value ) {
					$xml .= $this->listpage ( $value )["xmlm"];
				}
			}
			echo "<list>\n" . $xml . '</list>';
		}
	}
	/**
	 * 生成列表
	 * @param  string $id 视频ID
	 * @return array     视频列表及视频名称
	 */
	public function listpage($id) {
		$page = file_data ( "http://v.yinyuetai.com/video/" . $id );
		preg_match ( "/hcvideoUrl.*'(http:\/\/.*\.flv\?sc=\w+)&.*',/iUs", $page, $arr );
		preg_match ( '/title\s*:\s*"(.*)",/iUs', $page, $ar );
		$vName = explode ( " ", $ar [1] )[0];
		$xml = "<m type=\"\" src=\"" . $arr [1] . "\" stream=\"true\" label='" . $vName . "' />\n";
		return array (
			"xmlm" => $xml,
			"xml" => "<list>\n" . $xml . '</list>',
			"vName" => $vName
		);
	}
}
?>