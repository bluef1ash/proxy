<?php
/**
 * 用户模型
 */
class UserModel extends ViewModel{
	public $table = "user";
	public $view = array(
		"union" => array(
			"type" => LEFT_JOIN,
			"field" => "uuid",
			"on" => "user.unid=union.unid"
		)
	);
}
?>