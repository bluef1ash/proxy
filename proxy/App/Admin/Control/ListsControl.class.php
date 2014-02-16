<?php
/**
 * 视频列表管理控制器
 */
class ListsControl extends CommonControl{
	/**
	 * 列表展示
	 */
	public function index(){
		$category = M ( "category" );
		$categorytop = $category->where ( array( "pid" => 0 ) )->select ();
		$this->assign ( "categorytop", $categorytop );
		$db = K("video");
		$count = $db->counts();
		$page = new page($count, 10, 4, 2);
		$video = $db->field("vid,cnname,enname,uploadtime,py_video.cid,username,cntitle,entitle,pid,userunion")->order(array("uploadtime" => "desc"))->select($page->limit());
		$array = $category->select();
		foreach ($video as $key => $value){
			$parentChannel = Data::parentChannel($array, $value["pid"]);
			foreach ($parentChannel as $v){
				$video[$key]["cntitleF"] = $v["cntitle"];
				$video[$key]["entitleF"] = $v["entitle"];
			}
		}
		$this->assign("prefix", $this->upload_prefix());
		$this->assign("video", $video);
		$this->assign("page", $page->show());
		$this->assign("count", $count);
		$this->display();
	}
	/**
	 * 删除列表
	 */
	public function delete(){
		if (!Q ( "get.vid" ))
			$this->error("页面不存在！");
		$vid = Q("get.vid", null, "intval");
		$video = K("video")->field("vid,enname,entitle,pid")->where(array("vid"=>$vid))->find();
		$category = M("category")->select();
		$father = Data::parentChannel($category, $video[0]["pid"]);
		$video["entitleF"] = $father[0]["entitle"];
		$file = C("LIST_UPDATE_PATH") . $video[0]["entitleF"] . "/" . $video[0]["entitle"] . "/" . $video[0]["enname"] . C("LIST_FIX");
		$unfile = unlink($file);
		if (!$unfile)
			$this->error("删除失败！");
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
		if (!Q ( "post.word" ))
			$this->error("请输入搜索关键字！");
		$word = Q ( "post.word" );
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
	/**
	 * 移动列表文件
	 */
	public function move(){
		if (!$vid = Q("post.vid", null, "intval") || !$cateone = Q("post.cate-one"))
			$this->error("页面不存在！");
		$catetwo = Q ( "post.cate-two" ) ? Q ( "post.cate-two" ) : $cateone;
		$video = M("video");
		if ($video->update(array("vid" => $vid, "cid" => $cid))) {
			$this->success("移动成功！");
		}else{
			$this->error("移动失败！");
		}
	}
	/**
	 * 增加列表
	 */
	public function add(){
		if ($vName = Q("post.vname") && $xml = Q("post.xml") && $cateone = Q("post.cate-one")) {
			Q("post.cate-two") ? $catetwo = Q("post.cate-two") : $catetwo = "";
			$years = date ( "Ym" ) . "/";
			$filepath = C ( "LIST_UPDATE_PATH" ) . $cateone . "/" . $catetwo . $years;
			$envName = string::pinyin ( $vName );
			$fix = C ( "LIST_FIX" );
			$file = $filepath . $envName . $fix;
			$category = M ( "category" );
			$cid = $category->field ( "cid" )->where ( array( "entitle" => $cateone ) )->find ();
			$smallclass = $category->field ( "cid,cntitle" )->where ( array( "entitle=" => $catetwo, "pid" => $cid ["cid"] ) )->find ();
			$db = array (
				"content" => $xml,
				"cnname" => $vName,
				"enname" => $envName,
				"uploadtime" => time (),
				"uid" => Q ( "session.aid" ),
				"cid" => $smallclass ["cid"],
				"filepath" => htmlspecialchars($file)
			);
			$replace = 0;
			if (! file_exists ( $filepath )) {
				if (! dir::create( $filepath ) )
					$this->error( "目录不能写入服务器！" );
			}
			if (file_exists ( $file )) {
				session ( "xml", $xml_d );
				session ( "vname", $vName );
				session ( "enname", $envName );
				session ( "filepath", $file );
				$replace = 1;
			} else {
				file_put_contents ( $file, htmlspecialchars_decode ( $xml ) );
				M ( "video" )->add ( $db );
				M ( "user" )->inc ( "count", "uid=" . Q ( "session.uid" ), 1 );
			}
			$this->success("添加成功！");
		}else{
			$categorytop = M ( "category" )->where ( "pid=0" )->select ();
			$this->assign ( "categorytop", $categorytop );
			$this->display();
		}
	}
}
?>