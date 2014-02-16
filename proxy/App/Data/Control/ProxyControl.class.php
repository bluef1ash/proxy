<?php
/**
 * 总控采集控制器
 */
class ProxyControl extends CommonControl {
	/**
	 * 采集分配
	 * @param string $url URL地址
	 * @param string $update 更新方式
	 * @return string 返回列表代码
	 */
	public function index($url, $update = "") {
		if (! $url)
			$this->error ( "页面不存在！" );
		$auto_disabled = 0;
		if (strpos ( $url,  "yunpan.cn" ) > 0) { // 360
			$tvtype = "yunpan";
			$auto_disabled = 1;
			$id = $url;
			$collect = A ( "Data/Sanliuling/listpage", array ( $id ) );
		} elseif (strpos ( $url, "56.com" ) > 0) { // 56
			$tvtype = "Wuliu";
			if (preg_match ( "/\/(\d{4,6})\.html/iUs", $url, $arr )) {
				$collect = A ( "Data/" . $tvtype . "/listpage", array ( $arr [1] ) );
			} elseif (preg_match ( "/\/v_([0-9A-Za-z]{10,13})\.html/iUs", $url, $arr )) {
				$collect = A ( "Data/" . $tvtype . "/one", array ( $arr [1] ) );
			}
			$id = $arr [1];
		} elseif (strpos ( $url, "baidu.com" ) > 0) { // 百度
			$tvtype = "Baidu";
			$auto_disabled = 1;
			$id = $url;
			$collect = A ( "Data/" . $tvtype . "/wangpan", array ( $id ) );
		} elseif (strpos ( $url, "cntv.cn" ) > 0) { // CNTV
			$tvtype = "Cntv";
			if (strpos ( $url, "video" ) > - 1) {
				$page = file_data ( $url );
				preg_match ( '/videoCenterId","(\w+)"/iUs', $page, $arr );
				$id = $arr [1];
			} else {
				$id = $url;
			}
			$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
		} elseif (strpos ( $url, "funshion.com" ) > 0) { // 风行
			$tvtype = "Funshion";
			$id = substr ( $url, 32 );
			$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
		} elseif (strpos ( $url, "fengyunzhibo.com" ) > 0) { // 风云直播
			$tvtype = "Fengyunzhibo";
			$collect = A ( "Data/Live/fengyun", array ( $url ) );
		} elseif (strpos ( $url, "iqiyi.com" ) > 0) { // 爱奇艺
			$tvtype = "Iqiyi";
			$page = file_data ( $url );
			preg_match ( '/(?:"albumId"\s*:\s*|data-player-albumid="|data-drama-albumid=")(\d+)(?:,|")/iUs', $page, $arr );
			$id = $arr [1];
			$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
		} elseif (strpos ( $url, "ku6.com" ) > 0) { // 酷6
			$tvtype = "Ku6";
		} elseif (strpos ( $url, "letv.com" ) > 0) { // 乐视
			$tvtype = "Letv";
			$page = file_data ( $url );
			preg_match ( "/pid\s*:\s*(?:'|\")?(\d{4,6})(?:'|\")?\s*(?:,|(?:,\/\/专辑ID)|(?:\/\/专辑ID))/iUs", $page, $arr );
			$id = $arr [1];
			if (preg_match("/vid\s*:\s*(\d{7}),\s*\/\/视频ID.*trylook:[1-9]\d*,\/\/十分钟试看/iUs", $page, $arr)) {
				$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id, $arr[1] ) );
			}else{
				$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
			}
		} elseif (strpos ( $url, "m1905.com" ) > 0) { // M1905
			$tvtype = "M1905";
			$page = file_data ( $url );
			preg_match ( "/vid\s*:\s*(?:'|\")(\d{4,8})(?:'|\"),/iUs", $page, $arr );
			$id = $arr [1];
			$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
		} elseif (strpos ( $url, "pps.tv" ) > 0) { // PPS
			$tvtype = "Pps";
			$page = file_data ( $url );
			preg_match ( '/sid:\s?"?(\d+)"?,/iUs', $page, $arr );
			$id = $arr [1];
			$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
		} elseif (strpos ( $url, "pptv.com" ) > 0) { // PPTV
			$tvtype = "Pptv";
			preg_match ( "/page|show\/(.*)\.html/iUs", $url, $arr );
			$id = $arr[1];
			$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
		} elseif (strpos ( $url, "sina.com.cn" )) { // 新浪
			$tvtype = "Sina";
			$id = substr ( $url, 38 );
			$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
		} elseif (strpos ( $url, "qq.com" ) > 0) { // 腾讯
			$tvtype = "Qq";
			if (strpos($url, "cover") > -1) {
				$id = $url;
			}else{
				$page = file_data ( $url );
				if (! preg_match ( '/<div class="mod_play">\n*\s*<a href="(.*)" class="btn_play_big" title=".*"><span>.*<\/span><\/a>/iUs', $page, $arr ))
					preg_match ( "/<a target='_blank' rel='bookmark' title='.*' href='(.*)'>/iUs", $page, $arr );
				$id = 'http://v.qq.com' . $arr [1];
			}
			$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
		} elseif (strpos ( $url, "sohu.com" ) > 0) { // 搜狐
			$tvtype = "Sohu";
			if (strpos ( $url, ".shtml" ) > 0) {
				$page = file_data ( $url, array ( "gbk", "utf-8" ) );
			} else {
				$page = file_data ( $url . 'index.shtml', array ( "gbk", "utf-8" ) );
			}
			preg_match ( '/var (?:(?:PLAYLIST_ID)|(?:playlistId))\s*=\s*"(\d+)";/iUs', $page, $arr );
			$id = $arr[1];
			$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
		} elseif (strpos ( $url, "tudou.com" ) > 0) { // 土豆
			$tvtype = "Tudou";
			$id = $url;
			$collect = A ( "Data/" . $tvtype . "/GetVideoId", array ( $id ) );
		} elseif (strpos ( $url, "weiyun.com" )) { // 微云
			$tvtype = "weiyun";
			$auto_disabled = 1;
			$id = substr ( $url, 24 );
			$collect = A ( "Data/Qq/listpage", array ( $id ) );
		} elseif (strpos ( $url, "xunlei.com" ) > 0) { // 迅雷
			$tvtype = "Xunlei";
		} elseif (strpos ( $url, "yinyuetai.com" ) > 0) { // 音悦台
			$tvtype = "Yinyuetai";
			$id = $url;
			$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
		} elseif (strpos ( $url, "youku.com" ) > 0) { // 优酷
			$tvtype = "Youku";
			preg_match ( '#(?:http://)?(?:www|v)?\.youku\.com/(?:v_show|show_page)/id_(\w+\-*=*)\.html#iUs', $url, $arr );
			$id = $arr [1];
			$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
		}
		$xml = $collect ["xml"];
		$vName = $collect ["vName"];
		if ($auto_disabled)
			$update = "static";
		if ($update == "auto")
			$xml = "<list>\n<m list_src=\"{" . strtolower(  $tvtype ) . "}" . $id . '" label="' . $vName . "\" />\n</list>";
		return array (
			"auto_disabled" => $auto_disabled,
			"xml" => "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n" . $xml,
			"vName" => $vName
		);
	}
	/**
	 * 盗取列表
	 * @param string $url 要盗取列表的URL地址
	 * @return string 返回被盗取的列表及被替换后的URL地址
	 */
	public function collect($url) {
		if (! $url)
			$this->error ( "页面不存在" );
		$yy = unescape ( $url );
		preg_match ( "/^(http:\/\/.*)\/[0-9A-Za-z]+\.swf.*lists=(.*\.(?:xml|swf|txt))(?:\&\.swf)?/iUs", $yy, $arr );
		if (strpos ( "http://", $arr [2] ) > 0) {
			$ur = $arr [2];
		} else {
			$ur = $arr [1] . '/' . $arr [2];
		}
		$xml = file_data ( $ur, array (	"gbk", "utf-8" ) );
		$yy_u = "[flash]http://afp.qiyi.com/main/c?db=qiyiafp&bid=1,1,1&cid=1,1,1&sid=0&url=http://player.qlyewu.com/cmp.swf?&url=config/6400.xml&lists=" . $ur . "&.swf|626|500[/flash]";
		$yy_url = $yy_u . "\n\n" . $xml;
		return $yy_url;
	}
}
?>