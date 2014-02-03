<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><?php if(!defined("HDPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<script type='text/javascript' src='http://localhost/proxy/System/hdphp/../hdjs/jquery-1.8.2.min.js'></script>
<link href='http://localhost/proxy/System/hdphp/../hdjs/css/hdjs.css' rel='stylesheet' media='screen'>
<script src='http://localhost/proxy/System/hdphp/../hdjs/js/hdjs.js'></script>
<script src='http://localhost/proxy/System/hdphp/../hdjs/js/slide.js'></script>
<script src='http://localhost/proxy/System/hdphp/../hdjs/org/cal/lhgcalendar.min.js'></script>
<script type='text/javascript'>
		HOST = 'http://localhost';
		ROOT = 'http://localhost/proxy';
		WEB = 'http://localhost/proxy/index.php';
		URL = 'http://localhost/proxy/Admin/Admin/add.html';
		HDPHP = 'http://localhost/proxy/System/hdphp';
		HDPHPDATA = 'http://localhost/proxy/System/hdphp/Data';
		HDPHPTPL = 'http://localhost/proxy/System/hdphp/Lib/Tpl';
		HDPHPEXTEND = 'http://localhost/proxy/System/hdphp/Extend';
		APP = 'http://localhost/proxy/index.php/Admin';
		CONTROL = 'http://localhost/proxy/index.php/Admin/Admin';
		METH = 'http://localhost/proxy/index.php/Admin/Admin/add';
		GROUP = 'http://localhost/proxy/./Proxy/';
		TPL = 'http://localhost/proxy/./Proxy/App/Admin/Tpl';
		CONTROLTPL = 'http://localhost/proxy/./Proxy/App/Admin/Tpl/Admin';
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
		<title>添加后台用户</title>
		<link rel="stylesheet" type="text/css" href="http://localhost/proxy/./Proxy/App/Admin/Tpl/Public/Css/add_category.css">
	</head>
	<body>
		<form action="<?php echo U('Admin/Admin/add');?>" method="post">
			<table class="tab">
				<tbody>
					<tr>
						<th class="th" colspan="2">添加后台用户</th>
					</tr>
					<tr>
						<td>用户名</td>
						<td><input type="text" name="username"></td>
					</tr>
					<tr>
						<td>密码：</td>
						<td><input type="password" name="passwdF"></td>
					</tr>
					<tr>
						<td>确认密码：</td>
						<td><input type="password" name="passwdS"></td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" value="添加" class="input_button">
							<input type="reset" class="input_button">
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</body>
</html>