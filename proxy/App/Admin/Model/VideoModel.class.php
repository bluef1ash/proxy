<?php
class VideoModel extends ViewModel {
	public $table = "video";
	public $view = array(
		"user" => array(
			"type" => LEFT_JOIN,
			"field" => "username,userunion",
			"on" => "user.uid=video.uid"
		),
		"category" => array(
			"type" => LEFT_JOIN,
			"field" => "cntitle,entitle,pid",
			"on" => "category.cid=video.cid"
		),
		"union" => array(
			"type" => LEFT_JOIN,
			"field" => "uuid",
			"on" => "union.unid=user.unid"
		)
	);
	public function lists_select($where = ""){
		if ($where) {
			$page = new page($this->where($where)->count(), 10, 5, 1);
			$video = $this->field("vid,cnname,uploadtime,py_video.cid,username,cntitle,entitle,pid,uuid")->where($where)->order(array("uploadtime" => "desc"))->select($page->limit());
		} else {
			$page = new page($this->count(), 10, 5, 1);
			$video = $this->field("vid,cnname,uploadtime,py_video.cid,username,cntitle,entitle,pid,uuid")->order(array("uploadtime" => "desc"))->select($page->limit());
		}
		return array($video, $page->show());
	}
}
?>