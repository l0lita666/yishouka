<?php /*a:2:{s:66:"/www/wwwroot/www.ssyd.fun/app/home/view/index/wap/cooperation.html";i:1600587826;s:60:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/wap/tou2.html";i:1602249776;}*/ ?>
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
	<header class="header "><button class="btn btn-back fl" type="button" onclick="javascript:history.back(-1);"><i class="iconfont iconfont-back"></i></button><a class="btn btn-guide fl" href="<?php echo url('home/helpfaq/index'); ?>"><i class="iconfont iconfont-book"></i></a>
	<div class="header-title">
		<h1 class="title">商家合作</h1>
	</div>
	<button class="btn btn-service fr" type="button" data-toggle="matte" data-target="#service"><i class="iconfont iconfont-service"></i></button></header>
</div>
<div class="mycontent" id="mycontent">
	<div class="card-gradient">
		<div class="card">
			<div class="panel-heading">
				<h3 class="panel-title">商务合作</h3>
			</div>
			<div class="article">
				<p>
					<?php echo htmlentities($C['sitename']); ?>现阶段主要针对保险类、金融类、运营商、航空类、互联网等公司：
				</p>
				<p>
					1、可替员工和客户发放福利；
				</p>
				<p>
					2、完善企业积分系统中的供货以及回购。
				</p>
				<br>
				<p>
					随着我司业务种类的不断增加，<?php echo htmlentities($C['sitename']); ?>平台也将诚招符合公司价值观的商家合作，希望能与您一起共筑美好的未来。
				</p>
				<p>
					<strong>企业合作、电商卡、商超卡、话费卡、游戏卡、等多项预付卡合作：</strong>
				</p>
				<p>
					合作电话：<?php echo htmlentities($C['kefu']); ?> <span class="text-light">(08:30-24:00)</span>
				</p>
				<div class="btn-group">
					<a class="btn btn-secondary" href="tel:<?php echo htmlentities($C['kefu']); ?>" rel="external nofollow">在线电话咨询</a>
					<!-- <a class="btn btn-primary" href="http://wpa.qq.com/msgrd?v=3&amp;uin=314732607&amp;site=qq&amp;menu=yes" rel="external nofollow">在线QQ咨询</a> -->
				</div>
			</div>
		</div>
	</div>
</div>
</section>
</body>
</html>