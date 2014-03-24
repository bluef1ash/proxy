<?php
/**
 * 360采集控制器
 */
class SanliulingControl extends CommonControl {
	/**
	 * 获取360云盘真实地址
	 */
	public function yunpan() {
		//http://awsyupt4tp.l20.yunpan.cn/lk/QUanibVsqJAd8
		if (! $FileId = Q ( "get.id" ))
			$this->error ( "页面不存在！" );
		$http_header = array('User-Agent:Mozilla/5.0 (iPhone; U; CPU iPhone OS 3_1_2 like Mac OS X; en-us) AppleWebKit/528.18 (KHTML, like Gecko) Version/4.0 Mobile/7D11 Safari/528.16');
		$HeadInfo = file_data ( $FileId, array(), 0, "", "", "", $http_header );
		if (empty($HeadInfo)) {
			$page = file_data( $FileId, array(), 1 );
			preg_match("|http:\/\/\w+\.\w+\.yunpan\.cn\/lk\/\w+|", $page, $arr);
			$HeadInfo = file_data ( $arr[0], array(), 0, "", "", "", $http_header );
		}
		$preg = "|SYS_CONF = {[^}]+surl: '(\w+)'[^}]+nid : '(\d+)'[^}]+}|";
		preg_match($preg, $HeadInfo, $arr);
		$nid = $arr[2] ? $arr[2] : exit('ERROR code: Not found SYS_CONF {nid}');
		$shorturl = $arr[1] ? $arr[1] : exit('ERROR code: Not found SYS_CONF {shorturl}');
		$preg = '|(http:\/\/\w+\.\w+\.yunpan\.cn)\/lk\/\w+|';
		if(strpos($FileId, "yunpan.cn/lk") < 0){
			$postht_get = file_data($FileId, array(), 1);
			preg_match($preg, $postht_get, $arr);
			$post_url = $arr[1] . '/share/downloadfile/';
		}else{
			preg_match($preg, $FileId, $arr);
			$post_url=$arr[1] . '/share/downloadfile/';
		}
		$post_data = array('nid' => $nid, 'shorturl' => $shorturl);
		$useragent = "BlackBerry/3.6.0";
		$rt = file_data($post_url, array(), 0, $post_data, $FileId, $useragent);
		$obj = json_decode($rt);
		$errmsg = $obj->errmsg;
		if(strpos($errmsg, "OK") > -1 || strpos($errmsg, "成功") > -1){
			$dll = $obj->data->downloadurl;
			$dl_out = $dll ? $dll : exit('Can not get YunPan Download url!') ;
			go($dl_out);
		}else{
			header("Content-Type: text/html; charset=utf-8");
			echo '360云盘：' . $errmsg;
		}
	}
	/**
	 * 生成列表
	 * @param  string $id 视频ID
	 * @return array 视频列表及视频名称
	 */
	public function listpage($id){
		$page = file_data($id);
		preg_match("/name : '(.*)\.flv|\.mp4?',/iUs", $page, $arr);
		$vName = $arr[1];
		$flv = preg_replace("/(yunpan)\/(id)\/(.*)\.html/iUs", "\\1?\\2=\\3", U("Data/Sanliuling/yunpan", array("id"=>$id)));
		$xml = '<m type="" src="' . $flv . '" label="' . $vName . "\" />\n";
		return array("xml" => "<list>\n" . $xml . "</list>", "vName" => $vName);
	}
}
?>