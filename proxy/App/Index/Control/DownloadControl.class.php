<?php
/**
 * 下载控制器
 */
class DownloadControl extends Control {
	/**
	 * 下载文件
	 */
	public function index() {
		if (! IS_POST)
			$this->error ( '页面不存在' );
		$xml = $this->_post ( "data" );
		$vName = $this->_post ( "vname" );
		$temp = 'D:'.DIRECTORY_SEPARATOR.'wamp'.DIRECTORY_SEPARATOR.'tmp'.DIRECTORY_SEPARATOR;
		$file = 'list.xml';
		file_put_contents ( $temp.$file, $xml );
		xiazai (  $temp, $file, $vName . '.xml' );
		unlink ( $temp . $file );
	}
}
?>