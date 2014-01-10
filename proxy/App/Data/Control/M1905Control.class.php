<?php
class M1905Control extends Control{
	/**
	 * 默认执行
	 * @return [type] [description]
	 */
	public function index(){
		header ( 'Content-type:text/xml;charset:utf-8;filename:M1905电影网代理.xml' ); // 定义文件头
		echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n"; // 输出XML格式
		if ( $this->_GET ('id')) {
			echo $this->listpage ( $this->_GET ('id') )["xml"];
		} elseif ( $this->_GET ('vname') ) {
			echo $this->listpage ( $this->_GET ('vname') )["vName"];
		} else {
			$url = file_data ( 'http://www.m1905.com/vod/rank/t0a99o3.shtml');
			$preg = '/<dt class="li03 oh"><a href="http:\/\/www.m1905.com\/vod\/info\/(\d{4,8})\.shtml" target="_blank" title=".*" class=" pl28">.*<\/a><\/dt>/iUs';
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
		$url = file_data("http://www.m1905.com/vod/play/".$id.".shtml");
		preg_match("/title\s*:\s*'(.*)',.*iosurl\s*:\s*'(.*)',/iUs", $url, $arr);
		$flv = str_replace("m3u8", "flv", base64_decode($arr[2])); //这行删除就是mu38的视频。
		$xml = '<m type="" src="http://flv1.vodfile.m1905.com/movie'.$flv.'?start={start_bytes}" stream="true" label="'.$arr[1]."\" />\n";
		return array("xml"=>"<list>\n".$xml."</list>","xml_m"=>$xml,"vName"=>$arr[1]);
	}
}
?>