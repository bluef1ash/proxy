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
				"pid" => $pid
			);
			if ($category->create()){
				if ($category->add($data)) {
					$this->success("添加成功！");
				}else{
					$this->error("添加失败！");
				}
			}
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
			if (M("category")->update(array("cid" => $cid,"cntitle" => $cntitle, "entitle" => $entitle))){
				$this->success("修改成功！");
			}else{
				$this->error("修改失败！");
			}
		}else{
			$cid = Q("get.cid", null, "intval");
			$cate = M("category")->where(array("cid"=>$cid))->find();
			$this->assign("cate", $cate);
			$this->display();
		}
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
			$category = M("category");
			if ($category->create()){
				if ($category->add(array("cntitle" => $cntitle, "entitle" => $entitle))) {
					$this->success("添加成功！");
				}else{
					$this->error("添加失败！");
				}
			}
		}
		$this->display();
	}
}