<?php
/**
 * 前台主页控制器
 */
class IndexControl extends Control {
	/**
	 * 首页
	 */
	public function index() {
		$this->display ();
	}
	/**
	 * 采集页
	 */
	public function parse() {
		// 类别
		$categorytop = M ( 'category' )->where ( "pid=0" )->select ();
		$this->assign ( "categorytop", $categorytop );
		// 采集
		if (IS_POST && $this->_post ( "websiteText" )) {
			$url = $this->_post ( "websiteText" );
			$update = $this->_post ( "update" );
			$collect = A ( "data/proxy/index", array (
					$url,
					$update 
			) );
			$this->assign ( "collect", $collect );
			if ($update == "auto")
				$ufs = 1;
			else 
				$ufs = 0;
			$collect["auto_disabled"]?$auto_disabled = 1:$auto_disabled = 0;
			if ($this->_post ( "ctype" ) == "plural")
				$ctype = 1;
			else 
				$ctype = 0;
			$this->_post ( "collection" ) ? $collection = 1 : $collection = 0;
			$fs = array(
				"update" => $ufs,
				"auto_disabled" => $auto_disabled,
				"ctype" => $ctype,
				"collection" => $collection
			);
			$website = $url;
		} else {
			$website = "请填入需采集的视频地址";
			$fs = array(
				"update" => 0,
				"auto_disabled" => 0,
				"ctype" => 0,
				"collection" => 0
			);
		}
		if (IS_GET && $this->_get ( "url" )) {
			$yy_url = A ( "data/proxy/collect", array (
					$this->_get ( "url" ) 
			) );
			$this->assign ( "yyurl", $yy_url );
		}
		if (! $this->_SESSION ( 'username' ) && ! $this->_SESSION ( 'uid' ) && $this->_SESSION ( 'group' ) != 1)
			$readonly = true;
		else
			$readonly = false;
		$this->assign ( "updatefs", $fs );
		$this->assign ( "readonly", $readonly );
		$this->assign ( "website", $website );
		$this->display ();
	}
}
?>