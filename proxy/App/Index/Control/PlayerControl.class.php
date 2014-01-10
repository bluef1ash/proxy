<?php
/**
 * GET传参播放控制器
 */
class PlayerControl extends commonControl{
	/**
	 * 传参播放
	 */
	public function index(){
		if ($this->_get("url")){
			$xml = A("data/proxy/video",array("url"=>$this->_get("url")));
			$this->assign("vName", $xml["vName"]);
			$this->assign("xml", preg_replace("/\n/iUs", "", $xml["xml"]));
		}
		$this->display();
	}
}
?>