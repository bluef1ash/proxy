<?php
/**
 * 登录控制器
 */
class LoginControl extends AuthControl{
	/**
	 * 显示登录页
	 */
	public function index(){
		if(Q ( "session.adminname" ) || Q ( "session.aid" ))
			go("Admin/Index/index");
		$this->display();
	}
	/**
	 * 验证码
	 */
	public function code(){
		$code = new code();
		$code->show();
	}
	/**
	 * 后台会员登录
	 */
	public function login(){
		if(!IS_POST)
			$this->error("页面不存在！");
		$username = Q ( "post.username" );
		$code = Q ("post.verify", null, array("htmlspecialchars", "strtoupper"));
		if($code != Q ( "session.code" ))
			$this->error("验证码错误！");
		$db = M("admin");
		$user = $db->where(array("username"=>$username))->field("password,userlock,aid")->find();
		if($user["userlock"] == 1)
			$this->error("您已经被锁定，请联系管理员");
		$password = Q("password", null, "md5");
		if($password != $user["password"])
			$this->error("用户名或者密码错误！");
		$data = array(
			"logintime" => time(),
			"loginip" 	=> ip::getClientIp(),
		);
		$db->where(array("username"=>$username))->save($data);
		session("adminname", $username);
		session("aid", $user["aid"]);
		$this->success("登录成功！正在为您跳转.....", "Admin/Index/index");
	}
	/**
	 * 退出
	 */
	public function out(){
		session(null);
		session_destroy();
		$this->success("退出成功！");
	}
}