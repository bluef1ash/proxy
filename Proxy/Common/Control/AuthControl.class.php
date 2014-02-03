<?php
/**
 * 应用组公共控制器
 */
class AuthControl extends Control{
	/**
	 * 上传前缀
	 */
	public function upload_prefix(){
		if ( C("UPLOAD_REPLACE_ON") ) {
			$prefix = C("UPLOAD_URL_PREFIX");
		}else{
			$prefix = C("UPLOAD_URL_PREFIX") . C("CMP_ROOT");
		}
		return $prefix;
	}
}
?>