<?php
/**
 * 视频分类管理控制器
 */
class CategoryControl extends CommonControl{
	/**
	 * 视频分类列表
	 */
	public function category(){
		$cate = M("category")->select();
		$cate = $this->limitless($cate);
		//p($cate);
		$this->assign("cate", $cate);
		$this->display();
	}
	/**
	 * 添加子分类
	 */
	public function add_cate(){
		// p($_GET);
		if(IS_POST){
			$entitle = Q ( "post.entitle" );
			$pid = Q ( "post.pid", null, "intval" );
			$data = array(
				"cntitle" => Q ( "post.cntitle" ),
				"entitle" => $entitle,
				"pid"	=> $pid
				);
			$category = M("category");
			$father = array();
			while ($pid>0){
				$title = $category->field("entitle,pid")->where(array("cid"=>$pid))->find();
				$father[] = $title["entitle"] . "/";
				$pid = $title["pid"];
			}
			$father = array_reverse($father);
			$fatherStr = "";
			foreach ($father as $value){
				$fatherStr .= $value;
			}
			$add = $category->add($data);
			$lists_path = C("LIST_UPDATE_PATH") . $fatherStr;
			if (!file_exists($lists_path.$entitle . "/")){
				$mkdir = mkdir($lists_path . $entitle);
			}else {
				$mkdir = 0;
				$this->error("目录不可读写！");
			}
			unset($_POST);
			if (!$add && !$mkdir)
				$this->error("添加失败！");
			$this->success("添加成功！");
		}
		$this->display();
	}
	/**
	 * 修改分类
	 */
	public function edit_cate(){
		if(IS_POST){
			$cid = Q ( "post.cid", null, "intval");
			$cntitle = Q ( "post.cntitle" );
			$entitle = Q ( "post.entitle" );
			$category = M("category");
			$pid = $category->field("pid,entitle")->where(array("cid"=>$cid))->find();
			$father =$category->field("entitle")->where(array("pid"=>$pid["pid"]))->find();
			$update = $category->where(array("cid"=>$cid))->update(array("cntitle"=>$cntitle, "entitle"=>$entitle));
			$lists_path = C("LIST_UPDATE_PATH") . $father["entitle"] . "/";
			$rename = rename($lists_path . $pid["entitle"], $lists_path . $entitle);
			unset($_POST);
			if (!$update && !$rename)
				$this->error("修改失败！");
			$this->success("修改成功！");
		}
		$cid = Q("get.cid", null, "intval");
		$cate = M("category")->where(array("cid"=>$cid))->find();
		$this->assign("cate", $cate);
		$this->display();
	}
	/**
	 * 删除分类
	 */
	public function del_cate(){
		$cid = Q ("get.cid", null, "intval");
		$cate = M("category")->field("cid,pid")->select();
		$cate = $this->son_cate($cate, $cid);
		$cate[] = $cid;
		$where = implode(",", $cate);
		M("category")->in($where)->delete();
		$this->success("删除成功！");
	}
	/**
	 * 添加顶级分类
	 */
	public function add_top_cate(){
		if(IS_POST){
			$cntitle = Q ( "post.cntitle" );
			$entitle = Q ( "post.entitle" );
			$lists_path = C("LIST_UPDATE_PATH").$entitle;
			if(file_exists($lists_path) && !is_writable($lists_path))
				$this->error("文件夹已存在，或者目录不可读写！");
			$mkdir = mkdir($lists_path);
			$add = M("category")->add(array("title"=>$title));
			if (!$add && !$mkdir)
				$this->error("添加失败！");
			$this->success("添加成功！");
		}
		$this->display();
	}
}