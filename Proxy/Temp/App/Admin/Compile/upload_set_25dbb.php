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
		URL = 'http://localhost/proxy/Admin/System/upload_set.html';
		HDPHP = 'http://localhost/proxy/System/hdphp';
		HDPHPDATA = 'http://localhost/proxy/System/hdphp/Data';
		HDPHPTPL = 'http://localhost/proxy/System/hdphp/Lib/Tpl';
		HDPHPEXTEND = 'http://localhost/proxy/System/hdphp/Extend';
		APP = 'http://localhost/proxy/index.php/Admin';
		CONTROL = 'http://localhost/proxy/index.php/Admin/System';
		METH = 'http://localhost/proxy/index.php/Admin/System/upload_set';
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
		<title>上传功能配置</title>
		<link rel="stylesheet" type="text/css" href="http://localhost/proxy/./Proxy/App/Admin/Tpl/Public/Css/public.css">
		<style type="text/css">
			.table input{
				height: 28px;
				vertical-align: middle;
			}
		</style>
	</head>
	<body>
		<form action="<?php echo U('Admin/Common/edit');?>" method="POST">
			<table class="tab">
				<thead></thead>
				<tbody>
					<tr>
						<th colspan="2" class="th">上传设置</th>
					</tr>
					<tr>
						<td align="right">是否开放上传功能：</td>
						<?php if(C("UPLOAD_ON") == 1){?>
							<td>
								<label><input type="radio" name="UPLOAD_ON" value="1" checked="checked">开启</label>
								<label><input type="radio" name="UPLOAD_ON" value="0">关闭</label>
							</td>
						<?php  }else{ ?>
							<td>
								<label><input type="radio" name="UPLOAD_ON" value="1">开启</label>
								<label><input type="radio" name="UPLOAD_ON" value="0" checked="checked">关闭</label>
							</td>
						<?php }?>
					</tr>
					<tr>
						<td align="right">视频名称非法关键字：</td>
						<td>
							 <input type="text" name="UPLOAD_KEYWORDS" value="<?php echo C("UPLOAD_KEYWORDS");?>">
							 <span>可以填写多个，以半角逗号分隔</span>
						</td>
					</tr>
					<tr>
						<td align="right">非法视频地址：</td>
						<td>
							 <input type="text" name="UPLOAD_URL" value="<?php echo C("UPLOAD_URL");?>">
							 <span>可以填写多个，以半角逗号分隔</span>
						</td>
					</tr>
					<tr>
						<td align="right">非法用户IP：</td>
						<td>
							 <input type="text" name="UPLOAD_IP" value="<?php echo C("UPLOAD_IP");?>">
							 <span>可以填写多个，以半角逗号分隔</span>
						</td>
					</tr>
					<tr>
						<td colspan="2" height="60" align="center">
							<input type="hidden" name="config" value="upload">
							<input type="submit" value="保存修改" class="input_button">
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</body>
</html>
