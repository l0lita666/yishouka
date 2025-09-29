<?php /*a:2:{s:60:"/www/wwwroot/www.ssyd.fun/app/home/view/login/wap/index.html";i:1759121528;s:60:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/wap/tou2.html";i:1602249776;}*/ ?>
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
	<style>
	.logo-brand {
		display: block;
		margin: 0 auto;
		margin-top: .15rem;
		margin-bottom: .4rem;
		width: 2rem;
		height: .58rem;
		overflow: hidden;
		text-align: center;
		background: noset;
		background-size: 100%; 
     }
	</style>
<div class="myheader" id="myheader">
	<header class="header "><button class="btn btn-back fl" type="button" onclick="javascript:history.back(-1);"><i class="iconfont iconfont-back"></i></button><a class="btn btn-guide fl" href="<?php echo url('home/helpfaq/index'); ?>"><i class="iconfont iconfont-book"></i></a>
	<div class="header-title">
		<h1 class="title">登录<?php echo htmlentities($C['sitename']); ?></h1>
	</div>
	<button class="btn btn-service fr" type="button" data-toggle="matte" data-target="#service"><i class="iconfont iconfont-service"></i></button></header>
</div>
<div class="mycontent" id="mycontent">
	<div class="sign-form">
		<div class="logo-brand">
		<img src="<?php echo htmlentities($C['logo']); ?>">
		</div>
		<ul class="tabs tabs-pills login-tabs">
			<li class="tab-item"><span class="active" id="login1" onclick="setTaba('login', 1, 2);" href="javascript:;">帐号密码登录</span></li>
			<li class="tab-item"><span id="login2" onclick="setTaba('login', 2, 2);" href="javascript:;">手机验证码登录</span></li>
		</ul>
		<div class="sign-form-content">
			<div class="sigin-error" id="sign-error">
			</div>
			<div id="con_login_1">
				<form action="<?php echo request()->url(); ?>" method="post" id="login-form-0">
					<div class="form-group">
						<input class="form-control" name="username" id="username" type="text" placeholder="用户名/邮箱/手机号码" maxlength="20" value="" null="用户名不能为空" data-input="clear">
					</div>
					<div class="form-group">
						<input class="form-control" name="password" id="password" type="password" placeholder="登录密码" maxlength="20" null="请输入密码" err="登录密码错误" data-input="clear"><label class="passeye" for="onoff-password"><input type="checkbox" id="onoff-password"><i class="eye"></i></label>
					</div>
					<div class="form-group">
					    <?php echo token_field(); ?>
						<button class="btn btn-secondary" type="button" data-form="top-left,json" name="login-form-0">登录<?php echo htmlentities($C['sitename']); ?></button>
						<input type="hidden" name="type" value="0">
					</div>
				</form>
			</div>
			<div id="con_login_2" class="hide">
				<form action="<?php echo request()->url(); ?>" method="post" id="login-form-1">
					<div class="form-group form-group-icon">
						<label class="form-icon" for="username"><i class="iconfont icon-phone1"></i></label><input class="form-control" id="phoneno" type="text" name="phoneno" value="" placeholder="手机号码" null="手机号码不能为空" err="手机号码格式错误" reg="^1[3|4|5|6|7|8][0-9]{9}$" data-input="clear">
					</div>
					<div class="form-group form-group-icon">
						<label class="form-icon" for="password"><i class="iconfont icon-password"></i></label><input class="form-control" id="codeno" name="codeno" type="text" placeholder="手机验证码" null="请输入验证码" reg="[0-9]{6}">
						<div class="form-action">
							<a class="text-blue" href="javascript:;" data-href="<?php echo url('home/Api/sendMsg',['scene'=>'login','tip'=>'phoneno']); ?>,,top-left,post" id="mcode">获取验证码</a>
						</div>
					</div>
					<div class="form-group">
					   <?php echo token_field(); ?>
						<button class="btn btn-secondary" type="button" data-form="top-left,json" name="login-form-1">登录<?php echo htmlentities($C['sitename']); ?></button><input type="hidden" name="type" value="1">
					</div>
				</form>
			</div>
		</div>
		<div class="sign-links">
			<a class="text-blue" href="<?php echo url('home/Login/forgetpassword'); ?>">忘记密码?</a><span class="sep">·</span>没有账号？<a class="text-blue" href="<?php echo url('home/Login/register'); ?>">立即注册</a>
		</div>
		<div class="sign-other <?php if($isqq == '0'): ?>hidden<?php endif; ?>">
			<fieldset class="orline">
				<legend class="orline-title" align="center">其他登录方式</legend>
			</fieldset>
			<a class="btn btn-primary btn-sm btn-inline " href="javascript:;" target="_top" rel="nofollow" onclick="toQzoneLogin();"><i class="iconfont iconfont-sqq"></i> 使用QQ帐号登录</a>
		</div>
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