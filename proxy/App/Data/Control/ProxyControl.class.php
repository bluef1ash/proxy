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
		if (strpos ( $url,  "yunpan.cn" ) > -1) { // 360
			$tvtype = "yunpan";
			$auto_disabled = 1;
			$id = $url;
			$collect = A ( "Data/Sanliuling/listpage", array ( $id ) );
		} elseif (strpos ( $url, "56.com" ) > -1) { // 56
			$tvtype = "Wuliu";
			if (preg_match ( "/\/(\d{4,6})\.html/iUs", $url, $arr )) {
				$collect = A ( "Data/" . $tvtype . "/listpage", array ( $arr [1] ) );
			} elseif (preg_match ( "/\/v_([0-9A-Za-z]{10,13})\.html/iUs", $url, $arr )) {
				$collect = A ( "Data/" . $tvtype . "/one", array ( $arr [1] ) );
			}
			$id = $arr [1];
		} elseif (strpos ( $url, "baidu.com" ) > -1) { // 百度
			$tvtype = "Baidu";
			$auto_disabled = 1;
			$id = $url;
			$collect = A ( "Data/" . $tvtype . "/wangpan", array ( $id ) );
		} elseif (strpos ( $url, "cntv.cn" ) > -1) { // CNTV
			$tvtype = "Cntv";
			if (strpos ( $url, "video" ) > - 1) {
				$page = file_data ( $url );
				preg_match ( '/videoCenterId","(\w+)"/iUs', $page, $arr );
				$id = $arr [1];
			} else {
				$id = $url;
			}
			$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
		} elseif (strpos ( $url, "400gb.com" ) > -1) { // 城通
			$tvtype = "Chengtong";
			$id = intval(substr($url, 26));
			$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
		} elseif (strpos ( $url, "funshion.com" ) > -1) { // 风行
			$tvtype = "Funshion";
			$id = substr ( $url, 32 );
			$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
		} elseif (strpos ( $url, "fengyunzhibo.com" ) > -1) { // 风云直播
			$tvtype = "Fengyunzhibo";
			$collect = A ( "Data/Live/fengyun", array ( $url ) );
		} elseif (strpos ( $url, "iqiyi.com" ) > -1) { // 爱奇艺
			$tvtype = "Iqiyi";
			$page = file_data ( $url );
			preg_match ( '/(?:"albumId"\s*:\s*|data-player-albumid="|data-drama-albumid=")(\d+)(?:,|")/iUs', $page, $arr );
			$id = $arr [1];
			$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
		} elseif (strpos ( $url, "ku6.com" ) > -1) { // 酷6
			$tvtype = "Ku6";
		} elseif (strpos ( $url, "letv.com" ) > -1) { // 乐视
			$tvtype = "Letv";
			$page = file_data ( $url );
			if (strpos($url, "vplay") > -1) {
				preg_match ( '/title:"(.*)",\/\/视频名称.*vid:(\d+),\/\/视频ID/iUs', $page, $arr );
				$id = $arr[2];
				$name = $arr[1];
			} else {
				preg_match ( '/<div class="showPic" data-itemhldr="a" data-statectn="n_showPic">.*<a href="http:\/\/www\.letv\.com\/ptv\/vplay\/(\d+)\.html" title="(.*)" target="_blank">.*<div class="play"><span class="s-p">立即观看<\/span><span class="s-d"><\/span>/iUs', $page, $arr );
				$id = $arr [1];
				$name = $arr[2];
			}
			$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id, $name ) );
		} elseif (strpos ( $url, "m1905.com" ) > -1) { // M1905
			$tvtype = "M1905";
			$page = file_data ( $url );
			preg_match ( "/vid\s*:\s*(?:'|\")(\d{4,8})(?:'|\"),/iUs", $page, $arr );
			$id = $arr [1];
			$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
		} elseif (strpos ( $url, "pps.tv" ) > -1) { // PPS
			$tvtype = "Pps";
			$page = file_data ( $url );
			preg_match ( '/sid:\s?"?(\d+)"?,/iUs', $page, $arr );
			$id = $arr [1];
			$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
		} elseif (strpos ( $url, "pptv.com" ) > -1) { // PPTV
			$tvtype = "Pptv";
			preg_match ( "/page|show\/(.*)\.html/iUs", $url, $arr );
			$id = $arr[1];
			$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
		} elseif (strpos ( $url, "sina.com.cn" )) { // 新浪
			$tvtype = "Sina";
			$id = substr ( $url, 38 );
			$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
		} elseif (strpos ( $url, "qq.com" ) > -1) { // 腾讯
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
		} elseif (strpos ( $url, "sohu.com" ) > -1) { // 搜狐
			$tvtype = "Sohu";
			if (strpos ( $url, ".shtml" ) > -1) {
				$page = file_data ( $url, array ( "gbk", "utf-8" ) );
			} else {
				$page = file_data ( $url . 'index.shtml', array ( "gbk", "utf-8" ) );
			}
			preg_match ( '/var (?:(?:PLAYLIST_ID)|(?:playlistId))\s*=\s*"(\d+)";/iUs', $page, $arr );
			$id = $arr[1];
			$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
		} elseif (strpos ( $url, "tudou.com" ) > -1) { // 土豆
			$tvtype = "Tudou";
			$id = $url;
			$collect = A ( "Data/" . $tvtype . "/GetVideoId", array ( $id ) );
		} elseif (strpos ( $url, "weiyun.com" )) { // 微云
			$tvtype = "weiyun";
			$auto_disabled = 1;
			$id = substr ( $url, 24 );
			$collect = A ( "Data/Qq/listpage", array ( $id ) );
		} elseif (strpos ( $url, "xunlei.com" ) > -1) { // 迅雷
			$tvtype = "Xunlei";
		} elseif (strpos ( $url, "yinyuetai.com" ) > -1) { // 音悦台
			$tvtype = "Yinyuetai";
			$id = $url;
			$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
		} elseif (strpos ( $url, "youku.com" ) > -1) { // 优酷
			$tvtype = "Youku";
			preg_match ( '#(?:http://)?(?:www|v)?\.youku\.com/(?:v_show|show_page)/id_(\w+\-*=*)\.html#iUs', $url, $arr );
			$id = $arr [1];
			$collect = A ( "Data/" . $tvtype . "/listpage", array ( $id ) );
		} else {
			$tvtype = "Soku";
			$id = $url;
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
		if (strpos ( "http://", $arr [2] ) > -1) {
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