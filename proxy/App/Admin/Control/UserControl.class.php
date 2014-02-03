<?php
/**
 *后台对前台用户管理控制器
 */
class UserControl extends CommonControl{
	/**
	 * 显示模板
	 */
	public function index(){
		$user = M("user")->select();
		$this->assign("user", $user);
		$this->display();
	}
	/**
	 * 锁定用户
	 */
	public function lock_user(){
		$uid = Q("get.uid", null, "intval");
		M("user")->where(array("uid"=>$uid))->save(array("userlock"=>1));
		$this->success("锁定成功！");
	}
	/**
	 * 解锁用户
	 */
	public function unlock_user(){
		$uid = Q("get.uid", null, "intval");
		M("user")->where(array("uid"=>$uid))->save(array("userlock"=>0));
		$this->success("解锁成功！");
	}
	/**
	 * 允许用户上传
	 */
	public function upload(){
		$uid = Q("get.uid", null, "intval");
		M("user")->where(array("uid" => $uid))->save(array("usergroup" => 1));
		$this->success("允许上传成功！");
	}
	/**
	 * 允许用户上传
	 */
	public function unupload(){
		$uid = Q("get.uid", null, "intval");
		M("user")->where(array("uid" => $uid))->save(array("usergroup" => 0));
		$this->success("不允许上传成功！");
	}
}