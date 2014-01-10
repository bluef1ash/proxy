<?php
class LetvControl extends Control {
	/**
	 * 默认执行
	 * @return [type] [description]
	 */
	public function index() {
		header ( 'Content-type:text/xml;charset:utf-8;filename:乐视代理.xml' ); // 定义文件头
		echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n"; // 输出XML格式
		$fname = 'http://' . $_SERVER ["SERVER_NAME"] . $_SERVER ["PHP_SELF"]; // 文件HTTP完整路径
		if ( $this->_GET ('id')) {
			echo $this->listpage ( $this->_GET ('id') )["xml"];
		} elseif ( $this->_GET ('vname') ) {
			echo $this->listpage ( $this->_GET ('vname') )["vName"];
		} else {
			$url = file_data ( 'http://top.letv.com/tvhp.html', true );
			$preg = '/<span class="s2"><a href="(http:\/\/so.letv.com\/tv\/\d+.html)" title=".*" target="_blank">(.*)<\/a><\/span>/iUs';
			preg_match_all ( $preg, $url, $arr );
			foreach ( $arr [1] as $value ) {
				$xml .= $this->listpage ( $value );
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
		$json = file_data ( 'http://hot.vrs.letv.com/vlist?f=1&p=1&m=12&pid=' . $id );
		$json = json_decode ( strtr($json, "\t", ' ')  );
		$videoInfo = $json->videoInfo;
		$vName = preg_replace("/(.*)\s*\d{2,4}/iUs", "\\1", $videoInfo[0]->name);
		$xml = "";
		foreach ( $videoInfo as $value ) {
			$vid = $value->vid;
			$name = $value->name; // 视频名称
			$interface = 'http://app.letv.com/v.php?id=' . $vid;
			$interface = file_data ( $interface );
			$src = preg_match ( '/"storeuri":"(.*)"/iUs', $interface, $arr );
			$src = str_replace ( "\/", "/", $arr [1] );
			$flv = 'http://g3.letv.cn/' . $src;
			$xml .= '<m type="" src="' . $flv . '?start={start_bytes}" stream="true" label="' . $name . "\" />\n";
		}
		return array("xml"=>"<list>\n" . $xml . '</list>',"vName"=>$vName);
	}
}
?>