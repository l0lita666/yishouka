<?php /*a:2:{s:65:"/www/wwwroot/www.ssyd.fun/app/home/view/member/wap/memberlog.html";i:1600912894;s:60:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/wap/tou2.html";i:1602249776;}*/ ?>
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
		<h1 class="title">资金记录</h1>
	</div>
	<button class="btn btn-service fr" type="button" data-toggle="matte" data-target="#service"><i class="iconfont iconfont-service"></i></button></header>
</div>
<div class="mycontent" id="mycontent">
	<div class="card-gradient">
		<div class="panel">
		<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?>
		<div style="border-bottom: 1px solid #9c9b9b;">
		   <div class="cell">
				<div class="cell-bd">
					<span>日期</span><span style="margin-left:8px;color:#1e90ff"><?php echo htmlentities($p['addtime']); ?></span>
				</div>
			</div>
			<div class="cell">
				<div class="cell-bd">
					<h5>类型</h5>
					<p>
						<?php echo htmlentities($p['type']); ?>
					</p>
				</div>
				<div class="cell-bd">
					<h5>金额</h5>
					<?php if($p['price'] > '0'): ?>
					<p class="text-success">
						<?php echo htmlentities($p['price']); ?>
					</p>
					<?php else: ?>
					<p class="text-primary">
						<?php echo htmlentities($p['price']); ?>
					</p>
					<?php endif; ?>
				</div>
				<div class="cell-bd">
					<h5>余额</h5>
					<p>
						<?php echo htmlentities($p['money']); ?>
					</p>
				</div>
				<div class="cell-ft" >
					<h5 class="text-purple">关联订单</h5>
					<p class="text-purple">
						<?php echo htmlentities((isset($p['orderno']) && ($p['orderno'] !== '')?$p['orderno']:'--')); ?>
					</p>
				</div>
			</div>
			<div class="cell">
				<div class="cell-bd">
					<span>备注</span><span style="margin-left:8px;color:#999999"><?php echo htmlentities((isset($p['data']) && ($p['data'] !== '')?$p['data']:'--')); ?></span>
				</div>
			</div>
			</div>
			<?php endforeach; endif; else: echo "$empty" ;endif; ?>
		</div>
		<div class="card">
			<div class="page">
				<?php echo $data; ?>
			</div>
		</div>
	</div>
</div>
</section>
</body>