<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><?php if(!defined("HDPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="shortcut icon" type="image/x-icon" href="http://localhost/proxy/./Proxy/App/Admin/Tpl/Public/images/favicon.ico">
		<script type='text/javascript' src='http://localhost/proxy/System/hdphp/../hdjs/jquery-1.8.2.min.js'></script>
<link href='http://localhost/proxy/System/hdphp/../hdjs/css/hdjs.css' rel='stylesheet' media='screen'>
<script src='http://localhost/proxy/System/hdphp/../hdjs/js/hdjs.js'></script>
<script src='http://localhost/proxy/System/hdphp/../hdjs/js/slide.js'></script>
<script src='http://localhost/proxy/System/hdphp/../hdjs/org/cal/lhgcalendar.min.js'></script>
<script type='text/javascript'>
		HOST = 'http://localhost';
		ROOT = 'http://localhost/proxy';
		WEB = 'http://localhost/proxy/index.php';
		URL = 'http://localhost/proxy/Admin/Lists/index.html';
		HDPHP = 'http://localhost/proxy/System/hdphp';
		HDPHPDATA = 'http://localhost/proxy/System/hdphp/Data';
		HDPHPTPL = 'http://localhost/proxy/System/hdphp/Lib/Tpl';
		HDPHPEXTEND = 'http://localhost/proxy/System/hdphp/Extend';
		APP = 'http://localhost/proxy/index.php/Admin';
		CONTROL = 'http://localhost/proxy/index.php/Admin/Lists';
		METH = 'http://localhost/proxy/index.php/Admin/Lists/index';
		GROUP = 'http://localhost/proxy/./Proxy';
		TPL = 'http://localhost/proxy/./Proxy/App/Admin/Tpl';
		CONTROLTPL = 'http://localhost/proxy/./Proxy/App/Admin/Tpl/Lists';
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
		<title>视频列表</title>
		<link rel="stylesheet" type="text/css" href="http://localhost/proxy/./Proxy/App/Admin/Tpl/Public/Css/move.css">
		<link rel="stylesheet" type="text/css" href="http://localhost/proxy/./Proxy/App/Admin/Tpl/Public/Css/public.css">
		<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Admin/Tpl/Public/Js/jquery.zclip.min.js"></script>
		<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Admin/Tpl/Public/Js/public.js"></script>
		<script type="text/javascript" src="http://localhost/proxy/Player/Cmp/cmp.js"></script>
		<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Admin/Tpl/Public/Js/move.js"></script>
		<script type="text/javascript">
			var prefix = "<?php echo $prefix;?>";
			var player_file = "<?php echo C("CMP_FILE");?>";
			$(function(){
				$(".play").click(function(){
					var ptr = $(this).parents("tr");
					var dates = /(\d{4}-\d{2})-\d{2}\s+\d{2}:\d{2}:\d{2}/ig.exec(ptr.children("td:nth-child(8)").html())[1].replace("-", "") + "/";
					var path = LIST_WEBSITE + ptr.children("td:nth-child(7)").html() + dates + ptr.children("td:nth-child(3)").html() + LIST_FIX;
					path = path.replace(/<wbr>/ig,"");
					var vname = ptr.children("td:nth-child(2)").html();
					play(path, vname);
				});
			});
		</script>
		<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Admin/Tpl/Public/Js/cmp.js"></script>
		<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Admin/Tpl/Public/Js/copy.js"></script>
	</head>
	<body>
		<table class="tab">
			<tr>
				<td class="th" colspan="20">视频列表</td>
			</tr>
			<tr class="tableTop">
				<td class="tdLittle1">ID</td>
				<td>中文影片名称</td>
				<td>英文影片名称</td>
				<td>上传用户</td>
				<td>上传用户所属频道</td>
				<td>中文分类名称</td>
				<td>英文分类名称</td>
				<td>上传时间</td>
				<td>操作</td>
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
					<td><?php echo $n['vid'];?></td>
					<td><?php echo $n['cnname'];?></td>
					<td><?php echo $n['enname'];?></td>
					<td><?php echo $n['username'];?></td>
					<td><?php echo $n['userunion'];?></td>
					<td><?php echo $n['cntitleF'];?>/<?php echo $n['cntitle'];?>/</td>
					<td><?php echo $n['entitleF'];?>/<?php echo $n['entitle'];?>/</td>
					<td><?php echo date('Y-m-d h:i:s',$n['uploadtime']);?></td>
					<td>
						<a href="#" class="copy">复制链接</a>
						<a href="#" class="play">播放</a>
						<a href="<?php echo U('Admin/Lists/alter', array('vid'=>$n['vid']));?>" class="alter">修改</a>
						<a href="#" class="move">移动文件</a>
						<a href="<?php echo U('Admin/Lists/delete', array('vid'=>$n['vid']));?>" class="del">删除</a>
					</td>
				</tr>
			<?php $hd["list"]["n"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>
		</table>
		<div class="page">
			共<?php echo $count;?>条 &nbsp;
			<?php echo $page;?>
		</div>
		<!-- 弹出分类框开始 -->
		<div id="category">
			<p class="title">
				<span>请选择分类</span>
				<a href="" class="close-window"></a>
			</p>
			<form action="<?php echo U('Admin/Lists/move');?>">
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
				</div>
				<p class="bottom">
					<input type="hidden" name="vid" value="">
					<input type="submit" id="ok" value="移动">
				</p>
			</form>
		</div>
		<div id="background"></div>
		<!-- 弹出分类框结束 -->
	</body>
</html>