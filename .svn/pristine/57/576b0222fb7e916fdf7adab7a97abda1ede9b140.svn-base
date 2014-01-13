<?php
class commonControl extends Control{
	function father_cate($arr, $pid){
		$array = array();
		foreach ($arr as $value){
			if ($value["pid"]==$pid){
				$array[] = $value;
				$array = array_merge($array,$this->father_cate($arr, $value["pid"]));
			}
		}
		return $array;
	}
}
?>