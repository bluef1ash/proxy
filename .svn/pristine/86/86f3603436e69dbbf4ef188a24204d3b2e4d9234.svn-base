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
		URL = 'http://localhost/proxy/Passport/Record/index.html';
		HDPHP = 'http://localhost/proxy/System/hdphp';
		HDPHPDATA = 'http://localhost/proxy/System/hdphp/Data';
		HDPHPTPL = 'http://localhost/proxy/System/hdphp/Lib/Tpl';
		HDPHPEXTEND = 'http://localhost/proxy/System/hdphp/Extend';
		APP = 'http://localhost/proxy/index.php/Passport';
		CONTROL = 'http://localhost/proxy/index.php/Passport/Record';
		METH = 'http://localhost/proxy/index.php/Passport/Record/index';
		GROUP = 'http://localhost/proxy/./Proxy/';
		TPL = 'http://localhost/proxy/./Proxy/App/Passport/Tpl';
		CONTROLTPL = 'http://localhost/proxy/./Proxy/App/Passport/Tpl/Record';
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
<title>查看列表-<?php echo C("WEBNAME");?></title>
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
			<li class="current_page_item"><a href="http://localhost/proxy/index.php/Passport">主页</a></li>
			<!--<li><a href="#">使用帮助</a></li>-->
			<li><a href="#">升级高级会员</a></li>
			<li><a href="<?php echo U('Passport/Contacts/information');?>">联系我们</a></li>
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
	<table border=1 align="center" width="100%" class="table1">
		<thead>
			<caption>上传过的列表</caption>
		</thead>
		<tbody>
			<tr>
				<th>影片名称</th>
				<th>上传时间</th>
				<th>所属分类</th>
				<th>操作</th>
			</tr>
			<?php $hd["list"]["n"]["total"]=0;if(isset($video) && !empty($video)):$_id_n=0;$_index_n=0;$lastn=min(1000,count($video));
$hd["list"]["n"]["first"]=true;
$hd["list"]["n"]["last"]=false;
$_total_n=ceil($lastn/1);$hd["list"]["n"]["total"]=$_total_n;
$_data_n = array_slice($video,0,$lastn);
if(count($_data_n)==0):echo "";
else:
foreach($_data_n as $key=>$n):
if(($_id_n)%1==0):$_id_n++;else:$_id_n++;continue;endif;
$hd["list"]["n"]["index"]=++$_index_n;
if($_index_n>=$_total_n):$hd["list"]["n"]["last"]=true;endif;?>

				<tr>
					<td><?php echo $n['cnname'];?></td>
					<td><?php echo date('Y-m-d h:i:s',$n['uploadtime']);?></td>
					<td><?php echo $n['cntitlec'];?>-><?php echo $n['cntitle'];?></td>
					<td><a href="<?php echo U('Passport/alter',array('vid'=>$n['vid']));?>">修改</a></td>
				</tr>
			<?php $hd["list"]["n"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>
		</tbody>
	</table>
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