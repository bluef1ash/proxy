<?php
/**
 * 腾讯视频采集控制器
 */
class QqControl extends CommonControl {
	/**
	 * 默认执行
	 */
	public function index() {
		header ( 'Content-type:text/xml;charset:utf-8;filename:腾讯代理.xml' ); // 定义文件头
		echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n"; // 输出XML格式
		if ( $id = Q ( "get.id" )) {
			$xml = $this->cache_collect("qq_" . $id);
			if ($xml != 1 && !$xml) {
				echo $xml;
			}else{
				$xml = $this->listpage($id);
				$xml = $xml["xml"];
				$this->cache_collect($id, 1, $xml, "qq_");
				echo $xml;
			}
		} elseif ( Q ( "get.top" ) ) {
			$page = file_data ( 'http://v.qq.com/list/2_-1_-1_-1_1_0_' . Q ( "get.top" ) . '_20_-1_-1_0.html' );
			$preg = '#<a href="(http://v\.qq\.com/cover/\w/[0-9a-z]+\.html)" class="mod_poster_130" title="(.*)" target="_blank">#iUs';
			preg_match_all ( $preg, $page, $arr );
			$arr = array_combine ( $arr [1], $arr [2] );
			foreach ( $arr as $key => $value ) {
				$files = file_data ( $key );
				preg_match_all ( '#<li><a target="_self" _hot="coverv2\.vlisttab\.title" href="/cover/\w/[0-9a-z]+/[0-9a-z]+\.html" id="([0-9a-z]+)"  title="(.*)"#iUs', $files, $arrTop );
				$arrTop = array_combine ( $arrTop [1], $arrTop [2] );
				foreach ( $arrTop as $k => $v ) {
					$xml .= '<m label="' . $value . ">\n" . '<m type="" src="http://vsrc.store.qq.com/' . $k . '.flv" label="' . $v . "\" />\n</m>\n";
				}
			}
			echo "<list>\n" . $xml . '</list>';
		} elseif ( Q ( "get.vname" )) {
			$vName = $this->listpage ( Q ( "get.vname" ) );
			echo $vName["vName"];
		} else { // 是否向地址栏传递参数错误
			echo "<m src=\"\" label=\"没有指定地址栏传入参数\" />\n";
		}
	}
	/**
	 * 生成列表
	 * @param  string $id 视频ID
	 * @return array     视频列表及视频名称
	 */
	public function listpage($id) {
		if (preg_match("/[0-9a-z]{32}/Us", $id)){
			$page = file_data("http://share.weiyun.com/" . $id, array(), 0, "", "", "BlackBerry/3.6.0");
			preg_match('/<h3 class="ui-title">(.*)\.flv|\.mp4?<\/h3>/iUs', $page, $arr);
			$vName = $arr[1];
			$xml = '<m type="" src="' . U("Data/Qq/weiyun", array("id" => $id)) . '" label="' . $vName . "\" />\n";
		}else {
			$page = file_data ( $id );
			//http://vv.video.qq.com/geturl?vid=d0013btzhx8
			preg_match ( '/"?title"?\s*:"(.*)",.*vid:"([0-9A-Za-z]+)",/iUs', $page, $arrTitle );
			$vName = $arrTitle[1];
			if (preg_match_all('/<a target="_self" _hot="coverv2.vlisttab.title"\s+href=".*"\s+id="(.*)"\s+title="(.*)"\s+sv/iUs', $page, $arr)){
				$combine = array_combine($arr[1], $arr[2]);
				$xml = "";
				foreach ($combine as $key => $value) {
					$interface = file_data( "http://vv.video.qq.com/geturl?vid=" . $key );
					$obj = simplexml_load_string($interface);
					$src = $obj->vd->vi->url;
					$xml .= '<m type="" src="' . $src . '" stream="true" label="' . $value . "\" />\n";
				}
			}else {
				$interface = file_data( "http://vv.video.qq.com/geturl?vid=" . $arrTitle[2] );
				$obj = simplexml_load_string($interface);
				$src = $obj->vd->vi->url;
				$xml = '<m type="" src="' . $src . '" stream="true" label="' . $arrTitle[1] . "\" />\n";
			}
		}
		return array("xml"=>"<list>\n" . $xml . '</list>', "vName" => $vName);
	}
	/**
	 * 抓取微云真实地址
	 */
	public function weiyun() {
		//http://share.weiyun.com/07c1c7028ff29badbc3d10b839f21d2b
		if (!Q ( "get.id" ))
			$this->error("页面不存在！");
		$key = Q ( "get.id" );
		$referer = "http://share.weiyun.com/" . $key;
		$src = file_data($referer, array(), 1, "", "", "Mozilla/5.0 (iPhone; U; CPU iPhone OS 3_0 like Mac OS X; en-us)");
		preg_match('|shareInfo = (.*);|iUs', $src, $res);
		$json = $res ? json_decode($res[1]) : exit("Can not get shareInfo!");
		p($json);
		$songurl = implode("", array(
			"http://" . $json->dl_svr_host,
			":" . $json->dl_svr_port,
			"/ftn_handler",
			"/" . $json->dl_encrypt_url,
			"?fname=" . urlencode($json->filename),
		));
		go( $songurl );
	}
}
?>