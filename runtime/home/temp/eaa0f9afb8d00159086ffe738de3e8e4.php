<?php /*a:2:{s:65:"/www/wwwroot/www.ssyd.fun/app/home/view/helpfaq/wap/adeclare.html";i:1600139160;s:60:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/wap/tou2.html";i:1602249776;}*/ ?>
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
		<h1 class="title">回收说明</h1>
	</div>
	<button class="btn btn-service fr" type="button" data-toggle="matte" data-target="#service"><i class="iconfont iconfont-service"></i></button></header>
</div>
<div class="mycontent" id="mycontent">
	<div class="card-gradient">
		<div class="card">
			<div class="panel-heading">
				<h3 class="panel-title">二手卡回收说明</h3>
			</div>
			<div class="article">
				<div class="paragraph">
					<ul class="list list-decimal">
						<li>礼品卡回收成功后，金额将打入您的账户余额中，您需要通过实名认证之后才可提现；</li>
						<li>当选择的面值与实际面值不一致时，您将损失差额，而且会造成延迟到账，请正确选择；</li>
						<li>转让成功前请不要丢弃实体卡；</li>
						<li>您的账号因自身原因礼品卡被盗取或封存导致不能审核的责任由您自己承担，我们将直接撤单；</li>
						<li>若您重复提交同一卡号或故意提交错误信息的，我们会取消交易，并冻结您的账户信息；</li>
						<li>如果您私下将礼品卡信息交易给其他买家，并再次出售给本网站，造成的损失由您承担，我们将对您的账户信息进行冻结处理；</li>
						<li>礼品卡交易在未给您打款期间出现问题的话，您应积极配合解决问题，根据要求我们将延迟打款，如果问题没有解决我们将按责任轻重来加以处理；</li>
						<li>在您提交卡之前请详细阅读<a class="text-blue" href="<?php echo url('home/Helpfaq/protocol'); ?>">《<?php echo htmlentities($C['sitename']); ?>礼品卡转让协议》</a>，若因违反《<?php echo htmlentities($C['sitename']); ?>礼品卡转让协议》内容所造成的损失由违约人承担全部责任，并赔偿购买人的损失（违约金等）。</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
</section>

</body>
</html>