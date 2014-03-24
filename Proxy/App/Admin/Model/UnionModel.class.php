<?php
/**
 * 用户模型
*/
class UnionModel extends Model{
	public $table = "union";
	/**
	 * 显示频道列表
	 */
	public function display_union(){
		$page = new page($this->count(), 10, 4, 5);
		$union = $this->select($page->limit());
		return array($union, $this->count(), $page->show());
	}
	/**
	 * 显示结果
	 */
	public function word($word){
		$where = "uuid like '%" . intval($word) . "%'";
		$count = $this->where($where)->count();
		$page = new page($count, 10, 4, 2);
		$union = $this->where($where)->select($page->limit());
		return array("union" => $union, "count" => $count, "page" => $page->show());
	}
}
?>