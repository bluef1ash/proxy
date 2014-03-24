<?php
/**
 * 城通采集控制器
 */
class ChengtongControl extends CommonControl {
	/**
	 * 默认执行
	 */
	public function index() {
		header ( 'Content-type:text/xml;charset:utf-8;filename:城通网盘代理.xml' ); // 定义文件头
		echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n"; // 输出XML格式
		if ( $id = Q("get.id", null, "intval") ) {
			$xml = $this->cache_collect("chengtong_" . $id);
			if ($xml != 1 && $xml) {
				echo $xml;
			}else{
				$xml = $this->listpage ( $id );
				$xml = $xml["xml"];
				if ($cachetime = Q("get.cachetime", null, "intval")){
					$this->cache_collect($id, 1, $xml, "chengtong_", "file", $cachetime, ROOT_PATH . "Cache/Auto");
				} else {
					$this->cache_collect($id, 1, $xml, "chengtong_", 3600);
				}
				echo $xml;
			}
		} elseif ( Q("get.vname") ) {
			$vName = $this->listpage ( Q("get.vname") );
			echo $vName["vName"];
		}
	}
	/**
	 * 获得列表
	 * @param int $id ID号
	 * @return string 返回列表
	 */
	public function listpage($id){
		$page = file_data('http://www.400gb.com/file/' . $id);
		preg_match('/<a class="btn btn-purple" target="_blank" href="(.*)">在线播放<\/a>/iUs', $page, $arr);
		$play = file_data('http://www.400gb.com' . $arr[1]);
		preg_match('/<h1>(.*)<small>.*<\/small><\/h1>.*file: "(.*)",/iUs', $play, $arr);
		$vName = preg_replace('/(?:\.flv)|(?:\.mp4)/iUs', "", $arr[1]);
		$xml = '<m type="2" src="' . $arr[2] . '&start={start_bytes}" stream="true" label="' . $vName . "\" />\n";
		return array("xml" => "<list>\n" . $xml . "</list>", "vName" => $vName);
	}
}
?>