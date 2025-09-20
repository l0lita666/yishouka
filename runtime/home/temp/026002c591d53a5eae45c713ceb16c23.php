<?php /*a:2:{s:65:"/www/wwwroot/www.ssyd.fun/app/home/view/cash/wap/cashrecords.html";i:1600139160;s:60:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/wap/tou2.html";i:1602249776;}*/ ?>
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
 <style>
 .lay-span {
    padding: 3px 10px;
    color: #FFF;
    border-radius: 5px;
	}
 </style>
<div class="myheader" id="myheader">
	<header class="header "><button class="btn btn-back fl" type="button" onclick="javascript:history.back(-1);"><i class="iconfont iconfont-back"></i></button><a class="btn btn-guide fl" href="<?php echo url('home/helpfaq/index'); ?>"><i class="iconfont iconfont-book"></i></a>
	<div class="header-title">
		<h1 class="title"><span class="header-toggle" data-toggle="matte" data-target="#calendar">提现记录 <i class="iconfont iconfont-filter"></i></span></h1>
	</div>
	<button class="btn btn-service fr" type="button" data-toggle="matte" data-target="#service"><i class="iconfont iconfont-service"></i></button></header>
</div>
<div class="mycontent" id="mycontent">

	<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?>
		<div class="card">
		<a class="cell cell-access" href="">
		  <div class="cell-bd">
				<h5><span class="text-light">提现日期：</span><?php echo htmlentities((string) $p['create_time']); ?></h5>
				<p>
					<span class="text-light">提现金额：</span><?php echo htmlentities((string) $p['money']); ?>
				</p>
				<p>
					<span class="text-light">提现账号：</span><?php echo htmlentities((string) $p['bankname']); ?>-<?php echo htmlentities((string) $p['accounts']); ?>
				</p>
				<p>
					<span class="text-light">状态：</span><?php echo htmlspecialchars_decode($p['status']); ?>  - <span class="text-red"><?php echo htmlentities((string) $p['content']); ?></span>
				</p>
			</div>
			</a>
		</div>
      <?php endforeach; endif; else: echo "$empty" ;endif; ?>
		<div class="card">
		<?php echo $list; ?>
		</div>

	<div class="matte actionsheet" id="calendar">
		<div class="actionsheet-header">
			<h4>选择时间查询</h4>
			<button class="close" type="button" data-dismiss="matte"></button>
		</div>
		<div class="actionsheet-body">
			<div class="datafilter">
				<form action="<?php echo request()->url(); ?>" method="get" id="formsubmit">
					<div class="grids grids-tabs filter-date">
						<a class="grid " href="javascript:;" onclick="submitset('day',1)"><span>今天</span></a><a class="grid " href="javascript:;" onclick="submitset('day',7)"><span>最近7天</span></a><a class="grid " href="javascript:;" onclick="submitset('day',30)"><span>1个月</span></a><a class="grid " href="javascript:;" onclick="submitset('day',60)"><span>2个月</span></a><a class="grid " href="javascript:;" onclick="submitset('day',90)"><span>3个月</span></a><a class="grid " href="javascript:;" onclick="submitset('day',365)"><span>1年</span></a>
					</div>
					<input type="hidden" name="day" value="1">
				</form>
			</div>
		</div>
		<div class="actionsheet-action">
			<div class="btn-group">
				<a class="btn btn-primary" href="<?php echo url('home/Cash/cashrecords'); ?>">全部提现记录</a>
			</div>
		</div>
	</div>
</div>
</section>
</body>
</html>