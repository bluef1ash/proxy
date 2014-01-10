<?php
class BaiduControl extends Control {
	/**
	 * 默认代理
	 * @return [type] [description]
	 */
	public function index() {
	}
	public function wangpan() {
		$query = $this->_server('QUERY_STRING');
		if (preg_match ( "/^[0-9A-Za-z]{5,8}$/iUs", $query )) {
			$url = 'http://pan.baidu.com/s/' . $query;
		} else {
			parse_str ( $query );
			if (! $shareid || ! $uk)
				list ( $shareid, $uk ) = explode ( '/', $query );
			if ($shareid && $uk)
				$url = 'http://pan.baidu.com/share/link?shareid=' . $shareid . '&uk=' . $uk;
		}
		$page = file_data ( $url );
		preg_match ( '/;;_dlink="(.*)";if/iUs', $page, $dlink );
		header ( "location:" . stripslashes ( stripslashes ( $dlink [1] ) ) );
	}
	/**
	 * 单个执行
	 * @param  string $id 影片ID
	 * @return [type]     [description]
	 */
	public function listpage($id){
		$page = file_data($id);
		preg_match ( '/server_filename="(.*)";/iUs', $page, $arr );
		$share = strpos ( $url, 'shareid=' );
		if ($share > 0) {
			$id = str_replace ( '&uk=', '/', substr ( $url, $share + 8 ) );
		} else {
			$id = substr ( $url, 24 );
		}
		$xml = '<m type="2" src="' . U ( "wangpan", array( $id ) ) . '" label="' . $vName . "\" />\n";
		return array("xml"=>$xml,"vName"=>$vName);
	}
}
?>