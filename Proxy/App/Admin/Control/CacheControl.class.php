<?php
/**
 * 缓存控制器
 */
class CacheControl extends CommonControl{
	/**
	 * 功能菜单
	 */
	public function index()	{
		$this->display();
	}
	/**
	 * 全局缓存
	 */
	public function delete(){
		if (!IS_GET)
			$this->error("页面不存在！");
		$temp = Q("get.temp");
		$dir = glob($temp . '*');
        if (!empty($dir) && $temp && is_dir($temp)) {
            foreach ($dir as $d)
                Dir::del($d);
        }
        $url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
	    $this->success('缓存目录已经全部删除成功', $url);
	}
	/**
	 * 清除Memcache缓存
	 */
	public function del_memcache(){
		if (!IS_POST)
			$this->error("页面不存在！");
		$host = Q("post.host");
		$port = Q("post.port", null, "intval");
		$time = Q("post.time", null, "intval");
		$cache = Cache::init(array(
			"driver" => "memcache",
			"host" => array(
				"host" => $host,
				"port" => $port
			)
		));
		$time ? $cache->delAll($time) : $cache->delAll();
        $url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
        $this->success('缓存已经全部删除成功', $url);
	}
}
?>