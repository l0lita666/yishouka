<?php /*a:3:{s:60:"/www/wwwroot/www.ssyd.fun/app/home/view/index/wap/index.html";i:1603713304;s:59:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/wap/tou.html";i:1605435128;s:63:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/wap/butmenu.html";i:1600139160;}*/ ?>
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
	<header class="header header-floorbar"><button class="btn btn-back fl" type="button" onclick="javascript:history.back(-1);"><i class="iconfont iconfont-back"></i></button><a class="btn btn-guide fl" href="<?php echo url('home/Helpfaq/helpa'); ?>"><i class="iconfont iconfont-book"></i></a>
	<div class="header-title">
		<h1 class="title"><?php echo htmlentities($C['sitename']); ?></h1>
	</div>
	<button class="btn btn-service fr" type="button" data-toggle="matte" data-target="#service"><i class="iconfont iconfont-service"></i></button></header>
</div>
<div class="mycontent mycontent-hasfooter" id="mycontent">
	<div class="slider-panel">
		<!--<div class="arch-mask">
		</div>-->
		<div class="slider" id="slider">
			<div class="slider-pager">
				<ul class="pager-0">
					
				</ul>
			</div>
			<div class="tempWrap" style="overflow:hidden; position:relative;">
				<ul class="slider-imgs" >
				    <?php $_result=get_link(8,'desc');if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?>
					<li ><a href="<?php echo htmlentities($p['url']); ?>"><img class="shadow-blue" src="<?php echo htmlentities($p['image']); ?>"></a></li>
					<?php endforeach; endif; else: echo "" ;endif; ?>
					
				</ul>
			</div>
		</div>
	</div>
	<div class="card card-margin">
		<ul class="typeicon-group clearfix">
			<li><a href="<?php echo url('home/card/index',['cid'=>33]); ?>">
			    <span class="typeicon typeicon-bg-red"><i class="iconfont iconfont-type-ecard"></i></span><span>电商购物</span></a></li>
			<li><a href="<?php echo url('home/card/index',['cid'=>32]); ?>">
			    <span class="typeicon typeicon-bg-purple"><i class="iconfont iconfont-type-mobile"></i></span><span>话费充值卡</span></a></li>
			<li><a href="<?php echo url('home/card/index',['cid'=>39]); ?>">
			    <span class="typeicon typeicon-bg-pink"><i class="iconfont iconfont-type-oil"></i></span><span>加油充值卡</span></a></li>
			<li><a href="<?php echo url('home/card/index',['cid'=>34]); ?>">
			    <span class="typeicon typeicon-bg-cyan"><i class="iconfont iconfont-type-game"></i></span><span>游戏点卡</span></a></li>
			<li><a href="<?php echo url('home/card/index',['cid'=>35]); ?>">
			    <span class="typeicon typeicon-bg-orange"><i class="iconfont iconfont-type-foods"></i></span><span>美食出行</span></a></li>
			<li><a href="<?php echo url('home/card/index',['cid'=>37]); ?>">
			     <span class="typeicon typeicon-bg-green"><i class="iconfont iconfont-type-video"></i></span><span>视频音乐</span></a></li>
			<!--<li><a href="<?php echo url('home/xiaxian/index'); ?>"><span class="typeicon typeicon-bg-brow" style="font-size: .28rem;"><i class="iconfont iconfont-company-full"></i></span><span>同城交易</span></a></li>-->
			<li><a href="#"><span class="typeicon typeicon-bg-yellow"><i class="iconfont iconfont-type-more"></i></span><span>我要买卡</span></a></li>
		</ul>
	</div>
	<div class="card card-margin">
		<a class="cell cell-access kaka-notice" href="<?php echo url('home/helpfaq/index'); ?>">
		<div class="cell-hd">
			<img src="/static/home/images/bulletin.png" alt="">
		</div>
		<div class="cell-bd">
			<p class="ellipsis">
				<?php echo htmlentities($new['title']); ?>
			</p>
		</div>
		<div class="cell-ft hidden">
			<?php echo date("m-d",strtotime($new['update_time'])); ?>
		</div>
		</a>
	</div>
	<div class="card card-margin hotcards">
		<div class="panel-heading text-center">
			热门回收
		</div>
		<div class="panel-body">
			<div class="grids">
			<?php if(is_array($remen) || $remen instanceof \think\Collection || $remen instanceof \think\Paginator): $i = 0; $__LIST__ = $remen;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$b): $mod = ($i % 2 );++$i;?>
				<a class="grid" href="<?php echo url('home/card/index',['id'=>$b['id']]); ?>"><img src="<?php echo htmlentities($b['phoneRecycleIcon']); ?>"><span class="title"><?php echo htmlentities($b['title']); ?></span><span class="discount"><?php echo hasTone($b['tid'],$b['type']); ?></span></a>
			<?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
		<div class="panel-footer">
			<a class="cell cell-access cell-condensed" href="<?php echo url('home/Index/category'); ?>">
			<div class="cell-bd">
				<p class="text-blue text-center">
					查看更多礼品卡在线回收
				</p>
			</div>
			<div class="cell-ft">
			</div>
			</a>
		</div>
	</div>
	<?php if(!(empty($wx['appimg']) || (($wx['appimg'] instanceof \think\Collection || $wx['appimg'] instanceof \think\Paginator ) && $wx['appimg']->isEmpty()))): ?>
	<div class="card card-appdown" id="appdownload" style="display: none;">
		<button class="close" type="button" onclick="closeclick();"></button><a class="cell" href="<?php echo url('home/index/app'); ?>">
		<div class="cell-hd">
			<img class="img-48 img-radius" src="<?php echo htmlentities($wx['appimg']); ?>" alt="">
		</div>
		<div class="cell-bd">
			<h4><?php echo htmlentities($C['sitename']); ?>App</h4>
			<p>
				更简单、更快捷、更安全
			</p>
		</div>
		</a>
	</div>
	<script type="text/javascript">
	function cookiesave(n, v, mins, dn, path) {
			if (n) {
				if (!mins) mins = 365 * 24 * 60;
				if (!path) path = "/";
				var date = new Date();
				date.setTime(date.getTime() + (mins * 60 * 1000));
				var expires = "; expires=" + date.toGMTString();
				if (dn) dn = "domain=" + dn + "; ";
				document.cookie = n + "=" + v + expires + "; " + dn + "path=" + path;
			}
		}
		function cookieget(n) {
			var name = n + "=";
			var ca = document.cookie.split(';');
			for (var i = 0; i < ca.length; i++) {
				var c = ca[i];
				while (c.charAt(0) == ' ') c = c.substring(1, c.length);
				if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
			}
			return "";
		}
		function closeclick() {
			document.getElementById('appdownload').style.display = 'none';
			cookiesave('closeclick', 'closeclick', '', '', '');
		}
		function clickclose() {
			if (cookieget('closeclick') == 'closeclick') {
				document.getElementById('appdownload').style.display = 'none';
			} else {
				document.getElementById('appdownload').style.display = 'block';
			}
		}
		window.onload = clickclose;
</script>
	<?php endif; ?>
	<div class="footer text-center">
		<?php echo htmlentities($C['copyright']); ?>
		</p>
	</div>
</div>
	<script type="text/javascript">
		$(document).ready(function() {
			TouchSlide({
				slideCell: "#slider",
				titCell: ".slider-pager ul",
				mainCell: ".slider-imgs",
				autoPage: true,
				autoPlay: true,
				interTime: 5000,
				delayTime: 300,
				startFun: function(i, c) {
					$(".slider-pager ul").attr("class", "pager-" + i);
				}
			});
		});
	</script>
<div class="myfooter" id="myfooter">
	<div class="tabs floorbar">
		<a class="tab-item <?php if(($contr == 'Index')): ?>active<?php endif; ?>" href="/"><span class="icon icon-home"><i class="iconfont iconfont-home iconfont-normal"></i><i class="iconfont iconfont-home-full iconfont-active"></i></span><span>首页</span></a>
		<a class="tab-item " href="<?php echo url('home/card/index'); ?>"><span class="icon icon-sell"><i class="iconfont iconfont-sell iconfont-normal"></i><i class="iconfont iconfont-sell-full iconfont-active"></i></span><span>卖卡</span></a>
		<a class="tab-item " href="#"><span class="icon icon-buy"><i class="iconfont iconfont-buy iconfont-normal"></i><i class="iconfont iconfont-buy-full iconfont-active"></i></span><span>买卡</span></a>
		<a class="tab-item <?php if(($contr == 'Member')): ?>active<?php endif; ?>" href="<?php echo url('home/Member/index'); ?>"><span class="icon icon-my"><i class="iconfont iconfont-my iconfont-normal"></i><i class="iconfont iconfont-my-full iconfont-active"></i></span><span>我的</span></a>
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
<script>
  <?php echo htmlspecialchars_decode($C['tongji']); ?>
  </script>
</body>
</html>