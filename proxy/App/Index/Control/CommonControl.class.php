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
		$array = array(
			C ( "DINGJI_STYLE" ),
			C("ERJI_STYLE")
		);
		$space = C ( "DING_VNAME_SPACE" );
		for ($i = 0; $i < count($array); $i++) {
			$array[$i] = str_replace("{影片名称}", str_pad ( $vName, $space, " " ), $array[$i]);
			$array[$i] = str_replace("{集数}", $number, $array[$i]);
			$array[$i] = str_replace("{首拼字母}", getinitial ( $vName ), $array[$i]);
			$array[$i] = str_replace("{影片类别}", $category, $array[$i]);
			$space = C ( "ER_VNAME_SPACE" );
		}
		return $array;
	}
}
?>