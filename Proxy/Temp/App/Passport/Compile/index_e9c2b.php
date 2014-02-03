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
		URL = 'http://localhost/proxy/Passport/Qqlogin';
		HDPHP = 'http://localhost/proxy/System/hdphp';
		HDPHPDATA = 'http://localhost/proxy/System/hdphp/Data';
		HDPHPTPL = 'http://localhost/proxy/System/hdphp/Lib/Tpl';
		HDPHPEXTEND = 'http://localhost/proxy/System/hdphp/Extend';
		APP = 'http://localhost/proxy/index.php/Passport';
		CONTROL = 'http://localhost/proxy/index.php/Passport/Qqlogin';
		METH = 'http://localhost/proxy/index.php/Passport/Qqlogin/index';
		GROUP = 'http://localhost/proxy/./Proxy/';
		TPL = 'http://localhost/proxy/./Proxy/App/Passport/Tpl';
		CONTROLTPL = 'http://localhost/proxy/./Proxy/App/Passport/Tpl/Qqlogin';
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
			var CMP4 = "http://localhost/proxy/Player/Cmp/cmp.swf";
		</script>
		<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Passport/Tpl/Public/js/jquery.zclip.min.js"></script>
		<script type="text/javascript" src="http://localhost/proxy/Player/Cmp/cmp.js"></script>
		<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Passport/Tpl/Public/js/cmp.js"></script>
		<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Passport/Tpl/Public/js/validate.js"></script>
		<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Passport/Tpl/Public/js/reglog.js"></script>
		<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Passport/Tpl/Public/js/function.js"></script>
		<title>联系我们-<?php echo C("WEBNAME");?></title>
		<link rel="stylesheet" href="http://localhost/proxy/./Proxy/App/Passport/Tpl/Public/Css/qqlogin.css">
		<script type="text/javascript">
			$(function () {
				$('.tabs a:last').tab('show')
			})
		</script>
	</head>
	<body>
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
		<div id="menu">
			<ul>
				<li><a href="http://localhost/proxy/index.php/Passport">主页</a></li>
				<!--<li><a href="#">使用帮助</a></li>-->
				<li><a href="#">升级高级会员</a></li>
				<li><a href="<?php echo U('Passport/Contacts/information');?>">联系我们</a></li>
			</ul>
		</div>
		<div class="qqlogin">
			<h1>Hi，{$}，欢迎使用QQ帐号登录</h1>
			<hr>
			<div class="log">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#creative" data-toggle="pill">创建新账号</a></li>
					<li><a href="#old" data-toggle="tab">绑定已有账号</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="creative">
						<form action="<?php echo U('Index/Register/register');?>" method="post" name="register">
							<table class="table">
								<tbody>
									<tr>
										<td width="20%">用户名：</td>
										<td>
											<input type="text" name="username" id="reg-uname">
										</td>
										<td>2-14个字符：字母、数字或中文</td>
									</tr>
									<tr>
										<td width="20%">密码</td>
										<td>
											<input type="password" name="pwd" id="reg-pwd">
										</td>
										<td>6-20个字符:字母、数字或下划线</td>
									</tr>
									<tr>
										<td width="20%">确认密码</td>
										<td>
											<input type="password" name="pwded" id="reg-pwded">
										</td>
										<td>请再次输入密码</td>
									</tr>
									<tr>
										<td width="20%">频道ID</td>
										<td>
											<input type="text" name="userunion" id="reg-union">
										</td>
										<td>2-10位字符：数字</td>
									</tr>
									<tr>
										<td width="20%">验证码</td>
										<td>
											<input type="text" name="verify" id="reg-verify">
										</td>
										<td><img src="<?php echo U('Index/Register/code');?>" width="99" height="35" alt="验证码" id="verify-img">
										请输入图中的字母或数字，不区分大小写</td>
									</tr>
									<tr>
										<td colspan="3" class="submit">
											<input type="submit" class="btn btn-primary" value="立即注册">
										</td>
									</tr>
								</tbody>
							</table>
						</form>
					</div>
					<div class="tab-pane" id="old">
						<!-- 登录FORM -->
						<form action="<?php echo U('Index/Login/login');?>" method="post" name="login">
							<table class="table">
								<tbody>
									<tr>
										<td>账号</td>
										<td>
											<input type="text" name="username" class="input" id="login-acc">
										</td>
									</tr>
									<tr>
										<td>密码</td>
										<td>
											<input type="password" name="pwd" class="input" id="login-pwd">
										</td>
									</tr>
									<tr class="login-auto">
										<td colspan="2">
											<input type="checkbox" checked="checked" name="auto" id="auto-login">下一次自动登录
											<a href="" id="regis-now">注册新账号</a>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<input type="submit" value="绑定账号" class="btn btn-primary" id="login-btn">
										</td>
									</tr>
								</tbody>
							</table>
						</form>
						<!-- 登录FORM结束 -->
					</div>
				</div>
			</div>
		</div>
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