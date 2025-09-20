<?php /*a:2:{s:62:"/www/wwwroot/www.ssyd.fun/app/home/view/helpfaq/wap/index.html";i:1600139160;s:59:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/wap/tou.html";i:1605435128;}*/ ?>
     <html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no, initial-scale=1,viewport-fit=cover">
<meta name="format-detection" content="telephone=no">
<meta name="format-detection" content="email=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="no" http-equiv="Cache-Control">
<title><?php echo htmlentities($C['sitename']); ?>-<?php echo htmlentities($C['title']); ?></title>
<meta name="keywords" content="<?php echo htmlentities($C['keywords']); ?>">
<meta name="description" content="<?php echo htmlentities($C['description']); ?>">
<link rel="stylesheet" href="/static/home/css/wap/owlui.animate.css?2019101">
<link rel="stylesheet" href="/static/home/css/wap/owlui.icon.css?2019101">
<link rel="stylesheet" href="/static/home/css/wap/owlui.css?202052">
<link rel="stylesheet" href="/static/home/css/wap/base.css?2020621">
<script src="/static/home/js/j_lipin.js?20190521"></script>
<script src="/static/home/js/library.js?20190521"></script>
<script src="/static/home/js/jquery.cookie.js?20181116"></script>
<script src="/static/home/js/wap/touchslide.js"></script>
<script src="/static/home/js/wap/base.js?202058"></script>
</head>
<body class="" ontouchstart="">
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
			<a class="cell" href="mqqwpa://im/chat?chat_type=wpa&uin=<?php echo htmlentities($C['qq']); ?>&version=1&src_type=web" id="zhiCustomBtn" rel="external nofollow">
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
	<header class="header "><button class="btn btn-back fl" type="button" onclick="javascript:history.back(-1);"><i class="iconfont iconfont-back"></i></button><a class="btn btn-guide fl" href="http://www.lipin.com/help-help.html"><i class="iconfont iconfont-book"></i></a>
	<div class="header-title">
		<h1 class="title">平台公告</h1>
	</div>
	<button class="btn btn-service fr" type="button" data-toggle="matte" data-target="#service"><i class="iconfont iconfont-service"></i></button></header>
</div>
<div class="mycontent" id="mycontent">
	<div class="card-gradient">
	<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?>
		<div class="card">
			<div class="card-body">
				<h3 class="card-title"><?php echo htmlentities($p['title']); ?></h3>
				<div class="card-desc">
				<?php echo htmlspecialchars_decode($p['content']); ?>
				</div>
			</div>
			<div class="card-footer">
				<div class="cell cell-access" onclick="more(this);">
					<div class="cell-bd">
						<span class="text-light">通知时间：<?php echo date("Y-m-d",strtotime($p['update_time'])); ?></span>
					</div>
					<div class="cell-ft">
						<span class="text-blue">详情</span>
					</div>
				</div>
			</div>
		</div>
		<?php endforeach; endif; else: echo "" ;endif; ?>
		<script>function more(obj){var _this = $(obj),_atxt = _this.find('.text-blue'),_selector = _this.closest('.card').find('.card-desc');if (_selector.hasClass('unfold')) {_selector.removeClass('unfold');_this.removeClass('owl');_atxt.html('详情');} else {_selector.addClass('unfold');_this.addClass('owl');_atxt.html('收起');}}</script>
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
<div class="backdrop" id="backdrop">
</div>
</body>
</html>
</html>