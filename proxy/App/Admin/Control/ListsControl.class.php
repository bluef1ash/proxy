<?php
/**
 * 视频列表管理控制器
 */
class ListsControl extends CommonControl{
	/**
	 * 列表展示
	 */
	public function index(){
		$category = K ( "category" );
		$categorytop = $category->tops ();
		$this->assign ( "categorytop", $categorytop );
		$db = K("video");
		$video = $db->lists_select();
		$array = $category->select();
		foreach ($video[0] as $key => $value){
			$parentChannel = Data::parentChannel($array, $value["pid"]);
			foreach ($parentChannel as $v){
				$video[0][$key]["cntitleF"] = $v["cntitle"];
				$video[0][$key]["entitleF"] = $v["entitle"];
			}
		}
		$this->assign("prefix", $this->upload_prefix());
		$this->assign("video", $video[0]);
		$this->assign("page", $video[1]);
		$this->display();
	}
	/**
	 * 删除列表
	 */
	public function delete(){
		if (!Q ( "get.vid" ))
			$this->error("页面不存在！");
		$vid = Q("get.vid", null, "intval");
		if( M("video")->where(array("vid"=>$vid))->delete()){
			$this->success('删除成功！');
		}else{
			$this->error("删除失败！");
		}
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
		if (!Q ( "post.word" ))
			$this->error("请输入搜索关键字！");
		$word = Q ( "post.word" );
		$where = "cnname like '%" . $word . "%'";
		$db = K("video");
		$video = $db->lists_select($where);
		$category = K ( "category" );
		$categorytop = $category->tops();
		$this->assign ( "categorytop", $categorytop );
		$array = $category->select();
		foreach ($video[0] as $key => $value){
			$parentChannel = Data::parentChannel($array, $value["pid"]);
			foreach ($parentChannel as $v){
				$video[0][$key]["cntitleF"] = $v["cntitle"];
				$video[0][$key]["entitleF"] = $v["entitle"];
			}
		}
		$this->assign("prefix", $this->upload_prefix());
		$this->assign("video", $video[0]);
		$this->assign("page", $video[1]);
		$this->display();
	}
	/**
	 * 移动列表文件
	 */
	public function move(){
		if (!$vid = Q("post.vid", null, "intval") || !$cateone = Q("post.cate-one"))
			$this->error("页面不存在！");
		$cate = Q ( "post.cate-two" ) ? Q ( "post.cate-two" ) : $cateone;
		$cid = M("category")->field("cid")->where(array("entitle" => $cate))->find();
		if (M("video")->update(array("vid" => $vid, "cid" => $cid["cid"]))) {
			$this->success("移动成功！");
		}else{
			$this->error("移动失败！");
		}
	}
	/**
	 * 增加列表
	 */
	public function add(){
		$categorytop = M ( "category" )->where ( array("pid" => 0 ) )->select ();
		$this->assign ( "categorytop", $categorytop );
		if ($vid = Q("get.vid")) {
			$video = M("video");
			$result = $video->where(array("vid" => $vid))->find();
			$xml = htmlspecialchars_decode($result["content"]);
			$lists = $this->out_video($result["content"], $result["cachetime"]);
			$result["content"] = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n<list>\n" . trim($lists) . "\n</list>";
			$this->assign("result", $result);
		}
		$this->display();
	}
	/**
	 * 修改或添加处理
	 */
	public function alter(){
		if (!Q("post.vname") || !Q("post.xml"))
			$this->error("页面不存在！");
		$vName = Q("post.vname");
		$xml = Q("post.xml", null, "");
		$xml = $this->upload_video($xml);
		$video = M("video");
		if ($vid = Q("post.vid")) {
			$db = array(
				"vid" => $vid,
				"content" => $xml,
				"cnname" => $vName,
				"uploadtime" => time (),
				"aid" => Q ( "session.aid" ),
				"uid" => 0
			);
			if ($video->update($db)) {
				$this->success("更改成功！");
			}else{
				$this->error("更改失败！");
			}
		} else {
			$cate = Q ( "post.cate-two" ) ? Q ( "post.cate-two" ) : $cateone;
			$category = M ( "category" );
			$cid = $category->where ( array( "entitle" => $cate ) )->getField ( "cid" );
			$db = array (
				"content" => $xml,
				"cnname" => $vName,
				"uploadtime" => time (),
				"aid" => Q ( "session.aid" ),
				"cid" => $cid
			);
			$replace = 0;
			if ($vid = $video->where(array("cnname" => $vName))->getField("vid")) {
				$replace = array(
					"vid" => $vid,
					"content" => $xml,
					"cid" => $cid["cid"]
				);
			} else {
				if ($video->create()) {
					$video->add ( $db );
					$vid = $video->getInsertId();
					M ( "user" )->inc ( "count", "uid=" . Q ( "session.uid" ), 1 );
					$this->success("添加成功！");
				}else{
					$this->error("添加失败！");
				}
			}
		}
	}
}
?>