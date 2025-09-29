<?php /*a:2:{s:62:"/www/wwwroot/www.ssyd.fun/app/home/view/helpfaq/wap/helpa.html";i:1605977518;s:60:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/wap/tou2.html";i:1602249776;}*/ ?>
 <html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no, initial-scale=1,viewport-fit=cover">
<meta name="format-detection" content="telephone=no">
<meta name="format-detection" content="email=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="no" http-equiv="Cache-Control">
<title><?php echo htmlentities($title); ?>-<?php echo htmlentities($C['sitename']); ?></title>
<meta name="keywords" content="<?php echo htmlentities($C['keywords']); ?>">
<meta name="description" content="<?php echo htmlentities($C['description']); ?>">
<link rel="stylesheet" href="/static/home/css/wap/owlui.animate.css?20191011">
<link rel="stylesheet" href="/static/home/css/wap/owlui.icon.css?20191011">
<link rel="stylesheet" href="/static/home/css/wap/owlui.css?2020526">
<link rel="stylesheet" href="/static/home/css/wap/base.css?2020629">
<script src="/static/home/js/wap/j_lipin.js?20190521"></script>
<script src="/static/home/js/wap/library.js?20190521"></script>
<script src="/static/home/js/jquery.cookie.js?20181116"></script>
<script src="/static/home/js/wap/touchslide.js"></script>
<script src="/static/home/js/wap/base.js?23"></script>
</head>
<body class="bg-white" ontouchstart="">
<div class="modal hide" id="modal-dialog">
</div>
<div class="modal-cover hide" id="modal-dialog-cover">
</div>
<section class="myapp" id="myapp">
<div class="matte pullup" id="service">
	<div class="pullup-content">
		<div class="pullup-title">
			<p class="actionsheet-title-text">
				请选择<?php echo htmlentities($C['sitename']); ?>客服
			</p>
		</div>
		<div class="pullup-list">
			<a class="cell" href="javascript:;" id="zhiCustomBtn" onclick="chatinit('905bce5dd3944726a64816bd7a9b34d9');;" rel="external nofollow">
			<div class="cell-bd">
				<i class="iconfont iconfont-xiaoxi"></i>在线客服咨询
			</div>
			</a><a class="cell" href="tel:<?php echo htmlentities($C['kefu']); ?>">
			<div class="cell-bd">
				<i class="iconfont iconfont-call"></i>在线客服电话
			</div>
			</a><a class="cell" href="/">
			<div class="cell-bd">
				<i class="iconfont iconfont-home"></i>返回首页
			</div>
			</a>
		</div>
	</div>
	<div class="pullup-content">
		<a class="cell" href="javascript:;" data-dismiss="matte" data-target="#service">
		<div class="cell-bd">
			取消
		</div>
		</a>
	</div>
</div>
<div class="myheader" id="myheader">
	<header class="header "><button class="btn btn-back fl" type="button" onclick="javascript:history.back(-1);"><i class="iconfont iconfont-back"></i></button><a class="btn btn-guide fl" href="<?php echo url('home/Helpfaq/helpa'); ?>"><i class="iconfont iconfont-book"></i></a>
	<div class="header-title">
		<h1 class="title">帮助中心</h1>
	</div>
	<button class="btn btn-service fr" type="button" data-toggle="matte" data-target="#service"><i class="iconfont iconfont-service"></i></button></header>
</div>
<div class="mycontent" id="mycontent">
	<!--H5端注释	<div class="card-gradient">
	<div class="card">
			<a class="cell cell-access" href="<?php echo url('home/Helpfaq/index'); ?>">
			<div class="cell-hd">
				<span class="icon-graphic bg-orange"><i class="iconfont iconfont-notice"></i></span>
			</div>
			<div class="cell-bd">
				<h3>平台通知</h3>
			</div>
			<div class="cell-ft">
			</div>
			</a><a class="cell cell-access" href="<?php echo url('home/Helpfaq/guide'); ?>">
			<div class="cell-hd">
				<span class="icon-graphic bg-red"><i class="iconfont iconfont-step"></i></span>
			</div>
			<div class="cell-bd">
				<h3>回收流程</h3>
			</div>
			<div class="cell-ft">
			</div>
			</a><a class="cell cell-access" href="<?php echo url('home/Helpfaq/aboutus'); ?>">
			<div class="cell-hd">
				<span class="icon-graphic bg-info"><i class="iconfont iconfont-about"></i></span>
			</div>
			<div class="cell-bd">
				<h3>关于我们</h3>
			</div>
			<div class="cell-ft">
			</div>
			</a><a class="cell cell-access" href="<?php echo url('home/index/cooperation'); ?>">
			<div class="cell-hd">
				<span class="icon-graphic bg-success"><i class="iconfont iconfont-cooperation"></i></span>
			</div>
			<div class="cell-bd">
				<h3>商务合作</h3>
			</div>
			<div class="cell-ft">
			</div>
			</a><a class="cell cell-access" href="<?php echo url('home/Index/feedback'); ?>">
			<div class="cell-hd">
				<span class="icon-graphic bg-pink"><i class="iconfont iconfont-feedback"></i></span>
			</div>
			<div class="cell-bd">
				<h3>反馈建议</h3>
			</div>
			<div class="cell-ft">
			</div>
			</a>
		</div> 
		<div class="card">
			<a class="cell cell-access" href="<?php echo url('home/Helpfaq/faq'); ?>">
			<div class="cell-bd">
				常见问题
			</div>    h5注释 -->
			<div class="cell-ft">
			</a><a class="cell cell-access" href="<?php echo url('home/Helpfaq/agreement'); ?>">  
			<div class="cell-bd">
				用户服务协议
			</div>
			<div class="cell-ft">
			</div>
			</a><a class="cell cell-access" href="<?php echo url('home/Helpfaq/privacy'); ?>">
			<div class="cell-bd">
				隐私政策
			</div>
			<div class="cell-ft">
			</div>
			</a><a class="cell cell-access" href="<?php echo url('home/Helpfaq/protocol'); ?>">
			<div class="cell-bd">
				礼品卡转让协议
			</div>
			<div class="cell-ft">
			</div>
			</a><a class="cell cell-access" href="<?php echo url('home/Helpfaq/adeclare'); ?>">
			<div class="cell-bd">
				礼品卡回收说明
			</div>
			<div class="cell-ft">
			</div>
			</a><a class="cell cell-access" href="<?php echo url('home/Helpfaq/api'); ?>">
			<div class="cell-bd">
				API接口
			</div>
			<div class="cell-ft">
			</div>
			</a>
		</div>
	</div>
</div>
</section>
<div class="tooltip" id="tooltip" style="display: none;">
	<div class="tooltip-arrow">
	</div>
	<a class="tooltip-close close" href="javascript:;">×</a>
	<div class="tooltip-inner">
	</div>
</div>
</body>
</html>