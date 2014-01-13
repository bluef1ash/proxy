<?php
/**
 * 联系我们控制器
 */
class ContactsControl extends CommonControl{
	/**
	 * 联系方式展示
	 */
	public function information(){
		$this->display();
	}
	/**
	 * 留言板
	 */
	public function message(){
		$this->display();
	}
}
?>