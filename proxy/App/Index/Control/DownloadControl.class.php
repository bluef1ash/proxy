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
			$this->error ( "页面不存在！" );
		$xml = Q ( "post.data" );
		$vName = Q ( "post.vname" );
		$file = 'list.xml';
		file_put_contents ( TEMP_PATH . $file, $xml );
		xiazai (  TEMP_PATH, $file, $vName . '.xml' );
		unlink ( TEMP_PATH . $file );
	}
}
?>