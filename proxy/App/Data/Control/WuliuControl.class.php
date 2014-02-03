<?php
/**
 * 56视频采集控制器
 */
class WuliuControl extends Control {
	/**
	 * 默认执行
	 */
	public function index() {
		header ( 'Content-type:text/xml;charset:utf-8;filename:56代理.xml' ); // 定义文件头
		echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n"; // 输出XML格式
		if ($id = Q ( "get.id" )) { // 是否向地址栏传递URL参数
			$xml = $this->cache_collect("tudou_" . $id);
			if ($xml != 1 && !$xml) {
				echo $xml;
			}else{
				if (preg_match("/^\d{4,6}$/iUs", $id)){
					$xml = $this->listpage ( $id )["xml"];
				}else{
					$xml = $this->one($id)["xml"];
				}
				$this->cache_collect($id, 1, $xml, "tudou_");
				echo $xml;
			}
		} elseif (Q ( "get.top" )) {
			echo $this->top ( Q ( "get.top" ) );
		} elseif (Q ( "get.vname" )) {
			echo $this->listpage ( Q ( "get.vname" ) )["vName"];
		} else { // 没有向地址栏进行传递参数
			echo $this->top ( 1 );
		}
	}
	/**
	 * 生成列表
	 * @param  string $id 视频ID
	 * @return array     视频列表及视频名称
	 */
	public function listpage($id) {
		$page = file_data ( "http://so.56.com/api_s/operaNew.php?key=&mid=" . $id . ".html" );
		$obj = json_decode ( $page );
		$data = $obj->data;
		$xml = "";
		$vName = $obj->name;
		foreach ( $data as $value ) {
			// $wd = str_replace ( '_wd4', '', $url );
			$xml .= $this->one($value->vid)["lists"];
		}
		return array("xml"=>"<list>\n".$xml.'</list>',"vName"=>$vName);
	}
	/**
	 * 生成单个视频列表
	 * @param  string $id 视频ID
	 * @return array     视频列表及视频名称
	 */
	public function one($id) {
		$content = file_data ( 'http://vxml.56.com/json/' . $id . '/?src=out' );
		$data = json_decode ( $content );
		$wd2 = $data->info->rfiles;
		$name = $data->info->Subject;
		$video = $wd2 [1]->url;
		$xml = "<m type=\"2\" src=\"" . $video . "\" label=\"" . $name . "\" />\n";
		return array("lists"=>$xml,"xml"=>"<list>\n".$xml.'</list>',"vName"=>$name);
	}
	/**
	 * 生成排行榜
	 * @param  string $top 生成的页数
	 * @return string 返回视频列表
	 */
	private function top($top) {
		$page = file_data ( 'http://video.56.com/tv-v-tv_sort-v_tid-_zid-_yid-_page-' . $top . '.html', true );
		$preg = '#<a target="_blank" href="http://video.56.com/opera/(\d+).html">(.*)</a>#iUs';
		preg_match_all ( $preg, $page, $arr );
		// var_dump($arr);
		$combine = array_combine ( $arr [1], $arr [2] );
		foreach ( $combine as $key => $value ) {
			$interface = file_data ( 'http://so.56.com/api_s/operaNew.php?key=&mid=' . $key . '.html' );
			$obj = json_decode ( $interface );
			$data = $obj->data;
			foreach ( $data as $v ) {
				$vid = $v->vid;
				$nameList = iconv ( 'utf-8', 'gbk', $v->title );
				$xml .= '<m type="" src="http://vxml.56.com/m3u8/' . $vid . '/?appkey=3000001777" label="' . $value . '  ' . $nameList . "\" />\n";
			}
			$lists .= '<m label="' . $value . "\">\n" . $xml . "</m>\n";
			$xml = '';
		}
		return "<list>\n" . $lists . '</list>';
	}
}
?>