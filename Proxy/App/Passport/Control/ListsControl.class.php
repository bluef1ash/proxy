<?php
/**
 * 管理列表控制器
 */
class ListsControl extends CommonControl{
	/**
	 * 列表展示
	 */
	public function index(){
		# code...
	}
	/**
	 * 更改列表
	 */
	public function alter(){
		$vid = Q("get.vid");
		$video = M("video")->field("vid,cnname,content")->where(array("vid"=>$vid))->find();
		$this->assign("video", $video);
		$this->display();
	}
	/**
	 * 保存更改的列表
	 */
	public function update(){
		if (!IS_POST)
			$this->error("页面不存在！");
		$xml = Q("post.xml");
		$vid = Q("post.vid", null, "intval");
		$video = M("video");
		$video->where(array("vid"=>$vid))->update(array("content"=>$xml));
		$filepath = htmlspecialchars_decode($video->field("filepath")->where(array("vid"=>$vid))->find()["filepath"]);
		$put_contents = file_put_contents($filepath, htmlspecialchars_decode($xml));
		if ($video && $put_contents){
			$this->success("更新成功！", U("Passport/Record/index"));
		}else {
			$this->error("更新失败！", U("Passport/Record/index"));
		}
	}
}
?>