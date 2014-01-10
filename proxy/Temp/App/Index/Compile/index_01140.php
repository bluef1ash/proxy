<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><?php if(!defined("HDPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="author" content="<?php echo C("AUTHOR");?>">
		<meta name="copyright" content="<?php echo C("COPY");?>">
		<meta name="keywords" content="<?php echo C("KEYWORDS");?>">
		<meta name="description" content="<?php echo C("DISCRIPTION");?>">
		<script type='text/javascript' src='http://localhost/proxy/system/hdphp/../hdjs/jquery-1.8.2.min.js'></script>
<link href='http://localhost/proxy/system/hdphp/../hdjs/css/hdjs.css' rel='stylesheet' media='screen'>
<script src='http://localhost/proxy/system/hdphp/../hdjs/js/hdjs.js'></script>
<script src='http://localhost/proxy/system/hdphp/../hdjs/js/slide.js'></script>
<script src='http://localhost/proxy/system/hdphp/../hdjs/org/cal/lhgcalendar.min.js'></script>
<script type='text/javascript'>
		HOST = 'http://localhost';
		ROOT = 'http://localhost/proxy';
		WEB = 'http://localhost/proxy/index.php';
		URL = 'http://localhost/proxy';
		HDPHP = 'http://localhost/proxy/system/hdphp';
		HDPHPDATA = 'http://localhost/proxy/system/hdphp/Data';
		HDPHPTPL = 'http://localhost/proxy/system/hdphp/Lib/Tpl';
		HDPHPEXTEND = 'http://localhost/proxy/system/hdphp/Extend';
		APP = 'http://localhost/proxy/index.php/Index';
		CONTROL = 'http://localhost/proxy/index.php/Index/Index';
		METH = 'http://localhost/proxy/index.php/Index/Index/index';
		GROUP = 'http://localhost/proxy/proxy/';
		TPL = 'http://localhost/proxy/proxy/App/Index/Tpl';
		CONTROLTPL = 'http://localhost/proxy/proxy/App/Index/Tpl/Index';
		STATIC = 'http://localhost/proxy/Static';
		PUBLIC = 'http://localhost/proxy/proxy/App/Index/Tpl/Public';
</script>
		<script type="text/javascript">
			var CMP4 = "<?php echo C("CMP_ROOT");?>cmp.swf";
		</script>
		<script type="text/javascript" src="http://localhost/proxy/proxy/App/Index/Tpl/Public/js/jquery.zclip.min.js"></script>
		<script type="text/javascript" src="<?php echo C("CMP_ROOT");?>cmp.js"></script>
		<script type="text/javascript" src="http://localhost/proxy/proxy/App/Index/Tpl/Public/js/cmp.js"></script>
		<script type="text/javascript" src="http://localhost/proxy/proxy/App/Index/Tpl/Public/js/validate.js"></script>
		<script type="text/javascript" src="http://localhost/proxy/proxy/App/Index/Tpl/Public/js/reglog.js"></script>
		<script type="text/javascript" src="http://localhost/proxy/proxy/App/Index/Tpl/Public/js/function.js"></script>
<title>官方网站-<?php echo C("WEBNAME");?></title>
<script type="text/javascript">
function startgo(url){
	$("input[name=websiteText]").val(url);
}
</script>
<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><link href="http://localhost/proxy/proxy/App/Index/Tpl/Public/css/index.css" rel="stylesheet" type="text/css">
</head>
<body>
	<!-- 头部开始 -->
	<div class="header">
		<!-- 注册与登录信息栏开始 -->
		<div class="top-bar-right">
			<?php if($_SESSION['username'] && $_SESSION['uid']){?>
				您好，<?php echo $_SESSION['username'];?>！欢迎来到YY影视智能采集！<a href="<?php echo U('Login/out');?>" id="exit">退出</a> | <a href="<?php echo U('passport/index');?>">个人中心</a>
			<?php  }else{ ?>
				您好，欢迎来到YY影视智能采集！[<a href="#" title="登录" class="login">登录</a>] [<a href="#" title="免费注册" class="register">免费注册</a>]
			<?php }?>
			 | <a href="" title="新手入门">新手入门</a> <a href="#" title="偏好设置">偏好设置</a> <a href="<?php echo C("WEIBO");?>" title="微博">微博</a>
		</div>
		<!-- 注册与登录信息栏结束 -->
		<?php if(!$_SESSION['username'] && !$_SESSION['uid']){?>
			<!-- 注册与登录弹出框开始 -->
			<!-- 注册框开始 -->
			<div id="register" class="hidden">
				<div class="reg-title">
					<p>
						欢迎注册YY影视智能采集
					</p>
					<a href="" title="关闭" class="close-window"></a>
				</div>
				<div id="reg-wrap">
					<div class="reg-left">
						<ul>
							<li><span>账号注册</span></li>
						</ul>
						<div class="reg-l-bottom">
							已有账号，<a href="" id="login-now">马上登录</a>
						</div>
					</div>
					<div class="reg-right">
						<!-- 注册表单开始 -->
						<form action="<?php echo U('Register/register');?>" method="post" name="register">
							<ul>
								<li>
									<label for="reg-uname">用户名</label>
									<input type="text" name="username" id="reg-uname">
									<span>2-14个字符：字母、数字或中文</span> </li>
								<li>
									<label for="reg-pwd">密码</label>
									<input type="password" name="pwd" id="reg-pwd">
									<span>6-20个字符:字母、数字或下划线 _</span> </li>
								<li>
									<label for="reg-pwded">确认密码</label>
									<input type="password" name="pwded" id="reg-pwded">
									<span>请再次输入密码</span> </li>
								<li>
									<label for="reg-union">频道ID</label>
									<input type="text" name="userunion" id="reg-union">
									<span>2-10位字符：数字</span> </li>
								<li>
									<label for="reg-verify">验证码</label>
									<input type="text" name="verify" id="reg-verify">
									<img src="<?php echo U('Register/code');?>" width="99" height="35" alt="验证码" id="verify-img">
									<span>请输入图中的字母或数字，不区分大小写</span>
								</li>
								<li class="submit">
									<input type="submit" value="立即注册">
								</li>
							</ul>
						</form>
						<!-- 注册表单结束 -->
					</div>
				</div>
			</div>
			<!-- 注册框结束 -->
			<!-- 登录框开始 -->
			<div id="login" class="hidden">
				<div class="login-title">
					<p>欢迎您登录YY影视智能采集</p>
					<a href="" title="关闭" class="close-window"></a>
				</div>
				<div class="login-form">
					<span id="login-msg"></span>
					<!-- 登录FORM -->
					<form action="<?php echo U('Login/login');?>" method="post" name="login">
						<ul>
							<li>
								<label for="login-acc">账号</label>
								<input type="text" name="username" class="input" id="login-acc">
							</li>
							<li>
								<label for="login-pwd">密码</label>
								<input type="password" name="pwd" class="input" id="login-pwd">
							</li>
							<li class="login-auto">
								<label for="auto-login">
									<input type="checkbox" checked="checked" name="auto" id="auto-login">
									&nbsp;下一次自动登录
								</label>
								<a href="" id="regis-now">注册新账号</a>
							</li>
							<li>
								<input type="submit" value="" id="login-btn">
							</li>
						</ul>
					</form>
					<!-- 登录FORM结束 -->
				</div>
			</div>
			<!-- 登录框结束 -->
			<!--背景遮罩-->
			<div id="background" class="hidden">
			</div>
			<!--背景遮罩结束-->
			<!-- 注册与登录信息栏结束 -->
		<?php }?>
		<!-- LOGO图片开始 -->
		<div class="title">
			<div class="title" style="margin: 0px auto;width: 270px;height: 115px;">
				<a href="http://localhost/proxy" title="访问首页"><img src="<?php echo U('http://localhost/proxy/proxy/App/Index/Tpl/Public/images/logo.png');?>" alt="影片采集系统"></a>
			</div>
		</div>
		<!-- LOGO图片开始 -->
	</div>
	<!-- 头部结束 -->
	<!-- 主体开始 -->
	<div class="main">
		<!-- 采集地址表单开始 -->
		<form action="<?php echo U('Index/parse');?>" method="post" name="collect">
			<!-- 输入框及提交按钮开始 -->
			<div class="nav-srh">
				<input id="kw" type="text" name="websiteText" value="请填入需采集的视频地址">
				<input class="bn-srh" type="submit" value="开始">
				<?php if($_SESSION['username'] && $_SESSION['uid']){?>
					<a href="javascript:re('kw');" id="re">替换地址</a>
				<?php }?>
				<span id="inf"></span>
			</div>
			<!-- 输入框及提交按钮结束 -->
			<?php if($_SESSION['username'] && $_SESSION['uid']){?>
				<!-- 采集合集功能开始 -->
				<script type="text/javascript" src="http://localhost/proxy/proxy/App/Index/Tpl/Public/js/collection.js"></script>
				<ul class="update_way">
					<li>更新方式：
						<label>
							<input name="update" type="radio" value="static">
							静态更新 </label>
						<label>
							<input name="update" type="radio" value="auto">
							自动更新 </label>
					</li>
					<li class="collection">
						<label style="float:left">
							<input name="collection" type="checkbox" value="collection">
							采集合集 </label>
						<dl id="collection_type">
							<dt>
								<label>
									<input name="collection_type" type="radio" value="odd">
									单集</label>
								<label>
									<input name="collection_type" type="radio" value="plural">
									多集</label>
							</dt>
							<dt><a href="#" id="delete_tmp" title="清除缓存数据">清除缓存</a></dt>
						</dl>
					</li>
				</ul>
				<!-- 采集合集功能结束 -->
			<?php }?>
		</form>
		<!-- 采集地址表单结束 -->
		<!-- 提示功能开始 -->
		<div class="about">
			<!-- 辅助手册开始 -->
			<ul class="gn">
				<li><a href="#" title="新手入门">新手入门</a></li>
				<li><a href="#" title="偏好设置">偏好设置</a></li>
				<li><a href="#" title="有问必答">有问必答</a></li>
			</ul>
			<p class="sitefx">
				<strong>地址示例：</strong><a href="javascript:startgo('http://www.letv.com/ptv/vplay/1488765.html');">http://www.letv.com/ptv/vplay/1488765.html</a>
			</p>
			<!-- 辅助手册结束 -->
			<!-- 常用视频网站开始 -->
			<table border="1" class="videotype">
				<thead>
					<caption class="table_caption">
					常用网址
					</caption>
				</thead>
				<tbody>
					<tr>
						<td><a href="#">电影</a></td>
						<td><a href="#">电视剧</a></td>
						<td><a href="#">动漫</a></td>
						<td><a href="#">综艺</a></td>
						<td><a href="#">音乐专辑</a></td>
					</tr>
					<tr>
						<td><a href="javascript:curl('http://www.youku.com/')">优酷网</a></td>
						<td><a href="javascript:curl('http://www.tudou.com/')">土豆网</a></td>
						<td><a href="javascript:curl('http://www.iqiyi.com/')">爱奇艺</a></td>
						<td><a href="javascript:curl('http://tv.sohu.com/')">搜狐视频</a></td>
						<td><a href="javascript:curl('http://v.qq.com/')">腾讯视频</a></td>
					</tr>
					<tr>
						<td><a href="javascript:curl('http://www.letv.com/')">乐视网</a></td>
						<td><a href="javascript:curl('http://www.cntv.cn/')">CNTV</a></td>
						<td><a href="javascript:curl('http://www.56.com/')">56网</a></td>
						<td><a href="javascript:curl('#')">网易公开课</a></td>
						<td><a href="javascript:curl('http://www.kankan.com/')">迅雷看看</a></td>
					</tr>
					<tr>
						<td><a href="javascript:curl('http://video.sina.com.cn/movie/')">新浪大片</a></td>
						<td><a href="javascript:curl('http://www.pps.tv/')">PPS</a></td>
						<td><a href="javascript:curl('http://www.yinyuetai.com/')">音悦台</a></td>
						<td><a href="javascript:curl('http://www.pptv.com/')">PPTV</a></td>
						<td><a href="javascript:curl('http://www.m1905.com/')">电影网</a></td>
					</tr>
				</tbody>
			</table>
			<!-- 常用视频网站结束 -->
		</div>
		<!-- 提示功能结束 -->
	</div>
	<!-- 主体结束 -->
<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?>	<!-- 底部开始 -->
	<hr style="border-width: 1px 0 0;height: 1px;">
	<div class="footer">
		<!-- 站长资料开始 -->
		&copy; 2013
		<a href="http://380407775.qzone.qq.com/" target="_blank">我的QQ空间</a>
		<a target="_blank" href="http://sighttp.qq.com/authd?IDKEY=2d138f6c028e8bc9af60e0aa1ec45614a2f77165fb1814c1">
			<img border="0" src="http://wpa.qq.com/imgd?IDKEY=2d138f6c028e8bc9af60e0aa1ec45614a2f77165fb1814c1&pic=41" alt="点击这里给我发消息" title="点击这里给我发消息">
		</a>
		<a href="mailto:liangtian_2005@163.com?subject=咨询我&amp;cc=liangtian_2005@163.com&amp;bcc=liangtian_2005@163.com">与我联系</a>
		<!-- 站长资料结束 -->
		<br>
		All Rights Reserved
	</div>
	<!-- 底部结束 -->
</body>
</html>