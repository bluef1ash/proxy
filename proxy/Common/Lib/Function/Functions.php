<?php
/**
 * 采集
 * @param string $url URL地址
 * @param array $charset 更改编码数组，依次为原字符编码、转换的字符编码
 * @param int $header 头包含输出
 * @param string $post_fields 通过POST传递字符串
 * @param string $referer 在HTTP请求中包含一“referer”头的字符串
 * @param string $user_agent 包含一个'user-agent'头的字符串
 * @param array $http_header 包含请求头数组
 * @return string|mixed 返回内容
 */
function file_data($url, $charset = array(), $header = 0, $post_fields = "", $referer = "", $user_agent = "", $http_header = array(), $add_array_header = array()) { // 获取视频函数
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
    if ($header)
	    curl_setopt($ch, CURLOPT_HEADER, $header);
    if ($http_header && !empty($http_header))
    	curl_setopt($ch, CURLOPT_HTTPHEADER, $http_header);
    if ($add_array_header && !empty($add_array_header))
    	curl_setopt($ch, CURLOPT_HTTPHEADER, $add_array_header);
    if ($referer)
    	curl_setopt($ch, CURLOPT_REFERER, $referer);
    if ($user_agent)
	    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
    if ($post_fields){
    	curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    }
	$data = curl_exec ( $ch ); // 执行给定的cURL会话
	curl_close ( $ch ); // 关闭CURL会话
	if ($data) { // 采集成功
		if ($charset && !empty($charset))
			return iconv ( $charset[0], $charset[1], $data ); // 检查是否需更改编码
		return $data;
	} else { // 采集失败
		for($i = 0; $i < 3; $i ++) { // 获取尝试
			$data = file_get_contents ( $url ); // 获取网页
			if ($data)
				break; // 获取到停止循环
		}
		if ($charset)
			return iconv( $charset[0], $charset[1], $data ); // 检查是否需更改编码
		return $data;
	}
}
/**
 * 汉字首字转首拼字母
 * @param string $str 要转换的字符串
 * @return string 返回首拼字母
 */
function getinitial($strs) {
	$str = iconv("utf-8", "gbk", $strs);
	$asc = ord ( $str );
	if ($asc < 160) { // 非中文
		switch ($asc) {
			case 48 :
				return 'Ｌ';
				break;
			case 49 :
				return 'Ｙ';
				break;
			case 50 :
				return 'Ｅ';
				break;
			case 51 :
				return 'Ｓ';
				break;
			case 52 :
				return 'Ｓ';
				break;
			case 53 :
				return 'Ｗ';
				break;
			case 54 :
				return 'Ｌ';
				break;
			case 55 :
				return 'Ｑ';
				break;
			case 56 :
				return 'Ｂ';
				break;
			case 57 :
				return 'Ｊ';
				break;
			default :
				return '～';
				break;
		}
		if ($asc >= 65 && $asc <= 90) {
			return SBC_DBC ( chr ( $asc ), 0 ); // A--Z
		} elseif ($asc >= 97 && $asc <= 122) {
			return SBC_DBC ( strtoupper ( chr ( $asc - 32 ) ), 0 ); // a--z
		} else {
			return '~'; // 其他
		}
	} else { // 中文
		$asc = $asc * 1000 + ord ( substr ( $str, 1, 1 ) );
		// 获取拼音首字母A--Z
		if ($asc >= 176161 && $asc < 176197) {
			return 'Ａ';
		} elseif ($asc >= 176197 && $asc < 178193) {
			return 'Ｂ';
		} elseif ($asc >= 178193 && $asc < 180238) {
			return 'Ｃ';
		} elseif ($asc >= 180238 && $asc < 182234) {
			return 'Ｄ';
		} elseif ($asc >= 182234 && $asc < 183162) {
			return 'Ｅ';
		} elseif ($asc >= 183162 && $asc < 184193) {
			return 'Ｆ';
		} elseif ($asc >= 184193 && $asc < 185254) {
			return 'Ｇ';
		} elseif ($asc >= 185254 && $asc < 187247) {
			return 'Ｈ';
		} elseif ($asc >= 187247 && $asc < 191166) {
			return 'Ｊ';
		} elseif ($asc >= 191166 && $asc < 192172) {
			return 'Ｋ';
		} elseif ($asc >= 192172 && $asc < 194232) {
			return 'Ｌ';
		} elseif ($asc >= 194232 && $asc < 196195) {
			return 'Ｍ';
		} elseif ($asc >= 196195 && $asc < 197182) {
			return 'Ｎ';
		} elseif ($asc >= 197182 && $asc < 197190) {
			return 'Ｏ';
		} elseif ($asc >= 197190 && $asc < 198218) {
			return 'Ｐ';
		} elseif ($asc >= 198218 && $asc < 200187) {
			return 'Ｑ';
		} elseif ($asc >= 200187 && $asc < 200246) {
			return 'Ｒ';
		} elseif ($asc >= 200246 && $asc < 203250) {
			return 'Ｓ';
		} elseif ($asc >= 203250 && $asc < 205218) {
			return 'Ｔ';
		} elseif ($asc >= 205218 && $asc < 206244) {
			return 'Ｗ';
		} elseif ($asc >= 206244 && $asc < 209185) {
			return 'Ｘ';
		} elseif ($asc >= 209185 && $asc < 212209) {
			return 'Ｙ';
		} elseif ($asc >= 212209) {
			return 'Ｚ';
		} else {
			return '｀';
		}
	}
}
/**
 * unicode解码
 * @param string $str 要解码的字符串
 * @return string 返回解码后的字符串
 */
function unescape($str) {
	$str = str_replace("&amp;", "&", rawurldecode ( $str ) );
	preg_match_all ( "/%u.{4}|&#x.{4};|&#d+;|.+/U", $str, $r );
	$ar = $r [0];
	foreach ( $ar as $k => $v ) {
		if (substr ( $v, 0, 2 ) == "%u")
			$ar [$k] = iconv ( "UCS-2", "utf-8", pack ( "H4", substr ( $v, - 4 ) ) );
		elseif (substr ( $v, 0, 3 ) == "&#x")
			$ar [$k] = iconv ( "UCS-2", "utf-8", pack ( "H4", substr ( $v, 3, - 1 ) ) );
		elseif (substr ( $v, 0, 2 ) == "&#")
			$ar [$k] = iconv ( "UCS-2", "utf-8", pack ( "n", substr ( $v, 2, - 1 ) ) );
	}
	return join ( "", $ar );
}
/**
 * 下载文件
 * @param string $file_dir 文件所在目录fer_size
 * @param string $file_name 文件名
 * @param string $file_zdname 文件头
 * @return boolean
 */
function xiazai($file_dir, $file_name,$file_zdname){
	$file_dir = chop ( $file_dir ); // 去掉路径中多余的空格，得出要下载的文件的路径
	if ($file_dir != '') {
		$file_path = $file_dir;
		if (substr ( $file_dir, strlen ( $file_dir ) - 1, strlen ( $file_dir ) ) != '/')
			$file_path .= '/';
		$file_path .= $file_name;
	} else
		$file_path = $file_name;
	// 判断要下载的文件是否存在
	if (! file_exists ( $file_path )) {
		echo "<script type='text/javascript'>alert ( '对不起,你要下载的文件不存在' )</script>";
		return false;
	}
	$file_size = filesize ( $file_path );
	header ( "Content-type: application/octet-stream;charset=utf-8" );
	header ( "Accept-Ranges: bytes" );
	header ( "Accept-Length: $file_size" );
	header ( "Content-Disposition: attachment; filename=" . $file_zdname );
	$fp = fopen ( $file_path, "r" );
	$buffer_size = 1024;
	$cur_pos = 0;
	while ( ! feof ( $fp ) && $file_size - $cur_pos > $buffer_size ) {
		$buffer = fread ( $fp, $buf);
		echo $buffer;
		$cur_pos += $buffer_size;
	}
	$buffer = fread ( $fp, $file_size - $cur_pos );
	echo $buffer;
	fclose ( $fp );
	return true;
}
/**
 * 返回数组维数（层级）
 * @param array $arr
 * @return int
 */
function GetArrLv($arr) {
	if (is_array($arr)) {
		function AWRSetNull(&$val) {
			$val = NULL;
		}
		#递归将所有值置NULL，目的1、消除虚构层如array("array(\n  ()")，2、print_r 输出轻松点，
		array_walk_recursive($arr, 'AWRSetNull');
		$ma = array();
		#从行首匹配[空白]至第一个左括号，要使用多行开关'm'
		preg_match_all("'^\(|^\s+\('m", print_r($arr, true), $ma);
		#回调转字符串长度
		//$arr_size = array_map('strlen', current($ma));
		#取出最大长度并减掉左括号占用的一位长度
		//$max_size = max($arr_size) - 1;
		#数组层间距以 8 个空格列，这里要加 1 个是因为 print_r 打印的第一层左括号在行首
		//return $max_size / 8 + 1;
		return (max(array_map('strlen', current($ma))) - 1) / 8 + 1;
	} else {
		return 0;
	}
}
/**
 * 添加数组元素
 * @param string $val 新元素键值
 * @param string $key 新元素键名
 * @param array $param
 */
function addkey(&$val,$key, $param){
	$val[$param["key"]] = $param["val"];
}
?>