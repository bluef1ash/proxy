<?php
/**
 * 注册控制器
 */
class RegisterControl extends Control{
	/**
	 * 异步检测用户名
	 */
	public function ajax_username(){
		if(!IS_AJAX)
			$this->error("页面不存在！");
		$username = Q("post.username");
		if(M("user")->field("uid")->where(array("username"=>$username))->find()){
			echo 0;
		} else {
			echo 1;
		}
	}
	/**
	 * 异步判断验证码
	 */
	public function ajax_code(){
		if(!IS_AJAX)
			$this->error("页面不存在！");
		$code  = Q("post.verify", null, "htmlspecialchars,strtoupper");
		if($code != Q("session.code")){
			echo 0;
		} else {
			echo 1;
		}
	}
	/**
	 * 注册用户
	 */
	public function register(){
		if(!C("RES_ON"))
			$this->error("网站正在调整，停止注册，给您带来不便，非常歉意！");
		if(!IS_POST)
			$this->error("页面不存在");
		$data = array(
			"username"	=> Q("post.username"),
			"password"	=> Q("post.pwd", null, "md5"),
			"userunion" => Q("post.userunion"),
			"qqau"      => Q("post.qqau"),
			"restime"	=> time()
		);
		M("user")->add($data);
		$this->success("注册成功！");
	}
	/**
	 * 验证码
	 */
	public function code(){
		$code = new code();
		$code->show();
	}
}