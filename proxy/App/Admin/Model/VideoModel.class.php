<?php
class videoModel extends ViewModel {
	public $table = "video";
	public $view = array(
		"user" => array(
			"type" => INNER_JOIN,
			"field" => "username,userunion",
			"on" => "user.uid=video.uid"
		),
		"category" => array(
			"type" => INNER_JOIN,
			"field" => "cntitle,entitle,pid",
			"on" => "category.cid=video.cid"
		)
	);
	public function counts(){
		return $this->count();
	}
}
?>