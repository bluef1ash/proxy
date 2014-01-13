<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><?php if(!defined("HDPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="author" content="<?php echo C("AUTHOR");?>">
		<meta name="copyright" content="<?php echo C("COPY");?>">
		<meta name="keywords" content="<?php echo C("KEYWORDS");?>">
		<meta name="description" content="<?php echo C("DISCRIPTION");?>">
		<script type='text/javascript' src='http://localhost/proxy/System/hdphp/../hdjs/jquery-1.8.2.min.js'></script>
<link href='http://localhost/proxy/System/hdphp/../hdjs/css/hdjs.css' rel='stylesheet' media='screen'>
<script src='http://localhost/proxy/System/hdphp/../hdjs/js/hdjs.js'></script>
<script src='http://localhost/proxy/System/hdphp/../hdjs/js/slide.js'></script>
<script src='http://localhost/proxy/System/hdphp/../hdjs/org/cal/lhgcalendar.min.js'></script>
<script type='text/javascript'>
		HOST = 'http://localhost';
		ROOT = 'http://localhost/proxy';
		WEB = 'http://localhost/proxy/index.php';
		URL = 'http://localhost/proxy/Passport/User/index.html';
		HDPHP = 'http://localhost/proxy/System/hdphp';
		HDPHPDATA = 'http://localhost/proxy/System/hdphp/Data';
		HDPHPTPL = 'http://localhost/proxy/System/hdphp/Lib/Tpl';
		HDPHPEXTEND = 'http://localhost/proxy/System/hdphp/Extend';
		APP = 'http://localhost/proxy/index.php/Passport';
		CONTROL = 'http://localhost/proxy/index.php/Passport/User';
		METH = 'http://localhost/proxy/index.php/Passport/User/index';
		GROUP = 'http://localhost/proxy/./Proxy/';
		TPL = 'http://localhost/proxy/./Proxy/App/Passport/Tpl';
		CONTROLTPL = 'http://localhost/proxy/./Proxy/App/Passport/Tpl/User';
		STATIC = 'http://localhost/proxy/Static';
		PUBLIC = 'http://localhost/proxy/./Proxy/App/Passport/Tpl/Public';
</script>
		<link href="http://localhost/proxy/System/hdphp/Extend/Org/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"><script src="http://localhost/proxy/System/hdphp/Extend/Org/bootstrap/js/bootstrap.min.js"></script>
  <!--[if lte IE 6]>
  <link rel="stylesheet" type="text/css" href="http://localhost/proxy/System/hdphp/Extend/Org/bootstrap/ie6/css/bootstrap-ie6.css">
  <![endif]-->
  <!--[if lte IE 7]>
  <link rel="stylesheet" type="text/css" href="http://localhost/proxy/System/hdphp/Extend/Org/bootstrap/ie6/css/ie.css">
  <![endif]-->
		<script type="text/javascript">
			var CMP4 = "<?php echo C("CMP_ROOT");?>cmp.swf";
		</script>
		<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Passport/Tpl/Public/Js/jquery.zclip.min.js"></script>
		<script type="text/javascript" src="<?php echo C("CMP_ROOT");?>cmp.js"></script>
		<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Passport/Tpl/Public/Js/cmp.js"></script>
		<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Passport/Tpl/Public/Js/validate.js"></script>
		<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Passport/Tpl/Public/Js/function.js"></script>
	<title>个人资料-<?php echo C("WEBNAME");?></title>
	<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Passport/Tpl/Public/Js/validate.js"></script>
<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?>		<link href="http://localhost/proxy/./Proxy/App/Passport/Tpl/Public/Css/passport.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<!-- 头部开始 -->
		<div id="header">
			<ul>
				<li>
					<a title="点击查看修改个人资料" href="<?php echo U('Passport/User/index');?>"><?php echo $_SESSION['username'];?></a>
				</li>
				<li>
					<a href="<?php echo U('Index/Login/out');?>">退出</a>
				</li>
				<li>|</li>
				<li>
					<a href="#">升级高级会员</a>
				</li>
				<li>
					<a target="_blank" href="#">偏好设置</a>
				</li>
				<li>
					<a target="_blank" href="<?php echo C("WEIBO");?>">微博</a><a href="http://localhost/proxy">返回首页</a>
				</li>
			</ul>
			<img src="http://localhost/proxy/./Proxy/App/Passport/Tpl/Public/Images/mlogo.jpg" alt="个人中心">
		</div>
		<!-- 头部结束 -->
		<!-- 正文开始 -->
	<!-- 导航条开始 -->
	<div id="menu">
		<ul>
			<li class="current_page_item"><a href="">主页</a></li>
			<!--<li><a href="#">使用帮助</a></li>-->
			<li><a href="#">升级高级会员</a></li>
			<li><a href="<?php echo U(('Passport/contacts/information'));?>">联系我们</a></li>
		</ul>
	</div>
	<!-- 导航条结束 -->
<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?>	<div id="page">
		<!-- 左侧级联菜单开始 -->
		<div id="sidebar">
			<dl>
				<dt>常用功能</dt>
				<dd><a href="<?php echo U('Passport/Lists/general');?>">普通视频解析</a></dd>
				<dd><a href="<?php echo U('Passport/Lists/multi');?>">多地址解析</a></dd>
				<dd><a target="_blank" href="">偏好设置</a></dd>
				<dd><a href="<?php echo U('Passport/Record/index');?>">解析记录</a></dd>
				<dd><a href="<?php echo U('Passport/User/index');?>">个人资料</a></dd>
				<dd><a href="<?php echo U('Passport/Vip/index');?>">升级高级会员</a></dd>
				<!-- <dd><a href="#">我的留言</a></dd> -->
				<dt>高级会员功能</dt>
				<!--<dd><a href="pwds">加密专辑批量解析</a></dd>
				<dd><a href="friends">好友专辑批量解析</a></dd>
				<dd><a href="space">视频空间批量解析</a></dd>-->
			</dl>
		</div>
		<!-- 左侧级联菜单结束 -->
		<!-- 右侧开始 -->
		<div id="right">
	<!-- 用户修改密码开始 -->
	<form action="<?php echo U(('Passport/User/alterpassword'));?>" method="post" name="alterpassword">
		<table class="table1">
			<thead>
				<caption>修改密码</caption>
			</thead>
			<tbody>
				<tr>
					<td>用户名：</td>
					<td><?php echo $_SESSION['username'];?></td>
				</tr>
				<tr>
					<td>密码</td>
					<td><input type="password" name="pwd"></td>
					<td>6-20个字符:字母、数字或下划线 _</td>
				</tr>
				<tr>
					<td>确认密码</td>
					<td><input type="password" name="pwded"></td>
					<td>请再次输入密码</td>
				</tr>
				<tr>
					<td>频道ID</td>
					<td><input type="text" name="userunion" value="<?php echo $userunion;?>"></td>
					<td>2-10位数字</td>
				</tr>
				<tr>
					<td>验证码</td>
					<td><input type="text" name="verify"></td>
					<td><img src="<?php echo U('Index/Register/code');?>" width="99" height="35" id="verify-img" alt="验证码"></td>
				</tr>
				<tr>
					<td colspan="4" class="submit">
						<input type="submit" class="btn btn-default" value="确定">
					</td>
				</tr>
			</tbody>
		</table>
	</form>
	<!-- 用户修改密码结束 -->
<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?>		</div>
		<!-- 右侧结束 -->
	</div>
	<!-- 正文结束 -->
	<!-- 尾部开始 -->
	<div id="footer">
		&copy; 2013
		<a href="http://380407775.qzone.qq.com/" target="_blank">我的QQ空间</a>
		<a target="_blank" href="http://sighttp.qq.com/authd?IDKEY=2d138f6c028e8bc9af60e0aa1ec45614a2f77165fb1814c1">
			<img border="0" src="http://wpa.qq.com/imgd?IDKEY=2d138f6c028e8bc9af60e0aa1ec45614a2f77165fb1814c1&pic=41" alt="点击这里给我发消息" title="点击这里给我发消息">
		</a>
		<a href="mailto:liangtian_2005@163.com?subject=咨询我&amp;cc=liangtian_2005@163.com&amp;bcc=liangtian_2005@163.com">
			与我联系
		</a>
		<br>
		All Rights Reserved
	</div>
	<!-- 尾部结束 -->
</body>
</html>