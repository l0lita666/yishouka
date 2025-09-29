<?php /*a:2:{s:63:"/www/wwwroot/www.ssyd.fun/app/home/view/member/wap/profile.html";i:1600139160;s:60:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/wap/tou2.html";i:1602249776;}*/ ?>
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
		<h1 class="title">资料管理</h1>
	</div>
	<button class="btn btn-service fr" type="button" data-toggle="matte" data-target="#service"><i class="iconfont iconfont-service"></i></button></header>
</div>
<div class="mycontent" id="mycontent">
	<div class="card-gradient">
		<div class="card">
			<div class="cell">
				<div class="cell-bd">
					用户账号
				</div>
				<div class="cell-ft">
					<?php echo htmlentities($user['username']); ?>
				</div>
			</div>
			
			<?php switch($user['userReal']['retype']): case "1": ?>
			<a class="cell cell-access" href="<?php echo url('home/Member/realname'); ?>">
			<div class="cell-bd">
				真实姓名&nbsp; <span class="label label-success">已实名认证</span>
			</div>
			<div class="cell-ft">
				<span class="h6 text-light"><?php echo htmlentities($user['userReal']['name']); ?></span>
			</div>
			</a>
			<?php break; case "2": ?>
		   <a class="cell cell-access" href="<?php echo url('home/Member/realname'); ?>">
		    <div class="cell-bd">
				法人姓名&nbsp; <span class="label label-success">法人认证</span>
			</div>
			<div class="cell-ft">
				<span class="h6 text-light"><?php echo htmlentities($user['userReal']['name']); ?></span>
			</div>
			</a><a class="cell cell-access" href="<?php echo url('home/Member/realname'); ?>">
			<div class="cell-bd">
				企业名称&nbsp; <span class="label label-info">企业认证</span>
			</div>
			<div class="cell-ft">
				<span class="h6 text-light"><?php echo htmlentities($user['userReal']['company_name']); ?> </span>
			</div></a>
			<?php break; default: ?>
		   <a class="cell cell-access" href="<?php echo url('home/Member/realname'); ?>">
		    <div class="cell-bd">
				真实姓名&nbsp; <span class="label label-primary">未实名认证</span>
			</div>
			<div class="cell-ft">
				<span class="h6 text-light">未实名</span>
			</div>
			</a>
		   <?php endswitch; ?>
			
			<a class="cell cell-access" href="<?php echo url('home/Member/setcash'); ?>">
			<div class="cell-bd">
				提现账号
			</div>
			<div class="cell-ft">
				<span class="h6 text-light">管理</span>
			</div>
			</a><a class="cell cell-access" href="javascript:;" onclick="geteditqq();">
			<div class="cell-bd">
				联系QQ
			</div>
			<div class="cell-ft">
			    <?php if(empty($user['qq']) || (($user['qq'] instanceof \think\Collection || $user['qq'] instanceof \think\Paginator ) && $user['qq']->isEmpty())): ?>
			    <span class="h6 text-blue">设置QQ号码</span>
				<?php else: ?>
				<span class="h6 text-light"><?php echo htmlentities((isset($user['qq']) && ($user['qq'] !== '')?$user['qq']:'')); ?></span>
				<?php endif; ?>
			</div>
			</a>
		</div>
		<div class="card">
			<a class="cell cell-access" href="<?php echo url('home/Member/password'); ?>">
			<div class="cell-bd">
				登录密码
			</div>
			<div class="cell-ft">
				<span class="h6 text-light">修改登录密码</span>
			</div>
			</a>
			<a class="cell cell-access hidden" href="<?php echo url('home/Member/password'); ?>">
			<div class="cell-bd">
				安全密码
			</div>
			<div class="cell-ft">
				<span class="h6 text-light">修改安全密码</span>
			</div>
			</a>
			<a class="cell cell-access" href="<?php echo url('home/Member/photo'); ?>">
			<div class="cell-bd">
				手机号码
			</div>
			<div class="cell-ft">
			<?php if(empty($user['mobile']) || (($user['mobile'] instanceof \think\Collection || $user['mobile'] instanceof \think\Paginator ) && $user['mobile']->isEmpty())): ?>
			     <span class="h6 text-red">绑定手机</span>
			<?php else: ?>
				<span class="h6 text-light"><?php echo tfen($user['mobile'],3,4); ?></span>
				<?php endif; ?>
			</div>
			</a><a class="cell cell-access" href="<?php echo url('home/Member/email'); ?>">
			<div class="cell-bd">
				邮箱地址
			</div>
			<div class="cell-ft">
			<?php if(empty($user['email']) || (($user['email'] instanceof \think\Collection || $user['email'] instanceof \think\Paginator ) && $user['email']->isEmpty())): ?>
			     <span class="h6 text-red">绑定邮箱</span>
			<?php else: ?>
				<span class="h6 text-light"><?php echo tfen($user['email'],3,4); ?></span>
				<?php endif; ?>
			</div>
			</a>
			<div class="cell">
				<div class="cell-bd">
					注册时间
				</div>
				<div class="cell-ft">
					<span class="h6 text-light"><?php echo htmlentities($user['create_time']); ?></span>
				</div>
			</div>
		</div>
		<div class="card">
			<a class="cell" href="<?php echo url('home/Login/logout'); ?>">
			<div class="cell-bd text-center text-primary">
				退出账号
			</div>
			</a>
		</div>
	</div>
</div>
<div class="tooltip" id="tooltip" style="display: none;">
	<div class="tooltip-arrow">
	</div>
	<a class="tooltip-close close" href="javascript:;">×</a>
	<div class="tooltip-inner">
	</div>
</div>
</body>
</html>