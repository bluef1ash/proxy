<?php
/**
 * 上传控制器
 */
class UploadControl extends AuthControl {
	/**
	 * 上传后处理
	 */
	public function index() {
		if (! IS_POST && ! Q ( "session.uid" ) )
			$this->error ( "页面不存在！" );
		if ( Q ( "session.usergroup" ) != 1 )
			$this->error ( "您没有上传权限，请联系管理员！" );
		if (! C( "UPLOAD_ON" ) )
			$this->error ( "管理员已禁用上传功能，请联系管理员！" );
		$uploadIp = explode(",",  C("UPLOAD_IP"));
		$userip = Ip::getClientIp();
		foreach ($uploadIp as $value) {
			if ($userip == $value){
				$this->error("管理员不允许这台电脑上传！");
				break;
			}
		}
		$xml = Q ( "post.xml" );
		$xml_d = htmlspecialchars_decode($xml);
		$vName = Q ( "post.vname" );
		$cateone = Q ( "post.cate-one" );
		$catetwo = Q ( "post.cate-two" ) ? Q ( "post.cate-two" ) . "/"  : "";
		$userunion = Q ( "post.userunion" ) ? Q ( "post.userunion" ) : Q ( "session.userunion" );
		if (! $vName || ! $cateone || ! $xml || ! $userunion )
			$this->error("上传内容或名称不得为空！");
		$uploadKeywords = explode(",",  C("UPLOAD_KEYWORDS"));
		foreach ($uploadKeywords as $value) {
			if (strpos($vName, $value) > -1 || strpos($xml_d, $value) > -1){
				$this->error("上传内容有非法关键字！");
				break;
			}
		}
		$uploadUrl = explode(",",  C("UPLOAD_URL"));
		foreach ($uploadUrl as $value) {
			if (strpos($xml_d, $value) > -1){
				$this->error("上传内容有非法视频地址！");
				break;
			}
		}
		$years = date ( "Ym" ) . "/";
		$filepath = C ( "LIST_UPDATE_PATH" ) . $cateone . "/" . $catetwo . $years;
		$envName = string::pinyin ( $vName );
		$fix = C ( "LIST_FIX" );
		$file = $filepath . $envName . $fix;
		$category = M ( "category" );
		$cate = $catetwo ? Q ( "post.cate-two" ) : $cateone;
		$cid = $category->field ( "cid,cntitle" )->where ( array( "entitle" => $cate ) )->find ();
		$db = array (
			"content" => $xml,
			"cnname" => $vName,
			"enname" => $envName,
			"uploadtime" => time (),
			"uid" => Q ( "session.uid" ),
			"cid" => $cid ["cid"],
			"filepath" => htmlspecialchars($file)
		);
		$replace = 0;
		if (! file_exists ( $filepath )) {
			if (! dir::create( $filepath ) )
				$this->error( "目录不能写入服务器！" );
		}
		if (file_exists ( $file )) {
			$vid = M ( "video" )->field( "vid" )->where( array( "cnname" => $vName ) )->find()["vid"];
			session ( "xml", $vid );
			session ( "xml", $xml_d );
			session ( "cnname", $vName );
			session ( "enname", $envName );
			session ( "filepath", $file );
			session ( "cid", $cid ["cid"] );
			$replace = 1;
		} else {
			file_put_contents ( $file, htmlspecialchars_decode ( $xml ) );
			M ( "video" )->add ( $db );
			M ( "user" )->inc ( "count", "uid=" . Q ( "session.uid" ), 1 );
		}
		$dingjiyangshi = preg_replace ( "/{影片名称}/iUs", str_pad ( $vName, C ( "DING_VNAME_SPACE" ), " " ), C ( "DINGJI_STYLE" ) );
		$erjiyangshi = preg_replace ( "/(.*){首拼字母}(.*){影片类别}(.*){影片名称}(.*)/iUs", "\\1" . getinitial ( $vName ) . "\\2" . $cid ["cntitle"] . "\\3" . str_pad ( $vName, C ( "ER_VNAME_SPACE" ), " " ) . "\\4", C ( "ERJI_STYLE" ) );
		$biaoji = $catetwo ? "{" . ucfirst ( str_replace("/", "", $catetwo ) ) ."}" : "{" . ucfirst ( $cateone ) . "}";
		$prefix = $this->upload_prefix();
		$assign = array (
			"vname" => $vName,
			"path" => $biaoji . $years . $envName . $fix,
			"dingji" => $dingjiyangshi,
			"erji" => $erjiyangshi,
			"userunion" => $userunion,
			"replace" => $replace,
			"prefix" => $prefix
		);
		$this->assign ( "assign", $assign );
		$this->display ();
	}
	/**
	 * 重复文件，异步上传
	 */
	public function reajax() {
		if (Q ( "get.error" ) == 1) {
			session ("xml", null );
			session ( "cnname", null );
			session ( "enname", null );
			session ( "filepath", null );
			session ( "cid", null );
			$this->error ( "替换失败！" );
		}
		if (! IS_AJAX)
			$this->error ( "页面不存在！" );
		$uid = Q ( "post.uid" );
		$data = Q ( "session.xml" );
		$title = Q ( "session.cnname" );
		$enname = Q ( "session.enname" );
		$file = Q ( "session.filepath" );
		if ($uid && $file && $data && $title && $enname) {
			if (file_put_contents ( $file, htmlspecialchars_decode ( $data ) )) {
				$db = array (
					"content" => $data,
					"cnname" => $title,
					"enname" => $envname,
					"uploadtime" => time (),
					"uid" => Q ( "session.uid" ),
					"cid" => Q ( "session.cid" )
				);
				M ( "video" )->where ( array( "vid" => Q ( "session.vid" ) ) )->update ( $db );
				echo 1;
			}
		} else {
			echo 0;
		}
		session ("xml", null );
		session ( "cnname", null );
		session ( "cid", null );
		session ( "enname", null );
		session ( "filepath", null );
	}
	/**
	 * 获取父级分类
	 */
	public function get_cate() {
		if (! IS_AJAX)
			$this->error ( "页面不存在！" );
		$entitle = Q ( "entitle" );
		$category = M ( "category" );
		$pid = $category->where ( array ( "entitle" => $entitle ) )->find ();
		$cate = $category->where ( array ( "pid" => $pid ["cid"] ) )->select ();
		if ($cate) {
			$this->ajax( $cate, "json" );
		} else {
			echo 0;
		}
	}
}
?>