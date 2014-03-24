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
		if (!$lists = $this->cache_collect($vid)) {
			$video = M("video")->field("content,cachetime")->where(array("vid" => $vid))->find();
			$cachetime = intval($video["cachetime"]) * 60;
			$lists = $this->out_video($video["content"], $cachetime);
			if ($cachetime) {
				$this->cache_collect($vid, 1, $lists, "", "file", $cachetime, ROOT_PATH . "Cache/Static");
			} else {
				$this->cache_collect($vid, 1, $lists, "", "file", 604800, ROOT_PATH . "Cache/Static");
			}
		}
		header ( "Content-type:text/xml;charset:utf-8" );
		echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n<list>\n" . $lists . "</list>";
	}
}
?>