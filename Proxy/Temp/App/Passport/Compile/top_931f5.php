<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?>		<link href="http://127.0.0.1/proxy/./Proxy/App/Passport/Tpl/Public/Css/passport.css" rel="stylesheet" type="text/css">
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
					<a target="_blank" href="<?php echo C("WEIBO");?>">微博</a><a href="http://127.0.0.1/proxy">返回首页</a>
				</li>
			</ul>
			<img src="http://127.0.0.1/proxy/./Proxy/App/Passport/Tpl/Public/Images/mlogo.jpg" alt="个人中心">
		</div>
		<!-- 头部结束 -->
		<!-- 正文开始 -->