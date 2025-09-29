<?php /*a:2:{s:59:"/www/wwwroot/ka1.y9fu.com/app/home/view/index/wap/miss.html";i:1600587826;s:60:"/www/wwwroot/ka1.y9fu.com/app/home/view/layout/wap/tou2.html";i:1602249776;}*/ ?>
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
		<h1 class="title">信息提示</h1>
	</div>
	<button class="btn btn-service fr" type="button" data-toggle="matte" data-target="#service"><i class="iconfont iconfont-service"></i></button></header>
</div>
<div class="mycontent" id="mycontent">
	<div class="messager">
		<div class="messager-icon">
			<i class="iconfont iconfont-empty"></i>
		</div>
		<div class="messager-text">
			<h2 class="messager-title">出错啦</h2>
			<p class="messager-desc">
				很抱歉,您访问的页面不存在
			</p>
		</div>
		<div class="messager-action">
			<div class="btn-group">
				<a class="btn btn-primary btn-block" href="javascript:history.go(-1);">返回上一页</a><a class="btn btn-default btn-block" href="/">返回首页</a>
			</div>
		</div>
	</div>
</div>
</section>
</body>
</html>