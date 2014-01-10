<?php
/**
 * 上传控制器
 */
class UploadControl extends Control {
	/**
	 * 上传后处理
	 */
	public function index() {
		if (! IS_POST && ! $this->_session ( "uid" ) && $this->_session ( "group" ) != 1)
			$this->error ( "页面不存在" );
		$xml = $this->_post ( "xml" );
		$vName = $this->_post ( "vname" );
		$cateone = $this->_post ( "cate-one" ) . "/";
		$catetwo = $this->_post ( "cate-two" ) ? $this->_post( "cate-two" ) . "/" : "";
		$this->_post ( "userunion" ) ? $userunion = $this->_post ( "userunion" ) : $userunion = $this->_session ( "userunion" );
		$years = date ( "Ym" ) . "/";
		$filepath = C ( "LIST_UPDATE_PATH" ) . $cateone . $catetwo . $years;
		$envName = string::pinyin ( $vName );
		$fix = C ( "LIST_FIX" );
		$file = $filepath . $envName . $fix;
		$category = M ( "category" );
		$cid = $category->field ( "cid" )->where ( array( "entitle" => $cateone ) )->find ();
		$smallclass = $category->field ( "cid,cntitle" )->where ( array( "entitle=" => $catetwo, "pid" => $cid ["cid"] ) )->find ();
		$db = array (
				"content" => $xml,
				"cnname" => $vName,
				"enname" => $envName,
				"uploadtime" => time (),
				"uid" => $this->_session ( "uid" ),
				"cid" => $smallclass ["cid"] 
		);
		$replace = 0;
		if (! file_exists ( $filepath )) {
			if (! mkdir ( $filepath, 0777, true ) )
				$this->error( "目录不能写入服务器！" );
		}
		if (file_exists ( $file )) {
			session ( "xml", $xml );
			session ( "vname", $vName );
			session ( "enname", $envName );
			session ( "filepath", $file );
			$replace = 1;
		} else {
			file_put_contents ( $file, htmlspecialchars_decode ( $xml ) );
			M ( "video" )->add ( $db );
			M ( "user" )->inc ( "count", "uid=" . $this->_session ( "uid" ), 1 );
		}
		$dingjiyangshi = preg_replace ( "/{影片名称}/iUs", str_pad ( $vName, C ( "DING_VNAME_SPACE" ), " " ), C ( "DINGJI_STYLE" ) );
		$erjiyangshi = preg_replace ( "/(.*){首拼字母}(.*){影片类别}(.*){影片名称}(.*)/iUs", "\\1" . getinitial ( $vName ) . "\\2" . $smallclass ["cntitle"] . "\\3" . str_pad ( $vName, C ( "ER_VNAME_SPACE" ), " " ) . "\\4", C ( "ERJI_STYLE" ) );
		$assign = array (
				"vname" => $vName,
				"path" => C ( "LIST_WEBSITE" ) . $cateone . $catetwo . $envName . $fix,
				"dingji" => $dingjiyangshi,
				"erji" => $erjiyangshi,
				"userunion" => $userunion,
				"replace" => $replace 
		);
		$this->assign ( "assign", $assign );
		$this->display ();
	}
	/**
	 * 重复文件，异步上传
	 */
	public function reajax() {
		if ($this->_get ( "error" ) == 1) {
			session ("xml", null );
			session ( "vname", null );
			session ( "enname", null );
			session ( "filepath", null );
			$this->error ( "替换失败！" );
		}
		if (! IS_AJAX)
			$this->error ( "页面不存在！" );
		$uid = $this->_post ( "uid" );
		$data = $this->_session ( "xml" );
		$title = $this->_session ( "vname" );
		$enname = $this->_session ( "enname" );
		$file = $this->_session ( "filepath" );
		if ($uid && $file && $data && $title && $enname) {
			if (file_put_contents ( $file, htmlspecialchars_decode ( htmlspecialchars_decode ( $data ) ) )) {
				$db = array (
						"content" => $data,
						"cnname" => $title,
						"enname" => $envname,
						"uploadtime" => time (),
						"uid" => $this->_session ( "uid" ) 
				);
				M ( "video" )->where ( array( "cntitle" => $title ) )->update ( $db );
				echo 1;
			}
		} else {
			echo 0;
		}
		session ("xml", null );
		session ( "vname", null );
		session ( "enname", null );
		session ( "filepath", null );
	}
	/**
	 * 获取父级分类
	 */
	public function get_cate() {
		if (! IS_AJAX)
			$this->error ( "页面不存在！" );
		$entitle = $this->_post ( "entitle" );
		$category = M ( "category" );
		$pid = $category->where ( array ( "entitle" => $entitle ) )->find ();
		$cate = $category->where ( array ( "pid" => $pid ["cid"] ) )->select ();
		if ($cate) {
			echo json_encode ( $cate );
		} else {
			echo 0;
		}
	}
}
?>