<?php
class VideoModel extends ViewModel {
	public $view = array(
		"category" => array(
			"type" => INNER_JOIN,
			"field" => "cntitle,entitle,pid",
			"on" => "category.cid=video.cid"
		)
	);
}
?>