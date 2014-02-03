<?php
/**
 * 公共控制器
 */
class CommonControl extends AuthControl{
	/**
	 * 自动加载
	 */
	private function __init(){
		if (!Q("session.username") || !Q("seesion.uid"))
			$this->error("页面不存在！");
	}
}
?>