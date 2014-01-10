<?php
class CntvControl extends Control{
	/**
	 * 默认执行
	 * @return [type] [description]
	 */
	public function index(){
		header ( 'Content-type:text/xml;charset:utf-8;filename:CNTV代理.xml' ); // 定义文件头
		echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n"; // 输出XML格式
		if ( $this->_GET ('id')) {
			$id = $this->_get("id");
			echo $this->listpage($id)["xml"];
		} elseif ( $this->_GET ('vname') ) {
			echo $this->listpage ( $this->_GET ('vname') )["vName"];
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
	 * 合并列表
	 * @param  string $id 单个影片ID
	 * @return [type]     [description]
	 */
	public function merge($id = ""){
		if (IS_GET)
			$id = $this->_get("id");
		$page = file_data("http://vdn.apps.cntv.cn/api/getHttpVideoInfo.do?pid=".$id);
		$obj = json_decode($page);
		$vName = $obj->title;
		$video = $obj->video->chapters;
		$i = 0;
		$xml = '<m starttype="0" label="" type="" bytes="" duration="" bg_video="">'."\n";
		foreach ($video as $value){
			$i++;
			$xml.= '<u bytes="" duration="'.$value->duration.'" src="'.$value->url.'?start={start_bytes}" label="'.$i."\" />\n";
		}
		$xml .= '</m>';
		if ($title)
			return $vName;
		header ( 'Content-type:text/xml;charset:utf-8;filename:CNTV代理.xml' ); // 定义文件头
		echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n".$xml;
	}
	/**
	 * 制作列表
	 * @param  string $id 视频ID
	 * @return array     视频列表及视频名称
	 */
	public function listpage($id){
		if (strpos($id, "http://")>-1){
			$page = file_data($id);
			preg_match('/var commentTitle = "(.*)"; \/\/评论标题.*<div\s*id="dsj_lanmu"><ul>(.*)<div class="vspace"><\/div>/iUs', $page, $arr);
			$vName = $arr[1];
			preg_match_all('/<div class="text"><A href="(.*)">(.*)<\/A><\/div>/iUs', $arr[2], $arr);
			$xml = "";
			$combine = array_combine($arr[1], $arr[2]);
			foreach ($combine as $key=>$value){
				$page = file_data($key);
				preg_match('/videoId:"([0-9a-z]+)",/iUs', $page, $ar);
				$xml .= '<m type="merge" src="'.U("merge",array("id"=>$ar[1])).'" label="'.$value."\" />\n";
			}
		}else {
			$vName = $this->merge($id);
			$xml = '<m type="merge" src="'.U("merge",array("id"=>$id)).'" label="'.$vName."\" />\n";
		}
		return array("xml"=>"<list>\n".$xml."</list>","vName"=>$vName);
	}
}
?>