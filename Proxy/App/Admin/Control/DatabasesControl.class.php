<?php
/**
 * 数据库控制器
 */
class DatabasesControl extends CommonControl{
	/**
	 * 默认显示
	 */
	public function index()	{
		$dir = Dir::treeDir(ROOT_PATH . 'Backup/Databases/');
		$this->assign("dir", $dir);
		$this->display();
	}
	/**
	 * 备份
	 */
	public function backup(){
		if (!IS_GET)
			$this->error("页面不存在！");
		$dir = Q("get.dir");
		Backup::backup(array(
			"database" => "proxy",
			'dir' => ROOT_PATH . 'Backup/Databases/' . $dir,
			"url" => U("Admin/Databases/index")
		));
	}
	/**
	 * 还原
	 */
	public function recovery(){
		if (!IS_GET)
			$this->error("页面不存在！");
		$dir = Q("get.dir");
		Backup::recovery(array(
			'dir' => ROOT_PATH . 'Backup/Databases/' . $dir,
			"url" => U("Admin/Databases/index")
		));
	}
}
?>