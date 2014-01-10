<?php
/**
 * 视频列表管理控制器
 */
class ListsControl extends CommonControl{
	/**
	 * 列表展示
	 */
	public function index(){
		$db = K("video");
		$count = $db->count();
		$page = new page($count, 10, 4, 2);
		$video = $db->field("vid,cnname,enname,uploadtime,username,cntitle,entitle,pid")->select($page->limit());
		$category = M("category")->select();
		foreach ($video as $value){
			$father = father_cate($category, $value["pid"]);
			foreach ($father as $v){
				array_walk($video, "addkey", array("key"=>"entitleF", "val"=>$v["entitle"]));
				array_walk($video, "addkey", array("key"=>"cntitleF", "val"=>$v["cntitle"]));
			}
		}
		$this->assign("video", $video);
		$this->assign("page", $page->show());
		$this->assign("count", $count);
		$this->display();
	}
	/**
	 * 删除列表
	 */
	public function delete(){
		if (!$this->_get("vid"))
			$this->error("页面不存在！");
		$vid = $this->_GET("vid", "intval");
		$video = K("video")->where(array("vid"=>$vid))->field("vid,enname,entitle")->find();
		$category = M("category")->select();
		$father = father_cate($category, $video["pid"]);
		$video["entitleF"] = $father[0]["entitle"];
		$file = C("LIST_UPDATE_PATH").$video["entitleF"]."/".$video["entitle"]."/".$video["enname"].C("LIST_FIX");
		$unfile = unlink($file);
		if (!$unfile)
			$this->error("删除失败！ ");
		$undb = M("video")->where(array("vid"=>$vid))->delete();
		$this->success('删除成功！');
	}
	/**
	 * 列表搜索
	 */
	public function search(){
		$this->display();
	}
	/**
	 * 搜索结果
	 */
	public function word(){
		if (!$this->_post("word"))
			$this->error("请输入搜索关键字！");
		$word = $this->_post("word");
		$where = "cnname like '%".$word."%'";
		$db = K("video");
		$count = $db->where($where)->count();
		$page = new page($count, 10, 4, 2);
		$video = $db->where($where)->field("vid,cnname,enname,uploadtime,username,cntitle,entitle,cid,uid")->select($page->limit());
		$category = M("category")->select();
		foreach ($video as $value){
			$father = father_cate($category, $value["pid"]);
			foreach ($father as $v){
				array_walk($video, "addkey", array("key"=>"entitleF", "val"=>$v["entitle"]));
				array_walk($video, "addkey", array("key"=>"cntitleF", "val"=>$v["cntitle"]));
			}
		}
		$this->assign("video", $video);
		$this->assign("page", $page->show());
		$this->assign("count", $count);
		$this->display();
	}
}