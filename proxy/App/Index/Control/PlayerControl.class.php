<?php
/**
 * GET传参播放控制器
 */
class PlayerControl extends CommonControl{
	/**
	 * 传参播放
	 */
	public function index(){
		if (Q("get.url")){
			$xml = A("Data/Proxy/video",array("url"=>Q("get.url")));
			$this->assign("vName", $xml["vName"]);
			$this->assign("xml", preg_replace("/\n/iUs", "", $xml["xml"]));
		}
		$this->display();
	}
}
?>