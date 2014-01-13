<?php
/**
 * 解析记录控制器
 */
class RecordControl extends CommonControl{
	/**
	 * 解析记录
	 */
	public function index() {
		$video = K("video")->field("vid,cnname,enname,uploadtime,cntitle,entitle,pid,uid")->where(array("uid"=>$this->_session("uid")))->select();
		$category = M("category")->select();
		foreach ($video as $value){
			$father = father_cate($category, $value["pid"]);
			foreach ($father as $v){
				array_walk($video, "addkey", array("key"=>"cntitlec", "val"=>$v["cntitle"]));
			}
		}
		$this->assign("video", $video);
		$this->display();
	}
}
?>