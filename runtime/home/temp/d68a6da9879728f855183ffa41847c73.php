<?php /*a:2:{s:62:"/www/wwwroot/www.ssyd.fun/app/home/view/member/wap/alipay.html";i:1600139160;s:60:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/wap/tou2.html";i:1602249776;}*/ ?>
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
	<header class="header "><button class="btn btn-back fl" type="button" onclick="javascript:history.back(-1);"><i class="iconfont iconfont-back"></i></button><a class="btn btn-guide fl" href="<?php echo url('home/helpfaq/index'); ?>"><i class="iconfont iconfont-book"></i></a>
	<div class="header-title">
		<h1 class="title">提现帐号管理</h1>
	</div>
	<button class="btn btn-service fr" type="button" data-toggle="matte" data-target="#service"><i class="iconfont iconfont-service"></i></button></header>
</div>
<div class="mycontent mycontent-hastabs" id="mycontent">
	<div class="myfixed">
		<div class="tabs navbar navbar-inverse">
		<?php if($pei['alitype'] == '1'): ?>
			<a id="setcash1" class="tab-item active" href="<?php echo url('home/Member/alipay'); ?>"><span>支付宝账号管理</span></a><?php endif; if($pei['banktype'] == '1'): ?>
			<a id="setcash2" class="tab-item " href="<?php echo url('home/Member/setcash'); ?>"><span>银行卡账号管理</span></a><?php endif; if($pei['wxtype'] == '1'): ?>
			<a id="setcash3" class="tab-item " href="<?php echo url('home/Member/weixin'); ?>"><span>微信账号管理</span></a><?php endif; ?>
		</div>
	</div>
	<div class="card cashcards">
		<div class="cell cell-condensed">
			<div class="cell-bd">
				我的支付宝
			</div>
			<div class="cell-ft">
				户名<?php if($user['userReal']['retype'] == '1'): ?><?php echo htmlentities((string) $user['userReal']['name']); else: ?><?php echo htmlentities((string) $user['userReal']['company_name']); ?><?php endif; ?>
			</div>
		</div>
		<div class="cashcards-group">
		  
			<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?>
			<div class="cell cell-access cashcard-alipay" data-dialog="<?php echo url('home/Bank/addalipay',['id'=>$p['id']]); ?>,600,编辑支付宝账户">
				<div class="cell-hd">
					<img src="/static/home/images/banks/alipay.png" alt="">
				</div>
				<div class="cell-bd">
					<h5>支付宝</h5>
					<p>
						<?php echo tfen($p['accounts'],2,5); ?>
					</p>
				</div>
				<div class="cell-ft">
				</div>
			</div>
			<?php endforeach; endif; else: echo "$empty" ;endif; ?>
		</div>
	</div>
	<div class="myaction-wrapper">
		<div class="myaction">
			<div class="btn-group">
				<button class="btn btn-primary" type="button" data-dialog="<?php echo url('home/Bank/addalipay'); ?>,600,添加支付宝账号">添加支付宝账号</button>
			</div>
		</div>
	</div>
	<?php if(($user['userReal']['retype']!=1 && $user['userReal']['retype']!=2)): ?>
	<div class="matte actionsheet in">
		<div class="actionsheet-body">
			<div class="messager">
				<div class="messager-icon">
					<i class="owlicon owlicon-safe-warn"></i><i class="avatar avatar-default"></i>
				</div>
				<div class="messager-text">
					<div class="messager-desc">
						为了账号资金安全，提现前必须实名认证
					</div>
				</div>
				<div class="btn-group">
					<a class="btn btn-primary" href="<?php echo url('home/Member/realname'); ?>">前往实名认证</a>
				</div>
			</div>
		</div>
	</div>
	<div class="backdrop in" id="backdrop">
	</div>
	<?php endif; ?>
</div>
</section>
<div class="tooltip" id="tooltip" style="display: none;">
	<div class="tooltip-arrow">
	</div>
	<a class="tooltip-close close" href="javascript:;">×</a>
	<div class="tooltip-inner">
	</div>
</div>
</body>