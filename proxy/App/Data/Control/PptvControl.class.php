<?php
class PptvControl extends Control{
	/**
	 * 默认执行
	 * @return [type] [description]
	 */
	public function index(){
		header ( 'Content-type:text/xml;charset:utf-8;filename:PPTV代理.xml' ); // 定义文件头
		echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n"; // 输出XML格式 
		if (IS_GET) { // 是否向地址栏进行传参
			if ( $this->_GET ('id')) {
				$id = $this->_get("id");
// 				if (preg_match("/^\d{4,8}$/iUs", $id)){
// 					echo $this->listpage ( $id )["xml"];
// 				}else {
					echo $this->one($id)["xml"];
// 				}
			} elseif ( $this->_GET ('vname') ) {
				echo $this->listpage ( $this->_GET ('vname') )["vName"];
			} else {
				echo "<list>\n<m type='' src='' label='参数错误' /></list>";
			}
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
	 * 生成单个视频列表
	 * @param  string $id 视频ID
	 * @return array     视频列表及视频名称
	 */
	public function one($id){;
		return array(
			"xml" => "<list>\n".'<m type="video" src="proxy:cdn,'.U("proxy").",".U("proxy",array("vid"=>$id)).'" label="'."\" />\n",
			"xml_m" => '<m type="video" src="proxy:cdn,'.U("proxy").",".U("proxy",array("vid"=>$id)).'" label="'."\" />\n",
		);
	}
	/**
	 * 生成列表
	 * @param  string $id 视频ID
	 * @return array     视频列表及视频名称
	 */
	public function listpage($id){
		$page = file_data("http://www.pptv.com/page/".$id.".html");
		preg_match('/<span class="crumb_current">.*\s*(.*)\s*<\/span>/iUs', $page, $ar);
		preg_match_all('<span class="txt"><a  start_time=".*" href="http:\/\/v\.pptv\.com\/show\/(\w+)\.html" title="(.*)" target="_play">.*<\/a><\/span>', $page, $arr);
		$xml = "";
		foreach ($arr[1] as $value){
			$xml .= $this->one($value)["xml_m"];
		}
		return array(
			"xml" => $xml,
			"vName" => $ar[1]
		);
	}
	/**
	 * 单个视频代理
	 * @return string 返回XML数据
	 */
	public function proxy(){
		header("Content-type:text/xml;charset=utf-8");
		if($this->_GET['vid']){
			$this->pptv_vid($this->_GET['vid']);
		}elseif($_REQUEST['data']){
			$this->pptv_data($_REQUEST['data']);
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
		echo  'http://'.$ip.':81/'.$rid;
	}
	/**
	 * 找到XML数据
	 * @param  string $vid 视频VID
	 * @return [type]      [description]
	 */
	private function pptv_vid($vid){
		if(!is_numeric($vid)){
			$vid=json_decode(file_data('http://api.v.pptv.com/api/openapi/player.open.json?id='.$vid.'&from=0&version='))->data->pptv->id;
		}
		$xmlUrl='http://client-play.pplive.cn/chplay3-0-'.$vid.'.xml';
		header("location:".$xmlUrl);
	}
}
?>