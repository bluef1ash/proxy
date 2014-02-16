<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><?php if(!defined("HDPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta property="qc:admins" content="344420077701614157563757" />
		<meta name="author" content="<?php echo C("AUTHOR");?>">
		<meta name="copyright" content="<?php echo C("COPY");?>">
		<meta name="keywords" content="<?php echo C("KEYWORDS");?>">
		<meta name="description" content="<?php echo C("DISCRIPTION");?>">
		<link rel="shortcut icon" type="image/x-icon" href="http://localhost/proxy/./Proxy/App/Index/Tpl/Public/images/favicon.ico">
		<script type='text/javascript' src='http://localhost/proxy/System/hdphp/../hdjs/jquery-1.8.2.min.js'></script>
<link href='http://localhost/proxy/System/hdphp/../hdjs/css/hdjs.css' rel='stylesheet' media='screen'>
<script src='http://localhost/proxy/System/hdphp/../hdjs/js/hdjs.js'></script>
<script src='http://localhost/proxy/System/hdphp/../hdjs/js/slide.js'></script>
<script src='http://localhost/proxy/System/hdphp/../hdjs/org/cal/lhgcalendar.min.js'></script>
<script type='text/javascript'>
		HOST = 'http://localhost';
		ROOT = 'http://localhost/proxy';
		WEB = 'http://localhost/proxy/index.php';
		URL = 'http://localhost/proxy/Index/Index/parse.html';
		HDPHP = 'http://localhost/proxy/System/hdphp';
		HDPHPDATA = 'http://localhost/proxy/System/hdphp/Data';
		HDPHPTPL = 'http://localhost/proxy/System/hdphp/Lib/Tpl';
		HDPHPEXTEND = 'http://localhost/proxy/System/hdphp/Extend';
		APP = 'http://localhost/proxy/index.php/Index';
		CONTROL = 'http://localhost/proxy/index.php/Index/Index';
		METH = 'http://localhost/proxy/index.php/Index/Index/parse';
		GROUP = 'http://localhost/proxy/./Proxy';
		TPL = 'http://localhost/proxy/./Proxy/App/Index/Tpl';
		CONTROLTPL = 'http://localhost/proxy/./Proxy/App/Index/Tpl/Index';
		STATIC = 'http://localhost/proxy/Static';
		PUBLIC = 'http://localhost/proxy/./Proxy/App/Index/Tpl/Public';
		HISTORY = 'http://localhost/proxy/';
		HTTPREFERER = 'http://localhost/proxy/';
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
		<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Index/Tpl/Public/js/jquery.zclip.min.js"></script>
		<script type="text/javascript" src="http://localhost/proxy/Player/Cmp/cmp.js"></script>
		<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Index/Tpl/Public/js/cmp.js"></script>
		<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Index/Tpl/Public/js/validate.js"></script>
		<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Index/Tpl/Public/js/reglog.js"></script>
		<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Index/Tpl/Public/js/function.js"></script>
	<title>
		<?php if($_POST['websiteText']){?>
			当前解析视频：<?php echo $collect['vName'];?>-<?php echo C("WEBNAME");?>
		<?php  }else{ ?>
			欢迎来到<?php echo C("WEBNAME");?>
		<?php }?>
	</title>
	<script type="text/javascript">
		var vname = "<?php echo $collect['vName'];?>";
		$(function(){
			$("input[name=download]").submit(function() {
				var xml = $("#editxml").val();
				$("input[name=data]","download").val(xml);
			});
			$("#editxml").bind("keydown keyup",function(){
				$(this).autosize();
			}).show().autosize();
			$( "#upload" ).click( function () {
				dialog($( "#category" ));
			} );
			$("#copy").zclip({
		        path : PUBLIC + "/js/ZeroClipboard.swf",
		        copy : $("#editxml").val(),
		        afterCopy:function(){
		           $.dialog({
					    "message":"复制成功！",
			    		"type":"success",
			    		"timeout":2
					});
		        }
		    });
			$("#play").click(function() {
				var xml = $("#editxml").val();
				var arr = /^\[flash\]http:\/\/afp\.qiyi\.com\/main\/c\?db=qiyiafp\&bid=1,1,1\&cid=1,1,1&sid=0\&url=(.*?)\|\d{1,3}\|\d{1,3}\[\/flash\]$/ig.exec(xml);
				if (arr != null) {
					play(arr[1],"");
				}else {
					play(0, xml);
				}
			});
		});
	</script>
	<?php if($_SESSION['username'] && $_SESSION['uid']){?>
		<script type="text/javascript">
			$(function(){
				var update_r = $("input[name=update]:radio");
				var ctype = $("input[name=ctype]:radio");
				var collection = $("input[name=collection]");
				if (<?php echo $updatefs['update'];?>){
					update_r.each(function(){
						if($(this).val() == "auto")
							this.checked = true;
					});
				}else{
					update_r.each(function(){
						if($(this).val() == "static")
							this.checked = true;
					});
				}
				if (<?php echo $updatefs['ctype'];?>) {
					ctype.each(function(){
						if($(this).val() == "plural")this.checked = true;
					});
				}else{
					ctype.each(function(){
						if ($(this).val() == "odd") 
							this.checked = true;
					});
				}
				if(<?php echo $updatefs['collection'];?>){
					collection.attr ("checked", true);
				}else{
					collection.attr ("checked", false);
				}
				if(<?php echo $updatefs['auto_disabled'];?>){
					update_r.each(function(){
						if($(this).val() == "static")
							this.checked = true;
					});
				}
			});
		</script>
	<?php }?>
	<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?>		<link href="http://localhost/proxy/./Proxy/App/Index/Tpl/Public/css/index.css" rel="stylesheet" type="text/css">
		<script type="text/javascript">
			function SetIndex(obj){
				try{
					obj.style.behavior='window.location(#default#homepage)';
					obj.setHomePage(window.location);
				}catch(e){
					if(window.netscape) {
						try {
							netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
						}catch (e) {
							alert("此操作被浏览器拒绝！\n请在浏览器地址栏输入“about:config”并回车\n然后将 [signed.applets.codebase_principal_support]的值设置为'true',双击即可。");
						}
							var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
							prefs.setCharPref('browser.startup.homepage',window.location);
					}else{
						alert("您的浏览器不支持，请按照下面步骤操作：1.打开浏览器设置。2.点击设置网页。3.输入：" + window.location + "点击确定。");
					}
				}
			}
		</script>
	</head>
	<body>
		<!-- 头部开始 -->
		<div class="header">
			<!-- 注册与登录信息栏开始 -->
			<div class="top-bar">
				<p class="left">
					<a href="Javascript:SetIndex(this)">设为首页</a> | <a href="Javascript:AddFavorite(WEB, 'YY智能采集')">加入收藏</a>
				</p>
				<p class="right">
					<?php if($_SESSION['username'] && $_SESSION['uid']){?>
						您好，<?php echo $_SESSION['username'];?>！欢迎来到YY影视智能采集！<a href="<?php echo U('Index/Login/out');?>" id="exit" title="退出">退出</a> | <a href="<?php echo U('Passport/Index/index');?>" title="个人中心">个人中心</a>
					<?php  }else{ ?>
						您好，欢迎来到YY影视智能采集！[<a href="#" title="登录" class="login">登录</a>] [<a href="#" title="免费注册" class="register">免费注册</a>]
					<?php }?>
					 | <a href="" title="新手入门">新手入门</a> <a href="#" title="偏好设置">偏好设置</a> <a href="<?php echo C("WEIBO");?>" title="微博">微博</a>
				</p>
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
							<ul class="reg-l-bottom">
								<li>已有账号，<a href="" id="login-now">马上登录</a></li>
								<li><a href="<?php echo U('Passport/Qqlogin/login');?>" class="qq_login" title="使用QQ登录"></a></li>
							</ul>
						</div>
						<div class="reg-right">
							<!-- 注册表单开始 -->
							<form action="<?php echo U('Index/Register/register');?>" method="post" name="register">
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
										<img src="<?php echo U('Index/Register/code');?>" width="99" height="35" alt="验证码" id="verify-img">
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
						<form action="<?php echo U('Index/Login/login');?>" method="post" name="login">
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
										<input type="checkbox" checked="checked" name="auto" id="auto-login">下一次自动登录
									</label>
									<a href="" id="regis-now">注册新账号</a>
								</li>
								<li>
									<input type="submit" value="" id="login-btn">
								</li>
								<li><a href="<?php echo U('Passport/Qqlogin/login');?>" class="qq_login" title="使用QQ登录"></a></li>
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
		<!-- LOGO与采集提交按钮开始 -->
		<div class="title">
			<div class="logo"> <a href="http://localhost/proxy" title="访问首页"><img src="http://localhost/proxy/./Proxy/App/Index/Tpl/Public/images/logo.png" alt="影片采集系统"></a> </div>
			<div class="collect_input">
				<p class="text"> 请输入所有 <a href="#" title="支持网站">支持网站</a> 的视频地址或专辑列表地址 </p>
				<form action="<?php echo U('Index/parse');?>" method="post" name="collect">
					<div class="input">
						<input id="kw" type="text" name="websiteText" size="45" value="<?php echo $website;?>">
							<input class="sub" type="submit" value="开始">
							<?php if($_SESSION['username'] && $_SESSION['uid']){?>
								<a href="javascript:re("kw");" class="sub" id="re">替换地址</a>
							<?php }?>
						<?php if($_SESSION['username'] && $_SESSION['uid']){?>
							<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Index/Tpl/Public/js/collection.js"></script>
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
									<label style="margin-right: 10px; float: left;">
										<input name="collection" type="checkbox" value="collection">
										采集合集 </label>
									<span id="collection_type">
											<label>
												<input name="ctype" type="radio" value="odd">
												单集</label>
											<label>
												<input name="ctype" type="radio" value="plural">
												多集</label>
										<a href="javascript:void(0)" id="delete_tmp" title="清除缓存数据">清除缓存</a>
									</span>
								</li>
							</ul>
						<?php }?>
					</div>
				</form>
			</div>
		</div>
		<!-- LOGO与采集提交按钮结束 -->
	</div>
	<!-- 头部结束 -->
	<!-- 导航条开始 -->
	<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?>	<div class="navPanel">
		<ul class="innerNavPanel">
			<li><a href="<?php echo U('Index/index');?>" class="buttons-active" title="首页">首页</a></li>
			<li><a href="<?php echo U('About/teacher');?>" title="新手入门">新手入门</a></li>
			<li><a href="<?php echo U('About/help');?>" title="常见问题">常见问题</a></li>
			<li><a href="<?php echo U('About/url');?>" title="支持列表">支持列表</a></li>
			<li><a href="#" title="偏好设置">偏好设置</a></li>
			<li><a href="<?php echo U('About/gb');?>" title="留言簿">留言簿</a></li>
			<li><a target="_blank" href="<?php echo C("BLOG");?>" title="官方博客">官方博客</a></li>
			<li><a target="_blank" href="<?php echo C("WEIBO");?>" class="weibo" title="微博">微博</a></li>
			<li><a href="#" title="公司简介">公司简介</a></li>
		</ul>
	</div>
	<!-- 导航条结束 -->
	<!-- 主体部分开始 -->
	<div class="main">
		<!-- 视频信息开始 -->
		<div class="video_info">
			<span>当前解析视频：</span><?php echo $collect['vName'];?>
		</div>
		<!-- 视频信息结束 -->
		<!-- 功能按钮开始 -->
		<ul class="buttons">
			<li>
				<input class="sub" type="button" id="copy" value="复制">
			</li>
			<li>
				<form action="<?php echo U('Download/index');?>" method="post" name="download">
					<input type="hidden" name="vname" value="<?php echo $collect['vName'];?>">
					<input type="hidden" name="data" value="">
					<input class="sub" type="submit" value="下载到文件">
				</form>
			</li>
			<li>
				<input class="sub" type="button" id="play" value="播放">
			</li>
			<li>
				<input class="sub" type="button" id="validate_xml" value="检测列表语法">
			</li>
			<?php if($_SESSION['username'] && $_SESSION['uid'] && $_SESSION['usergroup'] == 1){?>
				<!-- 上传开始 -->
				<li id="upload">
					<input class="sub" type="button" id="upload" value="上传到服务器">
				</li>
				<form action="<?php echo U('Upload/index');?>" method="post" name="upload">
				<!-- 上传结束 -->
			<?php }?>
		</ul>
		<!-- 功能按钮结束 -->
		<!-- 显示XML代码开始 -->
		<div id="lists">
			<textarea id="editxml" wrap="virtual" name="xml"><?php echo $yyurl;?><?php echo $collect['xml'];?></textarea>
			<?php if(!$_SESSION['username'] && !$_SESSION['uid']){?>
				<script type="text/javascript">
					$(function(){
						$("#editxml").attr("readonly","<?php echo $readonly;?>");
					});
				</script>
			<?php }?>
		</div>
		<!-- 显示XML代码结束 -->
		<?php if($_SESSION['username'] && $_SESSION['uid'] && $_SESSION['usergroup'] == 1){?>
			<!-- 弹出分类框开始 -->
			<div id="category">
				<p class="title">
					<span>请选择分类</span>
					<a href="" class="close-window"></a>
				</p>
				<div class="sel">
					<p>选择一个合适的分类：</p>
					<select name="cate-one" size="16">
						<?php $hd["list"]["n"]["total"]=0;if(isset($categorytop) && !empty($categorytop)):$_id_n=0;$_index_n=0;$lastn=min(1000,count($categorytop));
$hd["list"]["n"]["first"]=true;
$hd["list"]["n"]["last"]=false;
$_total_n=ceil($lastn/1);$hd["list"]["n"]["total"]=$_total_n;
$_data_n = array_slice($categorytop,0,$lastn);
if(count($_data_n)==0):echo "";
else:
foreach($_data_n as $key=>$n):
if(($_id_n)%1==0):$_id_n++;else:$_id_n++;continue;endif;
$hd["list"]["n"]["index"]=++$_index_n;
if($_index_n>=$_total_n):$hd["list"]["n"]["last"]=true;endif;?>

							<option value="<?php echo $n['entitle'];?>"><?php echo $n['cntitle'];?></option>
						<?php $hd["list"]["n"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>
					</select>
					<select name="cate-two" size="16" class="hidden"></select>
					<p class="vname">
						<label>上传的文件名称：<input type="text" name="vname" size="10" value="<?php echo $collect['vName'];?>"></label>
						<label style="margin-left: 55px">公会ID：
							<?php if($_SESSION['userunion']){?>
								<input type="text" name="userunion" value="<?php echo $_SESSION['userunion'];?>" size="11">
							<?php  }else{ ?>
								<input type="text" name="userunion" value="请输入频道ID" size="11">
							<?php }?>
						</label>
					</p>
				</div>
				<p class="bottom">
					<input type="submit" id="ok" value="上传">
				</p>
			</div>
			<!-- 弹出分类框结束 -->
			</form>
			<div id="background"></div>
			<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Index/Tpl/Public/js/upload.js"></script>
		<?php }?>
	</div>
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