<?php
/**
 * 上传控制器
 */
class UploadControl extends CommonControl {
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
		$catetwo = Q ( "post.cate-two" ) ? Q ( "post.cate-two" ) : "";
		$cate = $catetwo ? $catetwo : $cateone;
		$userunion = Q ( "post.userunion" ) ? Q ( "post.userunion" ) : Q ( "session.userunion" );
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
		if (! $vName || ! $cateone || ! $xml || ! $userunion )
			$this->error("上传内容或名称不得为空！");
		$fix = C ( "LIST_FIX" );
		$category = M ( "category" );
		$video = M("video");
		$cid = $category->where ( array( "entitle" => $cate ) )->getField ( "cid,cntitle" );
		$db = array (
			"content" => $xml,
			"cnname" => $vName,
			"uploadtime" => time (),
			"uid" => Q ( "session.uid" ),
			"cid" => $cid ["cid"]
		);
		$replace = 0;
		if ($vid = $video->where(array("cnname" => $vName))->getField("vid")) {
			$vid = $vid["vid"];
			session ( "vid", $vid );
			session ( "xml", $xml_d );
			session ( "cnname", $vName );
			session ( "cid", $cid["cid"] );
			$replace = 1;
		} else {
			if ($video->create()) {
				$video->add ( $db );
				$vid = $video->getInsertId();
				M ( "user" )->inc ( "count", "uid=" . Q ( "session.uid" ), 1 );
			}else{
				$this->error("添加失败！");
			}
		}
		$unionStyle = $this->union_style($vName, $cid["cntitle"], 0);
		$prefix = $this->upload_prefix();
		$assign = array (
			"vname" => $vName,
			"vid" => $vid,
			"dingji" => $unionStyle[0],
			"erji" => $unionStyle[1],
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
			session ( "cid", null );
			session ( "vid", null );
			$this->error ( "替换失败！" );
		}
		if (! IS_AJAX)
			$this->error ( "页面不存在！" );
		$uid = Q ( "post.uid" );
		$data = Q ( "session.xml" );
		$title = Q ( "session.cnname" );
		$cid = Q ( "session.cid" );
		if ($uid && $data && $title) {
			$db = array (
				"content" => $data,
				"cnname" => $title,
				"uploadtime" => time (),
				"uid" => Q ( "session.uid" ),
				"cid" => $cid
			);
			M ( "video" )->where ( array( "vid" => Q ( "session.vid" ) ) )->update ( $db );
			echo 1;
		} else {
			echo 0;
		}
		session ("xml", null );
		session ( "cnname", null );
		session ( "cid", null );
		session ( "vid", null );
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