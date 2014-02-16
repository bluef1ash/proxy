<?php
/**
 * PPTV采集控制器
 */
class SanliulingControl extends CommonControl {
	/**
	 * 获取360云盘真实地址
	 */
	public function yunpan() {
		//http://awsyupt4tp.l20.yunpan.cn/lk/QUanibVsqJAd8
		if (! $FileId = Q ( "get.id" ))
			$this->error ( "页面不存在！" );
		$HeadInfo = file_data ( 'http://yunpan.cn/lk/' . $FileId, array(), 1, "", "", Q ( "server.HTTP_USER_AGENT" ) );
		preg_match ( '|Location: (http://(.*?)\.yunpan\.cn/lk/\w+)|', $HeadInfo, $url );
		preg_match ( "|nid : '(\d+)',|", file_data ( $url [1], array(), 0, "", "", Q ( "server.HTTP_USER_AGENT" ) ), $nid );
		$PostDat = "shorturl=$FileId&nid=$nid[1]";
		$Request = "http://" . $url [2] . ".yunpan.cn/share/downloadfile/";
		$JsonDat = file_data ( $Request, array(), 0, $PostDat, $url [1], Q ( "server.HTTP_USER_AGENT" ) );
		$down = json_decode ( $JsonDat )->data->downloadurl;
		if ($down){
			go($down);
		}else {
			json_decode ( $JsonDat )->errmsg;
		}
	}
	/**
	 * 生成列表
	 * @param  string $id 视频ID
	 * @return array     视频列表及视频名称
	 */
	public function listpage($id){
		preg_match("/lk\/([0-9A-Za-z]{13})/iUs", $id, $ids);
		$page = file_data($id);
		preg_match("/name : '(.*)\.flv|\.mp4?',/iUs", $page, $arr);
		$vName = $arr[1];
		$xml = '<m type="" src="'.U("Data/Sanliuling/yunpan", array("id"=>$ids[1])).'" label="'.$vName."\" />\n";
		return array("xml"=>"<list>\n".$xml."</list>","vName"=>$vName);
	}
}
?>