<?php
/**
 * M1905电影网采集控制器
 */
class M1905Control extends CommomControl{
	/**
	 * 默认执行
	 */
	public function index(){
		header ( 'Content-type:text/xml;charset:utf-8;filename:M1905电影网代理.xml' ); // 定义文件头
		echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n"; // 输出XML格式
		if ( $id = Q ( "get.id" )) {
			$xml = $this->cache_collect("m1905_" . $id);
			if ($xml != 1 && !$xml) {
				echo $xml;
			}else{
				$xml = $this->listpage($id);
				$xml = $xml["xml"];
				$this->cache_collect($id, 1, $xml, "m1905_");
				echo $xml;
			}
		} elseif ( Q ( "get.vname" ) ) {
			$vName = $this->listpage ( Q ( "get.vname" ) );
			echo $vName["vName"];
		} else {
			$url = file_data ( 'http://www.m1905.com/vod/rank/t0a99o3.shtml');
			$preg = '/<dt class="li03 oh"><a href="http:\/\/www.m1905.com\/vod\/info\/(\d{4,8})\.shtml" target="_blank" title=".*" class=" pl28">.*<\/a><\/dt>/iUs';
			preg_match_all ( $preg, $url, $arr );
			$xml = "";
			foreach ( $arr [1] as $value ) {
				$lists = $this->listpage ( $value );
				$xml .= $lists["xml_m"];
			}
			echo "<list>\n" . $xml . '</list>';
		}
	}
	/**
	 * 生成列表
	 * @param  string $id 视频ID
	 * @return array 视频列表及视频名称
	 */
	public function listpage($id){
		$t_id = array(
			substr($id, 0, 1),
			substr($id, 1, 1)
		);
		$url = "http://static.m1905.com/profile/vod/" . $t_id[0] . "/" . $t_id[1] . "/" . $id  . "_1.xml";
		$page = file_data($url);
		preg_match('/<playlist.*title="(.*)".*<item.*url="(.*)".*<\/playlist>/iUs', $page, $arr);
		$xml = '<m type="" src="' . $arr[2] . '?start={start_seconds}" stream="true" label="' . $arr[1] . "\" />\n";
		return array("xml" => "<list>\n" . $xml . "</list>", "xml_m" => $xml, "vName" => $arr[1]);
	}
}
?>