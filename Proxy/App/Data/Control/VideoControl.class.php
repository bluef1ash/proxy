<?php
/**
* 数据库输出控制器
*/
class VideoControl extends CommonControl{
	/**
	 * 检索输出
	 */
	public function index()	{
		$vid = Q("get.vid", null, "intval");
		$xml = M("video")->where(array("vid" => $vid))->getField("content");
		$xml = htmlspecialchars_decode($xml);
		header ( 'Content-type:text/xml;charset:utf-8' );
		echo $xml;
	}
}
?>