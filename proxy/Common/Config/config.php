<?php
if (!defined("HDPHP_PATH"))exit('No direct script access allowed');
//更多配置请查看hdphp/Config/config.php
$arr = array(
		"AUTO_LOAD_FILE"                => array(COMMON_LIB_PATH."Function/Functions.php"), //自动加载应用Lib目录或应用组Common/Lib目录下的文件
		/********************************URL设置********************************/
	    "HTTPS"                         => FALSE,       //基于https协议
	    "URL_REWRITE"                   => 1,           //url重写模式
	    "URL_TYPE"                      => 1,           //类型 1:PATHINFO模式 2:普通模式 3:兼容模式
	    "PATHINFO_DLI"                  => "/",         //PATHINFO分隔符
	    "PATHINFO_VAR"                  => "q",         //兼容模式get变量
	    "PATHINFO_HTML"                 => ".html",     //伪静态扩展名
	    /********************************数据库********************************/
		"DB_DRIVER"                     => "mysqli",    //数据库驱动
		"DB_CHARSET"                    => "utf8",    //数据库驱动
		"DB_HOST"                       => "127.0.0.1", //数据库连接主机  如127.0.0.1
		"DB_PORT"                       => 3306,        //数据库连接端口
		"DB_USER"                       => "root",      //数据库用户名
		"DB_PASSWORD"                   => "",          //数据库密码
		"DB_DATABASE"                   => "proxy",          //数据库名称
		"DB_PREFIX"                     => "py_",          //表前缀
		//    "DB_FIELD_CACHE"                => 1,           //字段缓存  已弃用
		"DB_BACKUP"                     => ROOT_PATH . "backup/".time(), //数据库备份目录
		/********************************验证码********************************/
		"CODE_FONT"                     => HDPHP_PATH . "Data/Font/font.ttf",       //字体
		"CODE_STR"                      => "123456789abcdefghijklmnpqrstuvwsyz", //验证码种子
		"CODE_WIDTH"                    => 150,         //宽度
		"CODE_HEIGHT"                   => 45,          //高度
		"CODE_BG_COLOR"                 => "#ffffff",   //背景颜色
		"CODE_LEN"                      => 1,           //文字数量
		"CODE_FONT_SIZE"                => 22,          //字体大小
		"CODE_FONT_COLOR"               => "",          //字体颜色
		/********************************缓存********************************/
	    'CACHE_TYPE'                    => 'file',      //类型:file memcache redis
	    "CACHE_ZIP"						=> true,
	    'CACHE_TIME'                    => 3600,        //全局默认缓存时间 0为永久缓存
	    'CACHE_MEMCACHE'                => array(       //多个服务器设置二维数组
	        'host'      => '127.0.0.1',     //主机
	        'port'      => 11211,           //端口
	        'timeout'   => 1,               //超时时间(单位为秒)
	        'weight'    => 1,               //权重
	        'pconnect'  => 1,               //持久连接
	    ),
	    'CACHE_REDIS'                   => array( //多个服务器设置二维数组
	        'host'      => '127.0.0.1',     //主机
	        'port'      => 6379,            //端口
	        'password'  => '',              //密码
	        'timeout'   => 1,               //超时时间
	        'Db'        => 0,               //数据库
	        'pconnect'  => 0,               //持久连接
	    ),
	    'CACHE_SELECT_TIME'             => -1,          //SQL SELECT查询缓存时间 -1为不缓存 0为永久缓存
	    'CACHE_SELECT_LENGTH'           => 30,          //缓存最大条数
	    'CACHE_TPL_TIME'                => -1,          //模板缓存时间 -1为不缓存 0为永久缓存
		/********************************URL路由设置********************************/
		"route" => array(
			//"/(\w+)/" => 'Index/Index/#1',
			//"" => ""
		),                                              //路由规则
		/********************************其它*********************************/
		"COOKIE_TIME"					=> time() + 3600 * 24 * 30,
);
return array_merge(include 'web.php', include 'player.php', include 'upload.php', $arr);
?>