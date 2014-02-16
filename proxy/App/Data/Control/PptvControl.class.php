<?php
/**
 * PPTV采集控制器
 */
class PptvControl extends CommonControl{
	/**
	 * 默认执行
	 */
	public function index(){
		header ( 'Content-type:text/xml;charset:utf-8;filename:PPTV代理.xml' ); // 定义文件头
		echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n"; // 输出XML格式
		if ( $id = Q ( "get.id" )) {
			$xml = $this->cache_collect("pptv_" . $id);
			if ($xml != 1 && !$xml) {
				echo $xml;
			}else{
				$xml = $this->listpage($id);
				$xml = $xml["xml"];
				$this->cache_collect($id, 1, $xml, "pptv_");
				echo $xml;
			}
		} elseif ( Q ( "get.vname" ) ) {
			$vName = $this->listpage ( Q ( "get.vname" ) );
			echo $vName["vName"];
		} else {
			$url = file_data ( 'http://dianshiju.cntv.cn/list/all/index.shtml');
			$preg = '/<h3><a title=".*" href="(.*)" target = "_blank">.*<\/a><\/h3>/iUs';
			preg_match_all ( $preg, $url, $arr );
			foreach ( $arr [1] as $value ) {
				$xml .= $this->listpage ( $value )["xml_m"];
			}
			echo "<list>\n" . $xml . '</list>';
		}
	}
	/**
	 * 生成列表
	 * @param  string $id 视频ID
	 * @return array     视频列表及视频名称
	 */
	public function listpage($id){
		$referer = "http://player.pplive.cn/ikan/1.0.5.26/player4player2.swf";
		$user_agent = Q("server.HTTP_USER_AGENT");
		$purl = "http://api.v.pptv.com/api/openapi/player.open.json?id=" . $id . "&from=0&version=";
		$json = json_decode(file_data($purl, array(), 0, "", $referer, $user_agent));
		$ppid = $json->data->pptv->id;
		$vName = $json->data->pptv->title;
		$ppurl = "http://client-play.pplive.cn/chplay3-0-" . $ppid . ".xml";
		$ppstr = file_data($ppurl, array(), 0, "", $referer, $user_agent);
		$xml = simplexml_load_string($ppstr);
		$rid = $xml->channel[rid];
		$sh = $xml->uh;
		$iurl = "http://" . $sh . ":81/" .$rid;
		$xml .= '<m type="2" src="' . $iurl . '" label="' . $vName . "\" />\n";
		return array(
			"xml" => "<list>\n" . $xml . "</list>",
			"vName" => $vName
		);
	}
}
?>