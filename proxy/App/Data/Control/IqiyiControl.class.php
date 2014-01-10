<?php
class IqiyiControl extends Control {
	/**
	 * 默认执行
	 * @return [type] [description]
	 */
	public function index() {
		header ( 'Content-type:text/xml;charset:utf-8;filename:奇艺代理.xml' ); // 定义文件头
		echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n"; // 输出XML格式
		$fname = 'http://' . $_SERVER ["SERVER_NAME"] . $_SERVER ["PHP_SELF"]; // 文件HTTP完整路径
		if ($this->_GET ( 'id' )) { // 是否向地址栏传递URL参数
			echo $this->listpage ( $this->_GET ( 'id' ) )["xml"]; // 写入XML内容
		} elseif ($this->_GET ( 'page' )) { // 是否向地址栏传递PAGE参数
			$url = file_data ( "http://list.iqiyi.com/www/2/------------2-1-" . $this->_GET ( 'page' ) . "-1---.html" ); // 采集奇艺电视剧页面
			preg_match_all ( '/<a\s+href="(.+)" class="title">.*<\/a>/iUs', $url, $arr ); // 正则表达式
			foreach ( $arr [1] as $value ) { // 循环输出剧集XML列表
				echo $this->listpage ( $value )["xml"];
			}
		} elseif ($this->_GET ( 'vname' )) {
			echo $this->listpage ( $this->_GET ( 'vname' ) )["vName"];
		} else { // 没有向地址栏进行传递参数
			for($i = 1; $i <= 10; $i ++) { // 循环输出奇艺电视剧排行
				$lists .= "<m list_src=\"{$fname}?page={$i}\" label=\"奇艺电视剧 第{$i}页\" />\n";
			}
			echo "<list>\n".$lists."</list>";
		}
	}
	/**
	 * 生成列表
	 * @param  string $id 视频ID
	 * @return array     视频列表及视频名称
	 */
	public function listpage($aid) {
		$interface = file_data ( 'http://dispatcher.video.qiyi.com/mini/pl/' . $aid . '/' ); // 采集接口
		$interface = substr ( $interface, 13 ); // 获取JSON
		$obj = json_decode ( $interface ); // JSON解码
		$data = $obj->data; // 获取视频内容数组
		$vName = preg_replace("/(.*)\s?第\d+集/iUs", "\\1", $data[0]->title);
		$xml = "";
		foreach ( $data as $value ) { // 遍历数组
			$vid = $value->videoId; // 获取单个视频ID
			$title = $value->title; // 获取单个视频名称
			$xml .= '<m type="qiyi" src="http://cache.video.qiyi.com/v/' . $vid . '" label="' . $title . "\" />\n"; // 写入XML内容
		}
		return array("xml"=>"<list>\n" . $xml . '</list>',"vName"=>$vName); // 输出剧集头和剧集列表
	}
}
?>