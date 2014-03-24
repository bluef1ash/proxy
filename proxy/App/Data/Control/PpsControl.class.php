<?php
/**
 * PPS采集控制器
 */
class PpsControl extends CommonControl {
	/**
	 * 默认执行
	 */
	public function index() {
		header ( "Content-type:text/xml;charset:utf-8;filename:PPS代理.xml" ); // 定义文件头
		echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n"; // 输出XML格式
		if ( $id = Q ( "get.id" )) {
			$xml = $this->cache_collect("pps_" . $id);
			if ($xml != 1 && $xml) {
				echo $xml;
			}else{
				$xml = $this->listpage($id);
				$xml = $xml["xml"];
				if ($cachetime = Q("get.cachetime", null, "intval")){
					$this->cache_collect($id, 1, $xml, "pps_", "file", $cachetime, ROOT_PATH . "Cache/Auto");
				} else {
					$this->cache_collect($id, 1, $xml, "pps_");
				}
				echo $xml;
			}
		} elseif (Q ( "get.page" )) { // 是否向地址栏传递PAGE参数
			$url = file_data ( 'http://v.pps.tv/v_list/c_tv_p_' . Q ( "get.page" ) . '.html' ); // 采集奇艺电视剧页面
			preg_match_all ( '/<a target="_blank" title="(.*)" href="(.*)">.*<\/a>/iUs', $url, $arr ); // 正则表达式
			foreach ( $arr [1] as $value ) { // 循环输出剧集XML列表
				foreach ( $arr [2] as $v ) {
					$lists = $this->listpage ( $v );
					$xml .= "<m label=\"" . $value . "\">\n" . $lists["xml"] . "</m>\n";
				}
			}
			echo "<list>\n" . $xml . '<list>';
		} elseif (Q ( "get.vname" )) {
			$vName = $this->listpage ( Q ( "get.vname" ));
			echo $vName["vName"];
		} else { // 没有向地址栏进行传递参数
			for($i = 1; $i <= 10; $i ++) {
				$lists .= '<m list_src=\"' . U( "Data/Pps/index", array( "page" => $i ) ) . '" label="PPS电视剧 第' . $i . "页\" />\n";
			}
			echo "<list>\n" . $lists . '</list>';
		}
	}
	/**
	 * 生成单个列表
	 * @param  string $id 视频ID
	 * @return array     视频列表及视频名称
	 */
	public function single($sid) {
		$interface = file_data ( 'http://dp.ugc.pps.tv/get_play_url_cdn.php?sid=' . $sid . '&flash_type=1' );
		preg_match ( '/(.*)\?hd=\d+&all=\d+&title=(.*)&vtypeid/iUs', $interface, $arr );
		$vName = $arr [2];
		if (strpos($arr[1], ".pfv") > -1) {
			$src = $arr[1] . "?";
		} else {
			$json = json_decode(file_data($arr[1]));
			$tvid = $json->tvid;
			$src = A("Data/Iqiyi/single", array($tvid)) . "&";
		}
		$xml = '<m type="" src="' . $src . 'start={start_bytes}" stream="true" label="' . $vName . "\" />\n";
		return array("xml" => $xml,"vName" => $vName);
	}
	/**
	 * 生成列表
	 * @param  string $id 视频ID
	 * @return array 视频列表及视频名称
	 */
	public function listpage($id) {
		if (preg_match("/^\d+$/iUs", $id)){
			$interface = file_data ( 'http://v.pps.tv/ugc/ajax/aj_newlongvideo.php?sid=' . $id . '&type=splay' );
			$obj = json_decode ( $interface );
			$content = $obj->content[0];
			$xml = "";
			foreach ($content as $value){
				//$d_echo = $value->d_echo;
				if (!empty($value->url_key)){
					$vName = $content[0]->title;
					$lists = $this->single ( $value->url_key );
					$xml .= $lists["xml"];
				}else{
					//echo $value[0]->title;
					preg_match("/.*?-(.*?)/iUs", $value[0]->title, $arr);
					$vName = $arr[1];
					foreach ($value as $v){
						$lists = $this->single ( $v->url_key );
						$xml .= $lists["xml"];
					}
				}
			}
		}else {
			$interface = $this->single($id);
			$xml = $interface["xml"];
			$vName = $interface["vName"];
		}
		return array("xml" => "<list>\n" . $xml . '</list>', "lists" => $xml, "vName"=>$vName);
	}
}
?>