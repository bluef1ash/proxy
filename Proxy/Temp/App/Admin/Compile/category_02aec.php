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
		URL = 'http://localhost/proxy/Admin/Category/category.html';
		HDPHP = 'http://localhost/proxy/System/hdphp';
		HDPHPDATA = 'http://localhost/proxy/System/hdphp/Data';
		HDPHPTPL = 'http://localhost/proxy/System/hdphp/Lib/Tpl';
		HDPHPEXTEND = 'http://localhost/proxy/System/hdphp/Extend';
		APP = 'http://localhost/proxy/index.php/Admin';
		CONTROL = 'http://localhost/proxy/index.php/Admin/Category';
		METH = 'http://localhost/proxy/index.php/Admin/Category/category';
		GROUP = 'http://localhost/proxy/./Proxy/';
		TPL = 'http://localhost/proxy/./Proxy/App/Admin/Tpl';
		CONTROLTPL = 'http://localhost/proxy/./Proxy/App/Admin/Tpl/Category';
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
		<title>分类列表</title>
		<link rel="stylesheet" type="text/css" href="http://localhost/proxy/./Proxy/App/Admin/Tpl/Public/Css/public.css">
		<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Admin/Tpl/Public/Js/public.js"></script>
		<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Admin/Tpl/Public/Js/category.js"></script>
	</head>
	<body>
		<table class="tab">
			<tr pid=0>
				<td class="th" colspan="20">分类列表</td>
			</tr>
			<tr pid=0 class="tableTop">
				<td class="tdLittle0 center">展开</td>
				<td class="tdLittle1">ID</td>
				<td>分类名称</td>
				<td class="tdLtitle7">操作</td>
			</tr>
			<?php $hd["list"]["n"]["total"]=0;if(isset($cate) && !empty($cate)):$_id_n=0;$_index_n=0;$lastn=min(1000,count($cate));
$hd["list"]["n"]["first"]=true;
$hd["list"]["n"]["last"]=false;
$_total_n=ceil($lastn/1);$hd["list"]["n"]["total"]=$_total_n;
$_data_n = array_slice($cate,0,$lastn);
if(count($_data_n)==0):echo "";
else:
foreach($_data_n as $key=>$n):
if(($_id_n)%1==0):$_id_n++;else:$_id_n++;continue;endif;
$hd["list"]["n"]["index"]=++$_index_n;
if($_index_n>=$_total_n):$hd["list"]["n"]["last"]=true;endif;?>

				<tr cid="<?php echo $n['cid'];?>" pid="<?php echo $n['pid'];?>">
					<td><a href="javascript:void(0)" class="showPlus"></a></td>
					<td><?php echo $n['cid'];?></td>
					<td><?php echo $n['html'];?><?php echo $n['cntitle'];?></td>
					<td>
						[<a href="<?php echo U('Admin/Category/add_cate', array('cid'=>$n['cid']));?>">添加子分类</a>][
						<a href="<?php echo U('Admin/Category/edit_cate', array('cid'=>$n['cid']));?>">修改</a>][
						<a href="<?php echo U('Admin/Category/del_cate', array('cid'=>$n['cid']));?>" class="del">删除</a>]
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