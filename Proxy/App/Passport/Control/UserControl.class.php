<?php
/**
 * 用户设置控制器
 */
class UserControl extends CommonControl{
	/**
	 * 用户信息展示
	 */
	public function index(){
		if (!IS_GET)
			$this->error("页面不存在！");
		$result = M("user")->field("userunion")->where(array("uid"=>Q("session.uid")))->find();
		$this->assign("userunion", $result["userunion"]);
		$this->display();
	}
	/**
	 * 更改密码
	 */
	public function alterpassword(){
		if (!IS_POST)
			$this->error("页面不存在！");
		$data = array("userunion" => Q("post.userunion", null, "intval"));
		if ($password = Q("post.pwd", null, "md5") || $pwded = Q("post.pwded", null, "md5")) {
			if ($password != $pwded) {
				$this->error("密码错误！");
			}
			$data["password"] = $password;
		}
		M("user")->where(array("uid" => Q("session.uid")))->update($data);
		$this->success("修改成功！");
	}
}
?>