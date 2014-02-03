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
		URL = 'http://localhost/proxy/Admin/Lists/add.html';
		HDPHP = 'http://localhost/proxy/System/hdphp';
		HDPHPDATA = 'http://localhost/proxy/System/hdphp/Data';
		HDPHPTPL = 'http://localhost/proxy/System/hdphp/Lib/Tpl';
		HDPHPEXTEND = 'http://localhost/proxy/System/hdphp/Extend';
		APP = 'http://localhost/proxy/index.php/Admin';
		CONTROL = 'http://localhost/proxy/index.php/Admin/Lists';
		METH = 'http://localhost/proxy/index.php/Admin/Lists/add';
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
			$(function(){
				$(".play").click(function(){
					var list_website = "$hd.config.LIST_WEBSITE";
					var list_fix = "$hd.co.fig.LIST_FIX";
					var ptr = $(this).parents("tr");
					var path = list_website + ptr.children("td:nth-child(6)").html() + ptr.children("td:nth-child(3)").html() + list_fix;
					path = path.replace(/<wbr>/ig,"");
					play(path,0);
				});
			});
		</script>
		<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Admin/Tpl/Public/Js/cmp.js"></script>
		<script type="text/javascript" src="http://localhost/proxy/./Proxy/App/Admin/Tpl/Public/Js/copy.js"></script>
	</head>
	<body>
		<table class="tab">
			<thead>
				<tr>
					<th colspan="2">增加/编辑列表</th>
				</tr>
			</thead>
			<tbody>
				<form action="<?php echo U('Admin/Lists/add');?>" method="post">
					<tr>
						<td width="8%">影片名称：</td>
						<td><input type="text" name="vname" value=""></td>
					</tr>
					<tr>
						<td width="8%">影片分类：</td>
						<td>
							<select name="cate-one">
								<option value="0">请选择分类</option>
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
							<select name="cate-two" class="hidden"></select>
						</td>
					</tr>
					<tr>
						<td width="8%">影片内容：</td>
						<td><script type="text/javascript" charset="utf-8" src="http://localhost/proxy/System/hdphp/Extend/Org/Ueditor/ueditor.config.js"></script><script type="text/javascript" charset="utf-8" src="http://localhost/proxy/System/hdphp/Extend/Org/Ueditor/ueditor.all.min.js"></script><script type="text/javascript">UEDITOR_HOME_URL="http://localhost/proxy/System/hdphp/Extend/Org/Ueditor/"</script><script id="hd_xml" name="xml" type="text/plain"></script>
        <script type='text/javascript'>
        $(function(){
                var ue = UE.getEditor('hd_xml',{
                imageUrl:'http://localhost/proxy/index.php/Admin/Lists&m=ueditor_upload&water=1&uploadsize=2000000&maximagewidth=false&maximageheight=false'//处理上传脚本
                ,zIndex : 0
                ,autoClearinitialContent:false
                ,initialFrameWidth:"100%" //宽度1000
                ,initialFrameHeight:"300" //宽度1000
                ,autoHeightEnabled:false //是否自动长高,默认true
                ,autoFloatEnabled:false //是否保持toolbar的位置不动,默认true
                ,maximumWords:2000 //允许的最大字符数
                ,readonly : false //编辑器初始化结束后,编辑区域是否是只读的，默认是false
                ,wordCount:true //是否开启字数统计
                ,imagePath:''//图片修正地址
                , toolbars:[
            ['fullscreen', 'source', '|', 'undo', 'redo', '|',
                'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
                'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                'directionalityltr', 'directionalityrtl', 'indent', '|',
                'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
                'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
                'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music', 'attachment', 'map', 'gmap', 'insertframe','insertcode', 'pagebreak', 'template', 'background', '|',
                'horizontal', 'date', 'time', 'spechars', 'snapscreen', 'wordimage', '|',
                'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
                'print', 'preview', 'searchreplace', 'drafts']
            ]//工具按钮
                , initialStyle:'p{line-height:1em; font-size: 14px; }'
            });
        })
        </script></td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<input type="submit" class="input_button" value="上传">
						</td>
					</tr>
				</form>
			</tbody>
		</table>
	</body>
</html>