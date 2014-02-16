<?php
/**
 * 土豆视频采集控制器
 */
class TudouControl extends CommonControl {
	/**
	 * 默认执行
	 */
	public function index() {
		header ( 'Content-type:text/xml;charset:utf-8;filename:土豆代理.xml' ); // 定义文件头
		echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n"; // 输出XML格式
		if ( $id = Q ( "get.id" )) {
			$xml = $this->cache_collect("tudou_" . $id);
			if ($xml != 1 && !$xml) {
				echo $xml;
			}else{
				$xml = $this->GetVideoId($id);
				$xml = $xml["xml"];
				$this->cache_collect($id, 1, $xml, "tudou_");
				echo $xml;
			}
		} elseif (Q ( "get.page" )) { // 是否向地址栏传递PAGE参数
			$top = file_data ( 'http://www.tudou.com/cate/chach30a-2b-2c-2d-2e-2f-2g-2h-2i-2j-2k-2l-2m-2n-2o-2so1pe-2pa' . Q ( "get.page" ) . '.html' ); // 采集电视剧页面
			$preg = '#<a href="(http://www.tudou.com/albumcover/\w+.html)" title="(.*)" target="_blank">.*</a>#iUs';
			preg_match_all ( $preg, $top, $arrTop );
			$arrCombine = array_combine ( $arrTop [1], $arrTop [2] );
			$xml = "";
			foreach ( $arrCombine as $key => $value ) {
				$xml .= '<m label="' . $value . "\">\n" . $this->listpage ( $key )["xml"] . "</m>\n";
			}
			echo "<list>\n" . $xml . '</list>';
		} elseif (Q ( "get.vname" )) {
			$vName = $this->listpage ( Q ( "get.vname" ) );
			echo $vName["vName"];
		} else { // 没有向地址栏进行传递参数
			$top = file_data ( 'http://www.tudou.com/cate/chach30a-2b-2c-2d-2e-2f-2g-2h-2i-2j-2k-2l-2m-2n-2o-2so1pe-2pa1.html' ); // 采集电视剧页面
			$preg = '#<a href="(http://www.tudou.com/albumcover/\w+.html)" title="(.*)" target="_blank">.*</a>#iUs';
			preg_match_all ( $preg, $top, $arrTop );
			$arrCombine = array_combine ( $arrTop [1], $arrTop [2] );
			$xml = "";
			foreach ( $arrCombine as $key => $value ) {
				$lists = $this->listpage ( $key );
				$xml .= '<m label="' . $value . "\">\n" . $lists["xml"] . "</m>\n";
			}
			echo "<list>\n" . $xml . '</list>';
		}
	}
	/**
	 * 生成列表
	 * @param  string $vid 视频ID
	 * @return array     视频列表及视频名称
	 */
	public function listpage($vid){
		$ids = explode('_', $vid);
		$vName=$ids[2];
		if ($ids[0]=='iid'){
			$xml='<m type="tudou" src="http://v2.tudou.com/v?it='.$ids[1].'" label="'.$ids[2]."\" />\n";
		}elseif ($ids[0]=='pid'){
			$xml='<m type="youku" src="'.$ids[1].'" label="'.$ids[2]."\" />\n";
		}else{
			if ($ids[0]=='lid'){
				$type = "tudou";
				$code = 'iid';
				$url = 'http://www.tudou.com/tvp/plist.action?l='.$ids[1];
				$proxyw = 'http://v2.tudou.com/v?it=';
			}else{
				$type = 'tudou';
				$code = 'iid';
				$url = 'http://www.tudou.com/tvp/alist.action?a='.$ids[1];
				$proxyw = 'http://v2.tudou.com/v?it=';
			}
			$json = json_decode(file_data($url))->items;
			if (count($json)==1){
				$name=$json[0]->kw;
				$xml='<m type="'.$type.'" src="'.$json[0]->$code.'" label="'.$name."\" />\n";
			}else{
				$xml = "";
				foreach ($json as $value){
					$name=$value->kw;
					$xml.='<m type="'.$type.'" src="'.$value->$code.'" label="'.$name."\" />\n";
				}
			}
		}
		return array("xml"=>"<list>\n".$xml.'</list>',"vName"=>$vName);
	}
	/**
	 * 判断视频类型
	 * @param string $url 视频URL
	 * @return string 返回列表
	 */
	public function GetVideoId($url){
		if (strpos($url, '/listplay/')){
			$type = 'lid';
			$mat = '|,lid\s*=\s*(\d+)\s*\n+.*lkw\s*=\s*"(.*)"|iUs';
		}elseif (strpos($url, '/programs/')){
			$type = 'iid';
			$mat = "|iid:\s?(\d+)\s*\n+.*,kw:\s?'(.*)'|iUs";
		}elseif (strpos($url, '/albumcover/')){
			$type = 'aid';
			$mat = "|aid:\s?'(\d+)',.*title:\s?'(.*)',|iUs";
		}elseif (strpos($url, '/albumplay/')){
			$type = 'pid';
			$mat = "|,vcode:\s?'(\w+)'.*,kw:\s?\"(.*)\"|iUs";
		}
		if ($mat){
			if (preg_match($mat, file_data($url), $vid)) $arr = $type.'_'.$vid[1].'_'.$vid[2];
			if (!$arr)
				return $this->listpage($arr);
		}else{
			die('暂时不支持该格式的采集。');
		}
	}
}
?>