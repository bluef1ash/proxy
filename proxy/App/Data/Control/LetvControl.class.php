<?php
/**
 * 乐视采集控制器
 */
class LetvControl extends CommonControl {
	/**
	 * 默认执行
	 */
	public function index() {
		header ( 'Content-type:text/xml;charset:utf-8;filename:乐视代理.xml' ); // 定义文件头
		echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n"; // 输出XML格式
		if ( $id = Q("get.id", null, "intval") ) {
			$xml = $this->cache_collect("letv_" . $id);
			if ($xml != 1 && $xml) {
				echo $xml;
			}else{
				$vip = 0;
				if (preg_match("/^\d{5}$/iUs", $id)) {
					$pid = $id;
				}elseif (preg_match("/^\d{7}$/iUs", $id)) {
					$page = file_data("http://www.letv.com/ptv/vplay/" . $id . ".html");
					preg_match ( "/pid\s*:\s*(?:'|\")?(\d{4,6})(?:'|\")?\s*(?:,|(?:,\/\/专辑ID)|(?:\/\/专辑ID))/iUs", $page, $arr );
					$pid = $arr[1];
					if (preg_match("/vid\s*:\s*(\d{7}),\s*\/\/视频ID.*trylook:[1-9]\d*,\/\/十分钟试看/iUs", $page, $arr))
						$vip = $arr[1];
				}
				$xml = $this->listpage ( $pid, $vip )["xml"];
				$this->cache_collect($id, 1, $xml, "letv_");
				echo $xml;
			}
		} elseif ( Q("get.vname") ) {
			echo $this->listpage ( Q("get.vname") )["vName"];
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
	 * @return array 视频列表及视频名称
	 */
	public function listpage($id, $vip = 0) {
		$json = file_data ( 'http://hot.vrs.letv.com/vlist?f=1&p=1&m=12&pid=' . $id );
		$json = json_decode ( strtr($json, "\t", ' ')  );
		$videoInfo = $json->videoInfo;
		$vName = $json->title;
		$xml = "";
		if ($vip){
			$v = json_encode( array( "vid" => $vip ) );
			array_unshift($videoInfo, json_decode( $v ));
		}
		foreach ( $videoInfo as $value ) {
			$vid = $value->vid;
			$interface = 'http://app.letv.com/v.php?id=' . $vid;
			$interface = file_data ( $interface );
			$src = preg_match ( '/<tal><!\[CDATA\[(.*)\]\]><\/tal>.*"storeuri":"(.*)"/iUs', $interface, $arr );
			$name = $arr[1]; // 视频名称
			$src = str_replace ( "\/", "/", $arr [2] );
			$flv = 'http://g3.letv.cn/' . $src;
			$xml .= '<m type="" src="' . $flv . '?start={start_bytes}" stream="true" label="' . $name . "\" />\n";
		}
		return array("xml"=>"<list>\n" . $xml . '</list>',"vName"=>$vName);
	}
}
?>