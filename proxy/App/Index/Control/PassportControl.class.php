<?php
/**
 * 个人中心控制器
 */
class PassportControl extends Control{
	/**
	 * 自动加载
	 */
	private function __init(){
		if (!$this->_SESSION("username") && !$this->_SESSION("uid"))
			$this->error("页面不存在！");
	}
	/**
	 * 个人中心首页
	 */
	public function index() {
		$this->display();
	}
	public function contactus() {
		$this->display();
	}
	/**
	 * 解析记录
	 */
	public function record() {
		$video = K("video")->field("vid,cnname,enname,uploadtime,cntitle,entitle,pid,uid")->where(array("uid"=>$this->_session("uid")))->select();
		$category = M("category")->select();
		foreach ($video as $value){
			$father = father_cate($category, $value["pid"]);
			foreach ($father as $v){
				array_walk($video, "addkey", array("key"=>"cntitlec", "val"=>$v["cntitle"]));
			}
		}
		$this->assign("video", $video);
		$this->display();
	}
	/**
	 * 更改列表
	 */
	public function alter(){
		if (!IS_GET)
			$this->error("页面不存在！");
		$vid = $this->_get("vid");
		$video = M("video")->field("vid,cnname,content")->where(array("vid"=>$vid))->find();
		$this->assign("video", $video);
		$this->display();
	}
	/**
	 * 更新列表
	 */
	public function update() {
		if (!IS_POST)
			$this->error("页面不存在！");
		$xml = $this->_post("xml");
		$vid = $this->_post("vid");
		$video = M("video")->where(array("vid"=>$vid))->update(array("content"=>$xml));
		$put = K("video")->where(array("vid"=>$vid))->find();
		$category = M("category")->select();
		$father = father_cate($category, $put["pid"])[0];
		$put["entitlefather"] = $father["entitle"];
		$lists = C("LIST_UPDATE_PATH");
		$fix = C("LIST_FIX");
		$filepath = $lists.$put["entitlefather"]."/".$put["entitle"]."/".$put["enname"].$fix;
		$put_contents = file_put_contents($filepath, htmlspecialchars_decode($xml));
		if ($video && $put_contents){
			$this->success("更新成功！", U("passport/record"));
		}else {
			$this->error("更新失败！", U("passport/record"));
		}
	}
	/**
	 * 用户设置
	 */
	public function useredit(){
		if (!IS_GET)
			$this->error("页面不存在！");
		$result = M("user")->field("userunion")->where(array("uid"=>$this->_SESSION("uid")))->find();
		$this->assign("userunion", $result["userunion"]);
		$this->display();
	}
	/**
	 * 更改密码
	 */
	public function alterpassword(){
		if (!IS_POST)
			$this->error("页面不存在！");
		$data = array(
			'password'	=> $this->_POST('pwd', 'md5')
			);
		M('user')->where(array("uid"=>$this->session("uid")))->update($data);
		$this->success('注册成功！');
	}
}
?>