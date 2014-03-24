<?php
/**
 * 应用组公共控制器
 */
class AuthControl extends Control{
	/**
	 * 上传前缀
	 */
	public function upload_prefix(){
		if ( C("UPLOAD_REPLACE_ON") ) {
			$prefix = C("UPLOAD_URL_PREFIX");
		}else{
			$prefix = C("UPLOAD_URL_PREFIX") . C("CMP_ROOT");
		}
		return $prefix;
	}
	/**
	 * 输出视频列表
	 */
	public function out_video($content, $cachetime)	{
		$xml = explode("\n", htmlspecialchars_decode(str_replace("&amp;", "&", $content)));
		$lists = "";
		foreach ($xml as $value) {
			$m = explode("#", $value);
			$obj = "";
			foreach ($m as $v) {
				if (strpos($v, "m_label") > -1) {
					if (strpos($v, "_color") > -1) {
						$preg = "/m_label=(.*)_color=(.*),/iUs";
						$replace = '<m label="\\1" color="\\2">' . "\n";
					} else {
						$preg = "/m_label=(.*),/iUs";
						$replace = '<m label="\\1">' . "\n";
					}
					$obj .= preg_replace($preg, $replace, $v);
				} elseif (strpos($v, "list_src") > -1) {
					if ($cachetime) {
						$obj .= '<m list_src="' . preg_replace("/list_src=(.*)/iUs", '\\1', $v) . '/cachetime/' . $cachetime . '"';
					} else {
						$obj .= '<m list_src="' . preg_replace("/list_src=(.*)/iUs", '\\1', $v) . '"';
					}
				} elseif (strpos($v, "type") > -1) {
					$obj .= '<m type="' . preg_replace("/type=(.*)/iUs", '\\1', $v) . '"';
				} elseif (strpos($v, "src") > -1) {
					$obj .= ' src="' . preg_replace("/src=(.*)/iUs", '\\1', $v) . '"';
				} elseif (strpos($v, "label") > -1) {
					$obj .=  ' label="' . preg_replace("/label=(.*)/iUs", '\\1', $v) . '"';
				} elseif (strpos($v, "stream") > -1) {
					$obj .= ' stream="' . preg_replace('/stream=(true|1|false|0)/iUs', '\\1', $v) . '"';
				} elseif (strpos($v, "color") > -1) {
					$obj .= ' color="' . preg_replace('/color=(.*)/iUs', '\\1', $v) . '"';
				} elseif (strpos($v, "/m") > -1) {
					$obj .= preg_replace('/\/m,?/', "</m>\n", $v);
				}
				if (strpos($v, ",") > -1)
					$obj = str_replace(',"', "\" />\n", $obj);
				$lists .= $obj;
				$obj = "";
			}
		}
		if (!preg_match("/>/iUs", substr($lists, -3)))
			$lists .= " />\n";
		return $lists;
	}
	/**
	 * 上传视频列表处理
	 */
	public function upload_video($xml){
		preg_match('/(?:&lt;\?xml\sversion=&quot;1\.0&quot;\s+encoding=&quot;utf-8&quot;\s+\?&gt;)?&lt;list&gt;[\r\t\n\s]*(.*)&lt;\/list&gt;/iUs', $xml, $lists);
		$obj_preg = array(
			'/&lt;m\s+[&quot;color=\s#0-9A-F]*label=&quot;(.*)&quot;[&quot;color=\s#0-9A-F]*&gt;/iUs',
			'/&lt;m\s+(?:label=&quot;.*&quot;\s*)?color=&quot;(.*)&quot;(?:\s*label=&quot;.*&quot;)?/iUs',
			'/&lt;m\s+list_src=&quot;(.*)&quot;(.*)\s*\/&gt;/iUs',
			'/&lt;m\s+type=&quot;([0-9a-z]*)&quot;(.*)\s*\/&gt;/iUs',
			'/\s+src=&quot;(.*)&quot;/iUs',
			'/\s+label=&quot;(.*)&quot;/iUs',
			'/\s+stream=&quot;(true|1|false|0)&quot;/iUs',
			'/\s+color=&quot;(.*)&quot;/iUs',
			'/&lt;\/m&gt;/iUs',
			'/\s+#/iUs'
		);
		$obj_replace = array(
			"#m_label=\\1",
			"_color=\\1",
			"#list_src=\\1\\2",
			"#type=\\1\\2",
			"#src=\\1",
			"#label=\\1",
			"#stream=\\1",
			"#color=\\1",
			"#/m",
			",#",
		);
		return preg_replace($obj_preg, $obj_replace, trim($lists[1]));
	}
}
?>