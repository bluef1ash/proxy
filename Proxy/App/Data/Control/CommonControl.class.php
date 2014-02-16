<?php
/**
 * 公共控制器
 */
class CommonControl extends AuthControl {
	/**
	 * 缓存选择
	 * @param string $key 缓存键名
	 * @param number $set 是否写入缓存，0为读取，1为写入
	 * @param string $value 缓存内容
	 * @param string $prefix 缓存的前缀
	 * @param string $mod 缓存模式
	 * @param number $expire 缓存时间
	 * @return boolean string $result 读取模式时为读取的内容，写入模式时为0或1
	 */
	public function cache_collect($key, $set = 0, $value = "", $prefix = "", $mod = "file", $expire = 36000){
		if ($mod == "file"){
			$driver = array(
				"driver" => $mod,
				"dir" => TEMP_PATH . "DataCache"
			);
		} elseif ($mod == "memcache") {
			$driver = array(
				"driver" => $mod,
				"host" => array(
					"host" => "127.0.0.1",
					"port" => 11211
				),
				"timeout" => 1,
		        "weight" => 1,
			);
		}
		$driver["zip"] = true;
		$driver["prefix"] = $prefix;
		$driver["expire"] = $expire;
		$cache = cache::init($driver);
		if ($set) {
			$result = $cache->$key = $value;
		} else {
			$result = $cache->$key;
		}
		return $result;
	}
}
?>