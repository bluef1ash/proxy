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
		URL = 'http://localhost/proxy/Admin/System/player_set.html';
		HDPHP = 'http://localhost/proxy/System/hdphp';
		HDPHPDATA = 'http://localhost/proxy/System/hdphp/Data';
		HDPHPTPL = 'http://localhost/proxy/System/hdphp/Lib/Tpl';
		HDPHPEXTEND = 'http://localhost/proxy/System/hdphp/Extend';
		APP = 'http://localhost/proxy/index.php/Admin';
		CONTROL = 'http://localhost/proxy/index.php/Admin/System';
		METH = 'http://localhost/proxy/index.php/Admin/System/player_set';
		GROUP = 'http://localhost/proxy/./Proxy/';
		TPL = 'http://localhost/proxy/./Proxy/App/Admin/Tpl';
		CONTROLTPL = 'http://localhost/proxy/./Proxy/App/Admin/Tpl/System';
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
		<title>播放器全局设置</title>
		<link rel="stylesheet" type="text/css" href="http://localhost/proxy/./Proxy/App/Admin/Tpl/Public/Css/public.css">
		<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Admin/Tpl/Public/Js/inttext.js"></script>
		<style type="text/css">
			.table input{
				height: 28px;
				vertical-align: middle;
			}
		</style>
		<script type="text/javascript">
			$(function(){
				$("#dingji_vars").click(function(){
					var dingji = $("input[name=DINGJI_STYLE]");
					var vars = "{dingji_var}";
					dingji.insertContent(vars);
				});
				$("#erji_vars").click(function(){
					var erji = $("input[name=ERJI_STYLE]");
					erji.insertContent("{erji_var}");
				});
			});
		</script>
	</head>
	<body>
		<form action="<?php echo U('Admin/Common/edit');?>" method="POST">
		<table class="tab">
			<thead></thead>
			<tbody>
				<tr>
					<th colspan="2" class="th">播放器设置</th>
				</tr>
				<tr>
					<td align="right">播放器根网址：</td>
					<td>
						<input type="text" style="width:400px;" name="CMP_ROOT" value="<?php echo C("CMP_ROOT");?>">
					</td>
				</tr>
				<tr>
					<td align="right">播放列表根网址：</td>
					<td>
						<input type="text" style="width:400px;" name="LIST_WEBSITE" value="<?php echo C("LIST_WEBSITE");?>">
					</td>
				</tr>
				<tr>
					<td align="right">列表更新本地路径：</td>
					<td>
						<input type="text" style="width:400px;" name="LIST_UPDATE_PATH" value="<?php echo C("LIST_UPDATE_PATH");?>">
					</td>
				</tr>
				<tr>
					<td align="right">上传文件的后缀名：</td>
					<td>
						<input type="text" style="width:400px;" name="LIST_FIX" value="<?php echo C("LIST_FIX");?>">
					</td>
				</tr>
				<tr>
					<td align="right">顶级频道样式：</td>
					<td>
						<input type="text" style="width:400px;" name="DINGJI_STYLE" value="<?php echo C("DINGJI_STYLE");?>"><a href="#" id="dingji_vars">插入影片名变量</a>
					</td>
				</tr>
				<tr>
					<td align="right">顶级频道名称之间空格数：</td>
					<td>
						<input type="text" style="width:400px;" name="DING_VNAME_SPACE" value="<?php echo C("DING_VNAME_SPACE");?>">
					</td>
				</tr>
				<tr>
					<td align="right">二级频道样式：</td>
					<td>
						<input type="text" style="width:400px;" name="ERJI_STYLE" value="<?php echo C("ERJI_STYLE");?>"><a href="#" id="erji_vars">插入影片名变量</a>
					</td>
				</tr>
				<tr>
					<td align="right">二级频道名称之间空格数：</td>
					<td>
						<input type="text" style="width:400px;" name="ER_VNAME_SPACE" value="<?php echo C("ER_VNAME_SPACE");?>">
					</td>
				</tr>
				<tr>
					<td colspan="2" height="60" align="center">
						<input type="hidden" name="config" value="player">
						<input type="submit" value="保存修改" class="input_button">
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>
