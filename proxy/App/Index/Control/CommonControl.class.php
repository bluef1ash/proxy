<?php
/**
 * 公共控制器
 */
class CommonControl extends AuthControl{
	/**
	 * 加载页面
	 */
	public function url(){
		if (!IS_GET)
			$this->error("页面不存在！");
		echo file_data(Q("get.url"));
	}
	/**
	 * 频道样式
	 */
	public function union_style($vName, $category, $number){
		$union = M("union")->field("top_style,top_number,down_style,down_number")->where(array("uuid" => Q("session.uuid")))->find();
		$array = array(
			$union["top_style"],
			$union["down_style"]
		);
		$space = $union["top_number"];
		for ($i = 0; $i < count($array); $i++) {
			$array[$i] = str_replace("{影片名称}", str_pad ( $vName, $space, " " ), $array[$i]);
			$array[$i] = str_replace("{集数}", $number, $array[$i]);
			$array[$i] = str_replace("{首拼字母}", getinitial ( $vName ), $array[$i]);
			$array[$i] = str_replace("{影片类别}", $category, $array[$i]);
			$space = $union["down_number"];
		}
		return $array;
	}
}
?>