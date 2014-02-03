<?php
/**
 * 解析记录控制器
 */
class RecordControl extends CommonControl{
	/**
	 * 解析记录
	 */
	public function index() {
		$video = K("video")->field("vid,cnname,enname,uploadtime,py_video.cid,cntitle,entitle,pid,uid")->where(array("uid" => Q("session.uid")))->select();
		$category = M("category")->select();
		foreach ($video as $key => $value){
			$parentChannel = Data::parentChannel($category, $value["pid"]);
			foreach ($parentChannel as $v){
				$video[$key]["cntitleF"] =$v["cntitle"];
			}
		}
		$this->assign("video", $video);
		$this->display();
	}
}
?>