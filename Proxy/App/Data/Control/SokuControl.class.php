<?php
/**
* 搜库
*/
class SokuControl extends CommonControl{
	/**
	 * 默认执行
	 */
	public function index()	{
		header ( "Content-type:text/xml;charset:utf-8;" );
		if ($keywords = Q("get.keywords")) {
			$lists = $this->listpage($keywords);
			echo $lists["xml"];
		} elseif ($key = Q("get.key")) {
			$lists = $this->listpage($key);
			echo $lists["lists"];
		} else {
			$page = file_data("http://www.soku.com/newtop/teleplay.html");
			preg_match_all('/<span class="skey"><a href=".*" target="_blank" title=".*" _log_ct="\d+">(.*)<\/a><\/span>/iUs', $page, $arr);
			$xml = "<list>\n";
			foreach ($arr[1] as $value) {
				$xml .= '<m list_src="' . U("Data/Soku/index", array("key" => $value)) . '" label="' . $value . "\" />\n";
			}
			$xml .= '</list>';
			echo $xml;
		}
	}
	/**
	 * 采集页面
	 */
	public function listpage($keywords){
		if (!$keywords)
			return "关键字错误！";
		$page = file_data("http://www.soku.com/v?keyword=" . urlencode($keywords));
		preg_match('/<li class="p_thumb"><img class="" src=".*" alt="(.*)"><\/li>/iUs', $page, $arr);
		$vName = $arr[1];
		if (preg_match_all('/<span\s+name="(.+)"\s+id="site\d*"><a href="(.*)"\s+_log_title="(.+)"\s+_log_sid.*<img/iUs', $page, $arr)) {
			$ar[] = $arr[2];
			$ar[] = $arr[1];
		} else {
			preg_match_all("/<li(?: class=\"(?:ex|xe)\")?><a href='(.*)'  _log_title='.*' site='(\w+)' _log_type='2' _log_ct='1' _log_pos=1  _log_directpos='4' _log_sid=\"\d+\" _log_cate=\"\d+\" target='_blank'>\d+<\/a><\/li>/iUs", $page, $arr);
			$ar[] = $arr[1];
			$ar[] = $arr[2];
		}
		$array = array();
		foreach ($ar[0] as $key => $value) {
			$k = $ar[1][$key];
			$array[][] = $value;
		}
		$string = "";
		// p($array);die;
		foreach ($array as $value) {
			if (strpos ( $value[0], "56.com" ) > -1) {
		 		$tvtype = "Wuliu";
		 		$page = file_data ( $value[0] );
				preg_match ( '/"opera_id":(\d{4,6}),/iUs', $page, $arr );
				$collect = A ( "Data/" . $tvtype . "/listpage", array ( $arr [1] ) );
				$m = '<m label="' . $vName . "-56\">\n";
		 	} elseif (strpos ( $value[0], "cntv.cn" ) > -1) { // CNTV
		 		$tvtype = "Cntv";
		 		$page = file_data ( $value[0] );
				preg_match ( '/videoCenterId","(\w+)"/iUs', $page, $arr );
				$id = $arr [1];
				$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
				$m = '<m label="' . $vName . "-cntv\">\n";
			} elseif (strpos ( $value[0], "funshion.com" ) > -1) { // 风行
		 		$tvtype = "Funshion";
				$id = substr ( $value[0], 32 );
				$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
				$m = '<m label="' . $vName . "-风行\">\n";
			} elseif (strpos ( $value[0], "iqiyi.com" ) > -1) { // 爱奇艺
		 		$tvtype = "Iqiyi";
				$page = file_data ( $value[0] );
				preg_match ( '/(?:"albumId"\s*:\s*|data-player-albumid="|data-drama-albumid=")(\d+)(?:,|")/iUs', $page, $arr );
				$id = $arr [1];
				$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
				$m = '<m label="' . $vName . "-爱奇艺\">\n";
			} elseif (strpos ( $value[0], "letv.com" ) > -1) { // 乐视
		 		$tvtype = "Letv";
				$page = file_data ( $value[0] );
		 		preg_match ( '/title:"(.*)",\/\/视频名称.*vid:(\d+),\/\/视频ID/iUs', $page, $arr );
				$collect = A ( "Data/" . $tvtype . "/listpage", array ( $arr[2], $arr[1] ) );
				$m = '<m label="' . $vName . "-乐视\">\n";
			} elseif (strpos ( $value[0], "m1905.com" ) > -1) { // M1905
			 	$tvtype = "M1905";
				$page = file_data ( $value[0] );
				preg_match ( "/vid\s*:\s*(?:'|\")(\d{4,8})(?:'|\"),/iUs", $page, $arr );
				$id = $arr [1];
				$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
				$m = '<m label="' . $vName . "-M1905电影网\">\n";
			} elseif (strpos ( $value[0], "pps.tv" ) > -1) { // PPS
			 	$tvtype = "Pps";
				$page = file_data ( $value[0] );
				preg_match ( '/sid:\s?"?(\d+)"?,/iUs', $page, $arr );
				$id = $arr [1];
				$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
				$m = '<m label="' . $vName . "-PPS\">\n";
			} elseif (strpos ( $value[0], "pptv.com" ) > -1) { // PPTV
		 		$tvtype = "Pptv";
				preg_match ( "/page|show\/(.*)\.html/iUs", $value[0], $arr );
				$id = $arr[1];
				$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
				$m = '<m label="' . $vName . "-PPTV\">\n";
		 		break;
		 	} elseif (strpos ( $value[0], "sina.com.cn" )) { // 新浪
				$id = substr ( $value[0], 38 );
				$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
				$m = '<m label="' . $vName . "-新浪\">\n";
			} elseif (strpos ( $value[0], "qq.com" ) > -1) { // 腾讯
		 		$tvtype = "Qq";
		 		$collect = A ( "Data/" . $tvtype . "/listpage", array ( $value[0] ) );
				$m = '<m label="' . $vName . "-腾讯\">\n";
		 	} elseif (strpos ( $value[0], "sohu.com" ) > -1) { // 搜狐
		 		$tvtype = "Sohu";
				$page = file_data ( $value[0], array ( "gbk", "utf-8" ) );
				preg_match ( '/var (?:(?:PLAYLIST_ID)|(?:playlistId))\s*=\s*"(\d+)";/iUs', $page, $arr );
				$id = $arr[1];
				$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
				$m = '<m label="' . $vName . "-搜狐\">\n";
		 	} elseif (strpos ( $value[0], "tudou.com" ) > -1) { // 土豆
			 	$tvtype = "Tudou";
				$id = $value[0];
				$collect = A ( "Data/" . $tvtype . "/GetVideoId", array ( $id ) );
				$m = '<m label="' . $vName . "-土豆\">\n";
		 	} elseif (strpos ( $value[0], "youku.com" ) > -1) { // 优酷
			 	$tvtype = "Youku";
				preg_match ( '/(?:http:\/\/)?(?:www|v)?\.youku\.com\/(?:v_show|show_page)\/id_(\w+)\.html/iUs', $value[0], $arr );
				$id = $arr [1];
				$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
				$m = '<m label="' . $vName . "-优酷\">\n";
			}
			$string .= $m . $collect["lists"] . "</m>\n";
		}
		return array( "xml" => "<list>\n" . $string . "</list>", "lists" => $string, "vName" => $vName);
	}
}
?>