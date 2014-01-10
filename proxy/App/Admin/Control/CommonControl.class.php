<?php
/**
 * 公共控制器
 */
class CommonControl extends Control{
	/**
	 * 初始化
	 */
	public function __init(){
		if(!$this->_session("adminname") || !$this->_session("aid"))
			go("login/index");
	}
	/**
	 * 递归重新排序无限极分类数组
	 */
	public function limitless($data,$pid=0,$level=0){
		$arr = array();
		foreach ($data as $v) {
			if($v["pid"] == $pid){
				$v["level"] = $level;
				$v["html"] = str_repeat("_", ($level * 9));
				$arr[] = $v;
				$arr = array_merge($arr, $this->limitless($data, $v["cid"],$level + 1));
			}
		}
		return $arr;
	}
	/**
	 * 获得传递ID所有子级分类ID
	 * 
	 */
	public function son_cate($arr, $cid){
		$array = array();
		foreach ($arr as $v) {
			if($v["pid"] == $cid){
				$array[] = $v["cid"];
				$array = array_merge($array, $this->son_cate($arr,$v["cid"]));
			}
		}
		return $array;
	}
	/**
	 * 修改配置项
	 */
	public function edit(){
		$path = COMMON_PATH . "config/".$this->_post("config").".php";
		//p(include $path);
		// p($_POST);
		unset($_POST["config"]);
		$config = array_merge(include $path, array_change_key_case($this->_POST(), CASE_UPPER));
		$str = "<?php\r\nif (!defined(\"HDPHP_PATH\"))exit(\"No direct script access allowed\");\r\nreturn " . var_export($config, true) . ";\r\n?>";
		if(file_put_contents($path, $str)){
			$this->success("修改成功！");
		} else {
			$this->error("修改失败！");
		}	
	}	
}