<?php
class LiveControl extends Control {
	public function index() {
	}
	/**
	 * 获取风云直播ID
	 * @param  string $url 直播URL
	 * @return array     直播ID及频道名称
	 */
	public function fengyun($url) {
		$page = file_data ( $url );
		preg_match ( '/cid:\s*"([_\d]+)",.*channelname: "(.*)",/iUs', $page, $arr );
		return array("xml"=>$arr[1] , "vName"=>$arr[2]);
	}
	/**
	 * 跳转风云直播
	 * @param  string $id 直播ID
	 * @return [type]     [description]
	 */
	public function getfy() {
		if (! IS_GET)
			$this->error ( "页面不存在！" );
		$id = $this->_get ( "id" );
		$file = "http://resource.ws.kukuplay.com/players/2013/09/04/40806/fengyun.swf?cid=" . $id;
		header ( "Location:" . $file );
		// header("Content-Type: application/x-shockwave-flash");
		/*
		 * echo '<script type="text/javascript"> location="http://resource.ws.kukuplay.com/players/2013/09/04/40806/fengyun.swf?cid='.$this->_get("id").'"; </script>';
		 */
	}
	/**
	 * 电视台回播
	 * @return [type] [description]
	 */
	public function huibo() {
		header ( 'Content-type:text/xml;charset:utf-8;filename:回播代理.xml' ); // 定义文件头
		echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n";
		if ($this->_get("key"))
			echo $this->cctv_key ( $this->_get("key") );
		elseif ($this->_get("name") && $this->_get("date"))
			echo $this->cctv_date ( $this->_get("name"), $this->_get("date") );
		elseif ($this->_get("channel") && $this->_get("playtime"))
			$this->cctv_play ( $this->_get("channel"), $this->_get("playtime") );
		else 
			echo $this->defaultXml ();
	}
	/**
	 * 生成单个合并列表
	 * @param  string $channel  频道名称
	 * @param  string $playtime 播放日期
	 */
	private function cctv_play($channel, $playtime) {
		$t = explode ( '-', $playtime );
		$vdn = 'http://vdn.apps.cntv.cn/api/liveback.do?channel=' . $channel . '&starttime=' . $t [0] . '&endtime=' . $t [1] . '&from=web';
		$vx = json_decode ( file_data ( $vdn ) )->video->chapters;
		$du = 0;
		$by = 0;
		$byt = 16101;
		$x = '<m starttype="0" label="" type="mp4" bytes="' . $by . '" duration="' . $du . "\" bg_video=\"\" lrc=\"\">\n";
		foreach ( $vx as $v ) {
			$dur = $v->duration;
			$by += $byt;
			$du += $dur;
			$x .= '<u bytes="' . $byt . '" duration="' . $dur . '" src="' . $v->url . "?start={start_seconds}\" />\n";
		}
		$x .= '</m> ';
		echo $x;
	}
	/**
	 * 生成一日节目列表
	 * @param  string $name 节目名称
	 * @param  string $date 播放日期
	 * @return string $x 播放列表
	 */
	private function cctv_date($name, $date) {
		$xmlUrl = 'http://ipad.cntv.cn/nettv/2011jiemudan/xmldata/' . str_replace("-", "/", $date) . '/' . $name . '.xml';
		$sim = simplexml_load_string ( file_data ( $xmlUrl ) )->programsback->program;
		$name = explode("=", $sim->attributes ()->url);
		$name = end ( $name );
		$x = "<list>\n";
		$today = date ( "Y-m-d" );
		$hour = strtotime ( date ( "H:i" ) );
		if ($date == $today)
			$bool = true;
		foreach ( $sim as $si ) {
			$atr = $si->attributes ();
			if ($bool) {
				if (strtotime ( $atr->showTime ) > $hour) {
					break;
				}
			}
			$x .= '<m label="' . $atr->title . '-' . $atr->showTime . '" type="merge"  src="'. U("data/live/huibo", array("channel"=>$name,"playtime"=>$atr->starttime . '-' . $atr->endtime )) . "\" />\n";
		}
		$x .= '</list>';
		return $x;
	}
	/**
	 * 生成总节目列表
	 * @param  string $key 频道名称
	 * @return string $list 总节目列表
	 */
	private function cctv_key($key) {
		$Y = date ( "Y" );
		$m = date ( "m" );
		$d = date ( "d" );
		$list = "<list>\n";
		$mon = 7; // 设置每个节目显示天数 最大为30天，最小为2
		if ($d >= $mon) {
			for($i = $d + 0; $i > $d - $mon; $i --) {
				$k = $this->hh ( $i );
				$riqi = $Y.'-'.$m.'-'.$k;
				$list .= '<m label="'.$riqi.'" list_src="' . U("data/live/huibo", array("name"=>$key,"date"=>$riqi)) . "\" />\n";
			}
		} else {
			for($i = $d + 0; $i > 0; $i --) {
				$k = $this->hh ( $i );
				$riqi = $Y.'-'.$m.'-'.$k;
				$list .= '<m label="'.$riqi.'" list_src="' . U("data/live/huibo", array("name"=>$key,"date"=>$riqi)) . "\" />\n";
			}
			$j = $this->hh ( $m - 1 );
			$lm = $Y.'-'.$j.'-'.$d;
			$days = date ( 't', strtotime ( "$lm" ) ); // 获取上个月天数
			for($i = $days; $i > $days + $d - $mon; $i --) {
				$k = $this->hh ( $i );
				$riqi = $Y.'-'.$m.'-'.$k;
				$list .= '<m label="'.$riqi.'" list_src="' . U("data/live/huibo", array("name"=>$key,"date"=>$riqi)) . "\" />\n";
			}
		}
		return $list . "</list>";
	}
	/**
	 * 24小时制转12小时制
	 * @param  int $hour 24小时
	 * @return int 12小时制
	 */
	private function hh($hour) {
		return str_pad ( $hour, 2, "0", STR_PAD_LEFT );
	}
	/**
	 * 生成频道名称列表
	 * @return string $x 返回生成的列表
	 */
	private function defaultXml() {
		$array = array (
				'cctv1' => 'CCTV-1综合频道',
				'cctv2' => 'CCTV-2财政频道',
				'cctv3' => 'CCTV-3综艺频道',
				'cctv4' => 'CCTV-4中文国际',
				'cctv5' => 'CCTV-5体育频道',
				'cctv6' => 'CCTV-6电影频道',
				'cctv7' => 'CCTV-7军事农业',
				'cctv8' => 'CCTV-8影剧频道',
				'cctv9d' => 'CCTV-纪录',
				'cctv10' => 'CCTV-10科教频道',
				'cctv11' => 'CCTV-11戏曲频道',
				'cctv12' => 'CCTV-12社会与法',
				'cctvgaoqing' => 'CCTV-HD高清频道',
				'cctvchildren' => 'CCTV-14少儿频道',
				'cctvmusic' => 'CCTV-15音乐频道',
				'cctv9' => 'CCTV-NEWS',
				'cctv13' => 'CCTV-新闻',
				'cctvf' => 'CCTV-法语',
				'cctvarabic' => 'CCTV-阿拉伯语',
				'russian' => 'CCTV-俄语',
				'cctve' => 'CCTV-西语',
				'btv1' => '北京卫视',
				'shanghai' => '东方卫视',
				'tianjin' => '天津卫视',
				'chongqing' => '重庆卫视',
				'sichuan' => '四川卫视',
				'hunan' => '湖南卫视',
				'guangdong' => '广东卫视',
				'hebei' => '河北卫视',
				'shanxi1' => '山西卫视',
				'liaoning' => '辽宁卫视',
				'jilin' => '吉林卫视',
				'zhejiang' => '浙江卫视',
				'anhui' => '安徽卫视',
				'dongnan' => '东南卫视',
				'jiangxi' => '江西卫视',
				'shandong' => '山东卫视',
				'henan' => '河南卫视',
				'hubei' => '湖北卫视',
				'luyou' => '旅游卫视',
				'yunnan' => '云南卫视',
				'shanxi2' => '陕西卫视',
				'gansu' => '甘肃卫视',
				'qinghai' => '青海卫视',
				'guangxi' => '广西卫视',
				'ningxia' => '宁夏卫视',
				'guizhou' => '贵州卫视',
				'heilongjiang' => '黑龙江卫视',
				'neimenggu' => '内蒙古卫视',
				'xinjiang' => '新疆卫视' 
		);
		$x = "<list>\n";
		foreach ( $array as $k => $v ) {
			$x .= '<m list_src="' . U("data/live/huibo", array("key"=>$k)) .'" label="'.$v."\"/>\n";
		}
		$x .= '</list>';
		return $x;
	}
}
?>