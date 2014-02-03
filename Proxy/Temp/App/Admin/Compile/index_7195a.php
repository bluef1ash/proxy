<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><?php if(!defined("HDPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="shortcut icon" type="image/x-icon" href="http://localhost/proxy/./Proxy/App/Admin/Tpl/Public/images/favicon.ico">
		<script type='text/javascript' src='http://localhost/proxy/System/hdphp/../hdjs/jquery-1.8.2.min.js'></script>
<link href='http://localhost/proxy/System/hdphp/../hdjs/css/hdjs.css' rel='stylesheet' media='screen'>
<script src='http://localhost/proxy/System/hdphp/../hdjs/js/hdjs.js'></script>
<script src='http://localhost/proxy/System/hdphp/../hdjs/js/slide.js'></script>
<script src='http://localhost/proxy/System/hdphp/../hdjs/org/cal/lhgcalendar.min.js'></script>
<script type='text/javascript'>
		HOST = 'http://localhost';
		ROOT = 'http://localhost/proxy';
		WEB = 'http://localhost/proxy/index.php';
		URL = 'http://localhost/proxy/Admin/Index/index.html';
		HDPHP = 'http://localhost/proxy/System/hdphp';
		HDPHPDATA = 'http://localhost/proxy/System/hdphp/Data';
		HDPHPTPL = 'http://localhost/proxy/System/hdphp/Lib/Tpl';
		HDPHPEXTEND = 'http://localhost/proxy/System/hdphp/Extend';
		APP = 'http://localhost/proxy/index.php/Admin';
		CONTROL = 'http://localhost/proxy/index.php/Admin/Index';
		METH = 'http://localhost/proxy/index.php/Admin/Index/index';
		GROUP = 'http://localhost/proxy/./Proxy';
		TPL = 'http://localhost/proxy/./Proxy/App/Admin/Tpl';
		CONTROLTPL = 'http://localhost/proxy/./Proxy/App/Admin/Tpl/Index';
		STATIC = 'http://localhost/proxy/Static';
		PUBLIC = 'http://localhost/proxy/./Proxy/App/Admin/Tpl/Public';
</script>
		<link href="http://localhost/proxy/System/hdphp/Extend/Org/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"><script src="http://localhost/proxy/System/hdphp/Extend/Org/bootstrap/js/bootstrap.min.js"></script>
  <!--[if lte IE 6]>
  <link rel="stylesheet" type="text/css" href="http://localhost/proxy/System/hdphp/Extend/Org/bootstrap/ie6/css/bootstrap-ie6.css">
  <![endif]-->
  <!--[if lte IE 7]>
  <link rel="stylesheet" type="text/css" href="http://localhost/proxy/System/hdphp/Extend/Org/bootstrap/ie6/css/ie.css">
  <![endif]-->
		<script type="text/javascript">
			var LIST_WEBSITE = "<?php echo C("LIST_WEBSITE");?>";
			var CMP4 = "http://localhost/proxy/Player/Cmp/cmp.swf";
			var LIST_FIX = "<?php echo C("LIST_FIX");?>";
		</script>
		<title>后台首页-<?php echo C("WEBNAME");?></title>
		<link rel="stylesheet" type="text/css" href="http://localhost/proxy/./Proxy/App/Admin/Tpl/Public/Css/admin.css">
		<link rel="stylesheet" type="text/css" href="http://localhost/proxy/./Proxy/App/Admin/Tpl/Public/Css/public.css">
		<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Admin/Tpl/Public/Js/public.js"></script>
		<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Admin/Tpl/Public/Js/admin.js"></script>
		<script type="text/javascript">
			$(function() {
				setInterval(function () {
					$("#time").html(getTime);
				}, 1000);
			});
			function getTime () {
				var dates = new Date();
				var str = dates.toLocaleString();
				return str;
			}
			function SetCwinHeight(iframeObj){
				if (document.getElementById){
			  		if (iframeObj && !window.opera){
						if (iframeObj.contentDocument && iframeObj.contentDocument.body.offsetHeight){
							iframeObj.height = iframeObj.contentDocument.body.offsetHeight;
			    		}else if(document.frames[iframeObj.name].document && document.frames[iframeObj.name].document.body.scrollHeight){
			    			iframeObj.height = document.frames[iframeObj.name].document.body.scrollHeight;
		    			}
					}
				}
			}
		</script>
		<!-- 默认打开目标 -->
		<base target="iframe">
	</head>
	<body>
		<!-- 头部 -->
		<div id="top_box">
			<div id="top">
				<p id="top_font">管理后台-<?php echo C("WEBNAME");?></p>
				<ul id="menu2" class="menu">
					<li>
						<a href="http://localhost/proxy" target="_blank">前台首页</a>
					</li>
					<li><a href="<?php echo U('Admin/Category/category');?>">查看栏目</a></li>
					<li><a href="<?php echo U('Admin/User/index');?>">用户列表</a></li>
					<li><a href="<?php echo U('Admin/System/web_set');?>">网站配置</a></li>
				</ul>
			</div>
			<div class="top_bar">
				<p class="adm">
						<span>超级</span>
					管理员：
					<span class="adm_pic"></span>
					<span class="adm_people">[<?php echo $_SESSION['adminname'];?>]</span>
				</p>
				<p class="now_time">
					今天是：<span id="time"></span>
					您的当前位置是：
					<span>首页</span>
				</p>
				<p class="out">
					<a href="<?php echo U('Admin/Login/out');?>" class="out_bg" target="_parent">退出</a>
				</p>
			</div>
		</div>
		<!-- 左侧菜单 -->
		<div id="left_box">
			<p class="use">常用菜单</p>
			 <div class="menu_box">
				<h2>用户管理</h2>
				<div class="text">
					<ul class="con">
				        <li class="nav_u">
				        	<a href="<?php echo U('Admin/User/index');?>" class="pos">用户的列表</a>
				        </li>
				    </ul>
				</div>
			</div>
			<div class="menu_box">
				<h2>视频列表管理</h2>
				<div class="text">
					<ul class="con">
				        <li class="nav_u">
				        	<a href="<?php echo U('Admin/Lists/index');?>" class="pos">所有的列表</a>
				        </li>
				    </ul>
				    <ul class="con">
				    	<li class="nav_u">
				    		<a href="<?php echo U('Admin/Lists/search');?>" class="pos">搜索列表</a>
				    	</li>
				    </ul>
				    <ul class="con">
				    	<li class="nav_u">
				    		<a href="<?php echo U('Admin/Lists/add');?>" class="pos">增加列表</a>
				    	</li>
				    </ul>
				</div>
			</div>
			<div class="menu_box">
				<h2>视频分类</h2>
				<div class="text">
					<ul class="con">
				        <li class="nav_u">
				        	<a href="<?php echo U('Admin/Category/category');?>" class="pos">视频分类列表</a>
				        </li>
				    </ul>
				    <ul class="con">
				    	<li class="nav_u"><a href="<?php echo U('Admin/Category/add_top_cate');?>" class="pos">添加顶级分类</a></li>
				    </ul>
				</div>
			</div>
			<div class="menu_box">
				<h2>系统管理</h2>
				<div class="text">
					<ul class="con">
				        <li class="nav_u">
				        	<a href="<?php echo U('Admin/Index/copy');?>" class="pos">系统信息</a>
				        </li>
				    </ul>
				    <ul class="con">
				        <li class="nav_u"><a href="<?php echo U('Admin/System/passwd');?>" class="pos">修改密码</a></li>
				    </ul>
				    <ul class="con">
				        <li class="nav_u"><a href="<?php echo U('Admin/System/player_set');?>" class="pos">播放器配置</a></li>
				    </ul>
				    <ul class="con">
				        <li class="nav_u"><a href="<?php echo U('Admin/System/upload_set');?>" class="pos">上传配置</a></li>
				    </ul>
				    <ul class="con">
				        <li class="nav_u"><a href="<?php echo U('Admin/System/web_set');?>" class="pos">网站配置</a></li>
				    </ul>
				</div>
			</div>
			<div class="menu_box">
				<h2>后台用户管理</h2>
				<div class="text">
					<ul class="con">
				        <li class="nav_u"><a href="<?php echo U('Admin/Admin/index');?>" class="pos">用户列表</a></li>
				    </ul>
				    <ul class="con">
				        <li class="nav_u"><a href="<?php echo U('Admin/Admin/add');?>" class="pos">添加用户</a></li>
				    </ul>
				</div>
			</div>
		</div>
		<!-- 右侧 -->
		<div id="right">
			<iframe frameboder="0" border="0" scrolling="no" name="iframe" onload="SetCwinHeight(this)" src="<?php echo U('Admin/Index/copy');?>"></iframe>
		</div>
		<!-- 底部 -->
		<div id="foot_box">
			<div class="foot">
				<p>&reg;Copyright &copy; 2013-2013 Liang Tian All Rights Reserved. <?php echo C("RECORD");?></p>
			</div>
		</div>
		<!--[if IE 6]>
		    <script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Admin/Tpl/Public/Js/iepng.js"></script>
		    <script type="text/javascript">
		        DD_belatedPNG.fix(".adm_pic, #left_box .pos, .span_server, .span_people", "background");
		    </script>
		<![endif]-->
	</body>
</html>
