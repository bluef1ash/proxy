<?php
/**
 * 频道管理控制器
 */
class UnionControl extends CommonControl{
	private $union;
	/**
	 * 展示频道列表
	 */
	public function index()	{
		$union = K("union")->display_union();
		$this->assign("union", $union);
		$this->display();
	}
	/**
	 * 添加或修改
	 */
	public function add(){
		if (IS_GET) {
			$unid = Q("get.unid");
			$union = K("union")->where(array("unid" => $unid))->find();
			$this->assign("union", $union);
		}
		$this->display();
	}
	/**
	 * 添加或修改处理
	 */
	public function edit(){
		if(!IS_POST)
			$this->error("页面不存在！");
		$uuid = Q("post.uuid");
		$union = M("union");
		if ($uuid) {
			$union->update(Q("post."));
			$this->success("修改成功！")
		}else{
			if ($union->create()) {
				$union->add(Q("post."));
				$this->success("添加成功！")
			}
		}
		$this->error("添加或修改失败！");
	}
}
?>