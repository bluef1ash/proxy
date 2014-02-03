<?php
/**
 * QQ登录控制器
 */
class QqloginControl extends Control{
	/**
	 * 自动加载
	 */
	public function __init(){
	}
	/**
	 * 首次登录
	 */
	public function index(){
		if (!Q("session.UserInfo"))
			$this->error("页面不存在！");
		$this->display();
	}
	/**
	 * 登录
	 */
	public function login(){
		require_once(COMMON_LIB_PATH . "QqConnect/API/qqConnectAPI.php");
		$qc = new QC();
		$qc->qq_login();
	}
	/**
	 * 返回登录
	 */
	public function callback(){
		require_once(COMMON_LIB_PATH . "QqConnect/API/qqConnectAPI.php");
		$qc = new QC();
		$callback = $qc->qq_callback();
		$openid = $qc->get_openid();
		$user = M("user")->field("uid,username,password,qqau,userlock,userunion,usergroup")->where(array("qqau" => $openid))->find();
		session("qqau", $openid);
		if (empty($user["qqau"])) {//首次登录或没有绑定账号
			$qc = new QC($callback, $openid);
			$arr = $qc->get_user_info();
			session("UserInfo", $arr["nickname"]);
			go("Passport/Qqlogin/index");
		}elseif($user["qqau"] == $openid){//数据库比对正确
			if($user["userlock"] == 1)
				$this->error("您已经被锁定，请联系管理员！");
			//$this->eve_exp($user["uid"]);
			$loginData = array(
				"logintime"	=> time(),
				"loginip" => ip::getClientIp(),
				"qqau" => $openid
			);
			M("user")->where(array("uid"=>$user["uid"]))->save($loginData);
			// p($_POST);
			session("username", $user["username"]);
			session("uid", $user["uid"]);
			session("userunion",$user["userunion"]);
			session("usergroup",$user["usergroup"]);
			$this->success("登录成功！正在跳转...", U(__WEB__));
		}
	}
}
?>