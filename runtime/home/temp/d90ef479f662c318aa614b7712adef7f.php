<?php /*a:2:{s:60:"/www/wwwroot/www.ssyd.fun/app/home/view/helpfaq/wap/faq.html";i:1600139160;s:60:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/wap/tou2.html";i:1602249776;}*/ ?>
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
		<h1 class="title">常见问题</h1>
	</div>
	<button class="btn btn-service fr" type="button" data-toggle="matte" data-target="#service"><i class="iconfont iconfont-service"></i></button></header>
</div>
<div class="mycontent" id="mycontent">
	<div class="card-gradient">
		<div class="card">
			<div class="accordion">
				<div class="accordion-header">
					<strong>1、</strong><?php echo htmlentities($C['sitename']); ?>支持回收的二手卡有哪些？
				</div>
				<div class="accordion-body">
					<p>
						<?php echo htmlentities($C['sitename']); ?>暂时只针对网站公布回收的二手卡进行回收处理，目前支持回收的卡包括电商卡、商超卡、加油卡、游戏卡、话费卡等50余种，如果没有您想要提交的卡，您可以联系客服，后期我们会会逐步的发布更多的卡类回收，详情请参考网站公示。
					</p>
				</div>
			</div>
			<div class="accordion">
				<div class="accordion-header">
					<strong>2、</strong>游戏卡与话费卡必看问题！
				</div>
				<div class="accordion-body">
					<p>
						游戏卡与话费卡为“自动结算”形式回收，用户提交订单后最快几分钟内即可收到回收款。
					</p>
					<p class="text-danger">
						<strong>请提交前认真核对选择的面额，如实际面额与选择面额不符，则需要人工干预，不仅费时费力，而且会影响您的款额到帐时间！</strong>
					</p>
				</div>
			</div>
			<div class="accordion">
				<div class="accordion-header">
					<strong>3、</strong>哪些二手卡卡不支持回收？
				</div>
				<div class="accordion-body">
					<p>
						凡是已使用的卡、偷盗卡、非正常渠道获得的卡以及网站上没有的卡种我们都不回收。
					</p>
				</div>
			</div>
			<div class="accordion">
				<div class="accordion-header">
					<strong>4、</strong>回收放款需要多少时间？
				</div>
				<div class="accordion-body">
					<p>
						工作时间内提交，一般两个小时内处理完成（特殊情况除外）；非工作时间内，处理时间将延期到下一个工作时间。
					</p>
				</div>
			</div>
			<div class="accordion">
				<div class="accordion-header">
					<strong>5、</strong>二手卡回收需要手续费么？
				</div>
				<div class="accordion-body">
					<p>
						您好，回收价格已经包含手续费，不会再收取任何形式的手续费（除了支付宝提现和加急处理功能外）。
					</p>
				</div>
			</div>
			<div class="accordion">
				<div class="accordion-header">
					<strong>6、</strong>电子卡与实体卡区别？
				</div>
				<div class="accordion-body">
					<p>
						实体卡是实物的，是一张卡片的形式，卡的背面有卡号和密码；电子卡是虚拟的，是通过网上在线购买获取卡号和密码的；
					</p>
					<p>
						实体卡和电子卡在我们这回收的时候都是一样的。
					</p>
				</div>
			</div>
			<div class="accordion">
				<div class="accordion-header">
					<strong>7、</strong>其他问题
				</div>
				<div class="accordion-body">
					<p>
						如若您有其他任何关于二手卡回收问题，您可以咨询在线客服QQ或者拨打<?php echo htmlentities($C['sitename']); ?>客服电话：400-999-0252。
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
</section>

</body>
</html>