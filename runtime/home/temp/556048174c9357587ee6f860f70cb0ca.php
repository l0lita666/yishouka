<?php /*a:2:{s:64:"/www/wwwroot/www.ssyd.fun/app/home/view/helpfaq/wap/aboutus.html";i:1604123440;s:60:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/wap/tou2.html";i:1602249776;}*/ ?>
 <html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no, initial-scale=1,viewport-fit=cover">
<meta name="format-detection" content="telephone=no">
<meta name="format-detection" content="email=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="no" http-equiv="Cache-Control">
<title><?php echo htmlentities((string) $title); ?>-<?php echo htmlentities((string) $C['sitename']); ?></title>
<meta name="keywords" content="<?php echo htmlentities((string) $C['keywords']); ?>">
<meta name="description" content="<?php echo htmlentities((string) $C['description']); ?>">
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
				请选择<?php echo htmlentities((string) $C['sitename']); ?>客服
			</p>
		</div>
		<div class="pullup-list">
			<a class="cell" href="javascript:;" id="zhiCustomBtn" onclick="chatinit('905bce5dd3944726a64816bd7a9b34d9');;" rel="external nofollow">
			<div class="cell-bd">
				<i class="iconfont iconfont-xiaoxi"></i>在线客服咨询
			</div>
			</a><a class="cell" href="tel:<?php echo htmlentities((string) $C['kefu']); ?>">
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
		<h1 class="title">关于我们</h1>
	</div>
	<button class="btn btn-service fr" type="button" data-toggle="matte" data-target="#service"><i class="iconfont iconfont-service"></i></button></header>
</div>
<div class="mycontent" id="mycontent">
	<div class="card-gradient">
		<div class="card">
			<div class="panel-heading">
				<h3 class="panel-title">公司简介</h3>
			</div>
			<div class="article">
				<p>
					<?php echo htmlentities((string) $C['sitename']); ?>属于安徽邦麦客网络科技有限公司，是运营关于二手卡回收服务的网站，公司成立以来一直致力于卡回收、卡兑换、卡消费、卡资讯服务等业务的合作和拓展。
				</p>
				<p>
					目前，<?php echo htmlentities((string) $C['sitename']); ?>暂时只针对网站公布回收的卡进行回收处理。
				</p>
			</div>
		</div>
		<div class="card">
			<div class="panel-heading">
				<h3 class="panel-title">联系我们</h3>
			</div>
			<div class="article">
				<ul class="list list-disc">
					<li>公司名称：安徽邦麦客网络科技有公司</li>
					<li>客服热线：4000-518-288</li>
					<li>招商合作QQ：841240977</li>
					<li>公司地址：合肥市安粮国贸</li>
				</ul>
				<div class="btn-group">
					<a class="btn btn-secondary" href="tel:<?php echo htmlentities((string) $C['kefu']); ?>" rel="external nofollow">在线电话咨询</a>
					<a class="btn btn-primary" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo htmlentities((string) $C['qq']); ?>&amp;site=qq&amp;menu=yes" rel="external nofollow">在线QQ咨询</a>
				</div>
			</div>
		</div>
	</div>
</div>
</section>

</body>
</html>