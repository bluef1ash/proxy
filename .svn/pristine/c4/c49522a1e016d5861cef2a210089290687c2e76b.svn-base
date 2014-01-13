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
		URL = 'http://localhost/proxy/Admin/System/web_set.html';
		HDPHP = 'http://localhost/proxy/System/hdphp';
		HDPHPDATA = 'http://localhost/proxy/System/hdphp/Data';
		HDPHPTPL = 'http://localhost/proxy/System/hdphp/Lib/Tpl';
		HDPHPEXTEND = 'http://localhost/proxy/System/hdphp/Extend';
		APP = 'http://localhost/proxy/index.php/Admin';
		CONTROL = 'http://localhost/proxy/index.php/Admin/System';
		METH = 'http://localhost/proxy/index.php/Admin/System/web_set';
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
		<title>网站全局配置</title>
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
						<th colspan="2" class="th">网站设置</th>
					</tr>
					<tr>
						<td align="right" width="45%">网站名称：</td>
						<td>
							 <input type="text" name="WEBNAME" value="<?php echo C("WEBNAME");?>">
						</td>
					</tr>
					<tr>
						<td align="right">网站关键词：</td>
						<td>
							 <input type="text" name="KEYWORDS" value="<?php echo C("KEYWORDS");?>" style="width:400px;">
						</td>
					</tr>
					<tr>
						<td align="right">网站描述：</td>
						<td>
							 <input type="text" name="DISCRIPTION" value="<?php echo C("DISCRIPTION");?>" style="width:400px;">
						</td>
					</tr>
					<tr>
						<td align="right">作者：</td>
						<td>
							<input type="text" style="width:400px;" name="AUTHOR" value="<?php echo C("AUTHOR");?>">
						</td> 
					</tr>
					<tr>
						<td align="right">版权信息：</td>
						<td>
							<input type="text" style="width:400px;" name="COPY" value="<?php echo C("COPY");?>">
						</td> 
					</tr>
					<tr>
						<td align="right">备案号：</td>
						<td>
							<input type="text" style="width:400px;" name="RECORD" value="<?php echo C("RECORD");?>">
						</td>
					</tr>
					<tr>
						<td align="right">联系邮箱：</td>
						<td>
							<input type="text" style="width:400px;" name="EMAIL" value="<?php echo C("EMAIL");?>">
						</td>
					</tr>
					<tr>
						<td align="right">QQ群：</td>
						<td>
							<input type="text" style="width:400px;" name="QQQUN" value="<?php echo C("QQQUN");?>">
						</td>
					</tr>
					<tr>
						<td align="right">YY群：</td>
						<td>
							<input type="text" style="width:400px;" name="YYQUN" value="<?php echo C("YYQUN");?>">
						</td>
					</tr>
					<tr>
						<td align="right">微博：</td>
						<td>
							<input type="text" style="width:400px;" name="WEIBO" value="<?php echo C("WEIBO");?>">
						</td>
					</tr>
					<tr>
						<td align="right">是否开放注册功能：</td>
						<?php if(C("RES_ON") == 1){?>
							<td>
								<input type="radio" name="RES_ON" value="1" checked="checked">开启
								<input type="radio" name="RES_ON" value="0">关闭
							</td>
						<?php  }else{ ?>
							<td>
								<input type="radio" name="RES_ON" value="1">开启
								<input type="radio" name="RES_ON" value="0" checked="checked">关闭
							</td>
						<?php }?>
					</tr>
					<tr>
						<td align="right">网站状态：</td>
						<?php if(C("WEB_ON") == 1){?>
							<td>
								<input type="radio" name="WEB_ON" value="1" checked="checked">开启
								<input type="radio" name="WEB_ON" value="0">关闭
							</td>
						<?php  }else{ ?>
							<td>
								<input type="radio" name="WEB_ON" value="1">开启
								<input type="radio" name="WEB_ON" value="0" checked="checked">关闭
							</td>
						<?php }?>
					</tr>
					<tr>
						<td colspan="2" height="60" align="center">
							<input type="hidden" name="config" value="web">
							<input type="submit" value="保存修改" class="input_button">
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</body>
</html>
