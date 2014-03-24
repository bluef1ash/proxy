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
				if (strlen($id) == 9 || strlen($id) == 5) {
					$page = file_data ( 'http://www.letv.com/tv/' . $id . '.html' );
					preg_match ( '/<div class="showPic" data-itemhldr="a" data-statectn="n_showPic">.*<a href="http:\/\/www\.letv\.com\/ptv\/vplay\/(\d+)\.html" title=".*" target="_blank">.*<div class="play"><span class="s-p">立即观看<\/span><span class="s-d"><\/span>/iUs', $page, $arr );
					$id = $arr [1];
				}
				$xml = $this->listpage ( $id );
				$xml = $xml["xml"];
				if ($cachetime = Q("get.cachetime", null, "intval")){
					$this->cache_collect($id, 1, $xml, "letv_", "file", $cachetime, ROOT_PATH . "Cache/Auto");
				} else {
					$this->cache_collect($id, 1, $xml, "letv_");
				}
				echo $xml;
			}
		} elseif ( Q("get.vname") ) {
			$vName = $this->listpage ( Q("get.vname") );
			echo $vName["vName"];
		} else {
			$url = file_data ( 'http://top.letv.com/tvhp.html', true );
			$preg = '/<span class="s2"><a href="(http:\/\/so.letv.com\/tv\/\d+.html)" title=".*" target="_blank">(.*)<\/a><\/span>/iUs';
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
	 * @param string $id 视频ID
	 * @return array 视频列表及视频名称
	 */
	public function listpage($id, $name = "") {
		$page = file_data ( 'http://www.letv.com/ptv/vplay/' . $id . '.html' );
		preg_match('/<!-- 剧集列表 start -->.*<script type="text\/javascript">var\s+\w+\s*=\s*(.*)\s*;<\/script>/iUs', $page, $arr);
		$json = json_decode ( $arr[1] );
		$vName = $name;
		$xml = "";
		/*$articulation = array(
			"350" => "极速",
			"1000" => "标清",
			"1300" => "高清",
			"720p" => "超清",
			"1080p" => "1080p"
		);*/
		$stime = 'http://api.letv.com/time?tn=0.' . time();
    	$str = file_data($stime);
    	$obj = json_decode($str);
    	$t = $obj->stime;
		for($a, $i = 0; $i < 8; $i++){
	        $a = 1 & $t;
	        $t >>= 1;
	        $a <<= 31;
	        $t += $a;
        }
        $key = $t^185025305;
		foreach ($json as $value) {
			$vid = $value->vid;
			$interface = file_data('http://api.letv.com/mms/out/video/play?id=' . $vid . '&platid=1&splatid=101&domain=http://www.letv.com&tkey=' . $key);
			preg_match('/<playurl><!\[cdata\[(.*)\]\]><\/playurl>/iUs', $interface, $data);
			$json = json_decode($data[1]);
			$name = $json->title;
			$dispatch = $json->dispatch;
			$flv = array();
			foreach ($dispatch as $k => $v) {
				$flv[$k] = str_replace("tss=ios", "tss=no", $v[0]) . "&";
			}
			$xml .= '<m type="" src="' . $flv["1000"] . 'start={start_bytes}" stream="true" label="' . $name . "\" />\n";
		}
		return array("xml" => "<list>\n" . $xml . '</list>', "lists" => $xml, "vName" => $vName);
	}
}
?>