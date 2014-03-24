<?php
/**
 * 爱奇艺采集控制器
 */
class IqiyiControl extends CommonControl {
	/**
	 * 默认执行
	 */
	public function index() {
		header ( "Content-type:text/xml;charset:utf-8;filename:爱奇艺代理.xml" ); // 定义文件头
		echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n"; // 输出XML格式
		if ( $id = Q ("get.id")) {
			$xml = $this->cache_collect("iqiyi_" . $id);
			if ($xml != 1 && $xml) {
				echo $xml;
			}else{
				$xml = $this->listpage($id);
				$xml = $xml["xml"];
				if ($cachetime = Q("get.cachetime", null, "intval")){
					$this->cache_collect($id, 1, $xml, "iqiyi_", "file", $cachetime, ROOT_PATH . "Cache/Auto");
				} else {
					$this->cache_collect($id, 1, $xml, "iqiyi_");
				}
				echo $xml;
			}
		} elseif (Q( "get.page" )) { // 是否向地址栏传递PAGE参数
			$url = file_data ( "http://list.iqiyi.com/www/2/------------2-1-" . Q( "get.page" ) . "-1---.html" ); // 采集奇艺电视剧页面
			preg_match_all ( '/<a\s+href="(.+)" class="title">.*<\/a>/iUs', $url, $arr ); // 正则表达式
			foreach ( $arr [1] as $value ) { // 循环输出剧集XML列表
				$xml = $this->listpage ( $value );
				echo $xml["xml"];
			}
		} elseif (Q( "get.vname" )) {
			$vName = $this->listpage ( Q( "get.vname" ) );
			echo $vName["vName"];
		} else { // 没有向地址栏进行传递参数
			$lists = "";
			for($i = 1; $i <= 10; $i ++) { // 循环输出奇艺电视剧排行
				$lists .= "<m list_src=" . U( "Data/Iqiyi/index", array( "page" => $i ) ) . '" label="奇艺电视剧 第' . $i . "页\" />\n";
			}
			echo "<list>\n" . $lists . "</list>";
		}
	}
	/**
	 * 生成列表
	 * @param string $id 视频ID
	 * @param int $type 是否使用插件，0为使用，1为不使用
	 * @return array 视频列表及视频名称
	 */
	public function listpage($aid, $type = 1) {
		$interface = file_data ( 'http://dispatcher.video.qiyi.com/mini/pl/' . $aid . '/' ); // 采集接口
		$interface = substr ( $interface, 13 ); // 获取JSON
		$obj = json_decode ( $interface ); // JSON解码
		$data = $obj->data; // 获取视频内容数组
		$vName = preg_replace("/(.*)\s?第\d+集/iUs", "\\1", $data[0]->title);
		$xml = "";
		foreach ( $data as $value ) { // 遍历数组
			$vid = $value->videoId; // 获取单个视频ID
			$title = $value->title; // 获取单个视频名称
			$tvid = $value->tvId;
			if ($type) {
				$xml .= '<m type="" src="' . $this->single($tvid) . '&start={start_bytes}" stream="true" label="' . $title . "\" />\n";
			} else {
				$xml .= '<m type="qiyi" src="http://cache.video.qiyi.com/v/' . $vid . '" label="' . $title . "\" />\n"; // 写入XML内容
			}
		}
		return array("xml" => "<list>\n" . $xml . '</list>', "lists" => $xml, "vName" => $vName); // 输出剧集头和剧集列表
	}
	/**
	 * 无插件单集列表
	 * @param string $id 视频ID
	 * @return string $c 视频URL
	 */
	public function single($vid){
		$interface = file_data('http://cache.m.iqiyi.com/jp/qmt/' . $vid . '/');
		preg_match_all('/m4u":"([^"]+)","vd":1,/iUs', $interface, $arr);
		foreach ($arr[1] as $value){
			$v1 = file_data('' . $value . '');
			preg_match('/l":"([^"]+)","t/iUs', $v1, $v2);
			$c = $v2[1];
		}
		return $c;
	}
}
?>