<?php /*a:2:{s:62:"/www/wwwroot/www.ssyd.fun/app/home/view/helpfaq/wap/guide.html";i:1600139160;s:60:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/wap/tou2.html";i:1602249776;}*/ ?>
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
		<h1 class="title">回收流程</h1>
	</div>
	<button class="btn btn-service fr" type="button" data-toggle="matte" data-target="#service"><i class="iconfont iconfont-service"></i></button></header>
</div>
<div class="mycontent" id="mycontent">
	<div class="card-gradient">
		<div class="card guide-panel">
			<div class="article">
				<h3>注册登录</h3>
				<img src="/static/home/images/guide/sign.png" alt="">
				<p>
					注册卡卡礼品网账号<br>
					或者直接在登录页面<br>
					用手机号码获取短信验证码<br>
					直接完成注册并登录
				</p>
			</div>
		</div>
		<div class="card guide-panel">
			<div class="article">
				<h3>实名认证</h3>
				<img src="/static/home/images/guide/realname.png" alt="">
				<p>
					输入<strong class="text-orange">真实姓名</strong>及身份证号码<br>
					上传身份证正反面照片<br>
					手持本人身份证正面照<br>
					为了账户安全，实名认证后才可提现
				</p>
			</div>
		</div>
		<div class="card guide-panel">
			<div class="article">
				<h3>提交卡密</h3>
				<img src="/static/home/images/guide/refer.png" alt="">
				<p>
					选择<strong class="text-orange">正确的面值</strong><br>
					提交相对应<strong class="text-red">正确的卡号卡密</strong><br>
					等待客服人员验证<br>
					恶意提交会被封号哦~~
				</p>
			</div>
		</div>
		<div class="card guide-panel last">
			<div class="article">
				<h3>账户提现</h3>
				<img src="/static/home/images/guide/cash.png" alt="">
				<p>
					添加本人名下的<strong class="text-orange">提现账号</strong><br>
					进入提现页面提现<br>
					资金秒到账，偶尔有延迟<br>
					交易成功，如此简单
				</p>
			</div>
		</div>
		<div class="myaction">
			<div class="btn-group">
				<a class="btn btn-secondary" href="<?php echo url('home/Login/login'); ?>">注册/登录</a>
			</div>
		</div>
	</div>
</div>
</section>

</body>
</html>