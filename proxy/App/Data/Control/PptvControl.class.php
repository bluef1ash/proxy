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
				if ($cachetime = Q("get.cachetime", null, "intval")){
					$this->cache_collect($id, 1, $xml, "pptv_", "file", $cachetime, ROOT_PATH . "Cache/Auto");
				} else {
					$this->cache_collect($id, 1, $xml, "pptv_");
				}
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
		if (preg_match("/^\d{4,8}$/iUs", $id)){
			$page = file_data("http://www.pptv.com/page/".$id.".html");
			preg_match('/<span class="crumb_current">.*\s*(.*)\s*<\/span>/iUs', $page, $ar);
			preg_match_all('<span class="txt"><a  start_time=".*" href="http:\/\/v\.pptv\.com\/show\/(\w+)\.html" title="(.*)" target="_play">.*<\/a><\/span>', $page, $arr);
			$xml = "";
			foreach ($arr[1] as $value){
				$xml .= $this->one($value)["xml_m"];
			}
			$vName = $ar[1];
		}else {
			$page = file_data("http://v.pptv.com/show/" . $id . ".html");
			preg_match("/var webcfg\s*=\s*(.*)\n*<\/script>/iUs", $page, $arr);
			p($arr);
			$vName = json_decode($arr[1])->title;
			$xml = '<m type="video" src="proxy:cdn,'.U("Data/Pptv/proxy").",".U("Data/Pptv/proxy", array("vid"=>$id)).'" label="'."\" />\n";
		}
		return array("xml" => "<list>\n" . $xml . "</list>", "lists" => $xml, "vName" => $vName);
	}
	/**
	 * 单个视频代理
	 * @return string 返回XML数据
	 */
	public function proxy(){
		header("Content-type:text/xml;charset=utf-8");
		if(Q("get.vid")){
			$this->pptv_vid(Q("get.vid"));
		}elseif(Q("data")){
			$this->pptv_data(Q("data"));
		}
	}
	/**
	 * 解析IP地址
	 * @param  string $data XML数据
	 * @return [type]       [description]
	 */
	private function pptv_data($data){
		$obj=simplexml_load_string($data);
		$rid=(string) $obj->channel[rid];
		$ip=(string)  $obj->dt->sh;
		$rid=strtr($rid,array('%'=>'__'));
		echo 'http://'.$ip.':81/'.$rid;
	}
	/**
	 * 找到XML数据
	 * @param  string $vid 视频VID
	 * @return [type]      [description]
	 */
	private function pptv_vid($vid){
		if(!is_numeric($vid))
			$vid=json_decode(file_data('http://api.v.pptv.com/api/openapi/player.open.json?id='.$vid.'&from=0&version='))->data->pptv->id;
		$xmlUrl='http://client-play.pplive.cn/chplay3-0-'.$vid.'.xml';
		header("location:".$xmlUrl);
	}
}
?>