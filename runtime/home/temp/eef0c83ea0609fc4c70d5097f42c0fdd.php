<?php /*a:3:{s:63:"/www/wwwroot/www.ssyd.fun/app/home/view/index/wap/category.html";i:1600587826;s:59:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/wap/tou.html";i:1605435128;s:63:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/wap/butmenu.html";i:1600139160;}*/ ?>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no, initial-scale=1,viewport-fit=cover">
<meta name="format-detection" content="telephone=no">
<meta name="format-detection" content="email=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="no" http-equiv="Cache-Control">
<title><?php echo htmlentities((string) $C['sitename']); ?>-<?php echo htmlentities((string) $C['title']); ?></title>
<meta name="keywords" content="<?php echo htmlentities((string) $C['keywords']); ?>">
<meta name="description" content="<?php echo htmlentities((string) $C['description']); ?>">
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
				请选择<?php echo htmlentities((string) $C['sitename']); ?>客服
			</p>
		</div>
		<div class="pullup-list">
			<a class="cell" href="mqqwpa://im/chat?chat_type=wpa&uin=<?php echo htmlentities((string) $C['qq']); ?>&version=1&src_type=web" id="zhiCustomBtn" rel="external nofollow">
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
	<header class="header header-floorbar"><button class="btn btn-back fl" type="button" onclick="javascript:history.back(-1);"><i class="iconfont iconfont-back"></i></button><a class="btn btn-guide fl" href="<?php echo url('home/helpfaq/helpa'); ?>"><i class="iconfont iconfont-book"></i></a>
	<div class="header-title">
		<h1 class="title">全部卡券回收</h1>
	</div>
	<button class="btn btn-service fr" type="button" data-toggle="matte" data-target="#service"><i class="iconfont iconfont-service"></i></button></header>
</div>
<style>
.hide29,.hide59,.hide61,.hide67,.hide71,.hide97,.hide104{display: none!important;}
</style>
<div class="mycontent mycontent-hasfooter mycontent-hastabs" id="mycontent">
	<div class="categorys-slider" id="categorys-slider">
		<div class="myfixed">
			<div class="tabs navbar navbar-inverse">
			  <?php if(is_array($cardModel) || $cardModel instanceof \think\Collection || $cardModel instanceof \think\Paginator): $i = 0; $__LIST__ = $cardModel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;if($p['istype'] == '0'): ?>
				<a class='tab-item <?php if($i == '1'): ?>class="active"<?php endif; ?>'><span><?php echo substr($p['title'],0,6); ?></span></a>
				<?php endif; ?>
			  <?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
		<div class="tempWrap" style="overflow:hidden; position:relative;">
			<div class="categorys clearfix" id="category-card" style="width: 2442px; position: relative; overflow: hidden; padding: 0px; margin: 0px; transition-duration: 200ms; transform: translate(0px, 0px) translateZ(0px); height: 2430px;">
			<?php if(is_array($cardModel) || $cardModel instanceof \think\Collection || $cardModel instanceof \think\Paginator): $i = 0; $__LIST__ = $cardModel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$k): $mod = ($i % 2 );++$i;if($k['istype'] == '0'): ?>
				<div class="categorys-item" style="display: table-cell; vertical-align: top; width: 407px;">
					<ul class="cardlists">
					  <?php if(is_array($k['comments']) || $k['comments'] instanceof \think\Collection || $k['comments'] instanceof \think\Paginator): $i = 0; $__LIST__ = $k['comments'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$b): $mod = ($i % 2 );++$i;?>
						<li class="hide<?php echo htmlentities((string) $b['id']); ?>"><a class="cell cell-access cardlist cardlist-<?php echo htmlentities((string) $b['id']); ?>" href="<?php echo url('home/card/index',['id'=>$b['id']]); ?>">
						<div class="cell-hd">
							<span class="brand"><img src="<?php echo htmlentities((string) $b['phoneRecycleIcon']); ?>"></span>
						</div>
						<div class="cell-bd">
							<h5 class="title"><?php echo htmlentities((string) $b['title']); ?></h5>
							<p class="discount">
								<?php echo hasTone($b['tid'],$b['type']); ?>
							</p>
						</div>
						<div class="cell-ft">
						</div>
						</a></li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				<?php endif; ?>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">$(document).ready(function(){TouchSlide({ slideCell: "#categorys-slider",titCell: ".myfixed a",mainCell: ".categorys",titOnClassName: "active",startFun:function(i){ var cheight = $("#category-card > .categorys-item:eq("+i+") > .cardlists").outerHeight();$("#category-card").css("height",cheight);}});});</script>

<div class="myfooter" id="myfooter">
	<div class="tabs floorbar">
		<a class="tab-item <?php if(($contr == 'Index')): ?>active<?php endif; ?>" href="/"><span class="icon icon-home"><i class="iconfont iconfont-home iconfont-normal"></i><i class="iconfont iconfont-home-full iconfont-active"></i></span><span>首页</span></a>
		<a class="tab-item " href="<?php echo url('home/card/index'); ?>"><span class="icon icon-sell"><i class="iconfont iconfont-sell iconfont-normal"></i><i class="iconfont iconfont-sell-full iconfont-active"></i></span><span>卖卡</span></a>
		<a class="tab-item " href="#"><span class="icon icon-buy"><i class="iconfont iconfont-buy iconfont-normal"></i><i class="iconfont iconfont-buy-full iconfont-active"></i></span><span>买卡</span></a>
		<a class="tab-item <?php if(($contr == 'Member')): ?>active<?php endif; ?>" href="<?php echo url('home/Member/index'); ?>"><span class="icon icon-my"><i class="iconfont iconfont-my iconfont-normal"></i><i class="iconfont iconfont-my-full iconfont-active"></i></span><span>我的</span></a>
	</div>
</div>
</section>
</body>
</html>