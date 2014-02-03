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
		URL = 'http://localhost/proxy/Admin/User/index.html';
		HDPHP = 'http://localhost/proxy/System/hdphp';
		HDPHPDATA = 'http://localhost/proxy/System/hdphp/Data';
		HDPHPTPL = 'http://localhost/proxy/System/hdphp/Lib/Tpl';
		HDPHPEXTEND = 'http://localhost/proxy/System/hdphp/Extend';
		APP = 'http://localhost/proxy/index.php/Admin';
		CONTROL = 'http://localhost/proxy/index.php/Admin/User';
		METH = 'http://localhost/proxy/index.php/Admin/User/index';
		GROUP = 'http://localhost/proxy/./Proxy/';
		TPL = 'http://localhost/proxy/./Proxy/App/Admin/Tpl';
		CONTROLTPL = 'http://localhost/proxy/./Proxy/App/Admin/Tpl/User';
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
		<title>前台用户管理</title>
		<link rel="stylesheet" type="text/css" href="http://localhost/proxy/./Proxy/App/Admin/Tpl/Public/Css/public.css">
		<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Admin/Tpl/Public/Js/public.js"></script>
	</head>
	<body>
		<table class="tab">
			<tr>
				<td class="th" colspan="20">用户列表</td>
			</tr>
			<tr class="tableTop">
				<td class="tdLittle1">ID</td>
				<td>用户名</td>
				<td>上传数</td>
				<td>最后登录时间</td>
				<td>最后登录IP</td>
				<td>注册时间</td>
				<td>帐号状态</td>
				<td>操作</td>
			</tr>
			<?php $hd["list"]["n"]["total"]=0;if(isset($user) && !empty($user)):$_id_n=0;$_index_n=0;$lastn=min(1000,count($user));
$hd["list"]["n"]["first"]=true;
$hd["list"]["n"]["last"]=false;
$_total_n=ceil($lastn/1);$hd["list"]["n"]["total"]=$_total_n;
$_data_n = array_slice($user,0,$lastn);
if(count($_data_n)==0):echo "";
else:
foreach($_data_n as $key=>$n):
if(($_id_n)%1==0):$_id_n++;else:$_id_n++;continue;endif;
$hd["list"]["n"]["index"]=++$_index_n;
if($_index_n>=$_total_n):$hd["list"]["n"]["last"]=true;endif;?>

				<tr>
					<td><?php echo $n['uid'];?></td>
					<td><?php echo $n['username'];?></td>
					<td><?php echo $n['count'];?></td>
					<?php if($n['logintime'] == 0){?>
						<td>从未登录</td>
					<?php  }else{ ?>
						<td><?php echo date('Y-m-d',$n['logintime']);?></td>
					<?php }?>
					<?php if($n['loginip'] == ''){?>
						<td>从未登录</td>
					<?php  }else{ ?>
						<td><?php echo $n['loginip'];?></td>
					<?php }?>
					<td><?php echo date('Y-m-d',$n['restime']);?></td>
					<?php if($n['userlock'] == 1){?>
						<td>锁定</td>
					<?php  }else{ ?>
						<td>正常</td>
					<?php }?>
					<td>
						<?php if($n['userlock'] == 1){?>
							<a href="<?php echo U('Admin/User/unlock_user', array('uid'=>$n['uid']));?>">解锁</a>
						<?php  }else{ ?>
							<a href="<?php echo U('Admin/User/lock_user', array('uid'=>$n['uid']));?>">锁定</a>
						<?php }?>
					</td>
				</tr>
			<?php $hd["list"]["n"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>
		</table>
	</body>
</html>