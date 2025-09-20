<?php /*a:2:{s:64:"/www/wwwroot/www.ssyd.fun/app/home/view/account/wap/alireal.html";i:1600139160;s:60:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/wap/tou2.html";i:1602249776;}*/ ?>
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
	<header class="header header-default"><button class="btn btn-back fl" type="button" onclick="javascript:history.back(-1);"><i class="iconfont iconfont-back"></i></button><a class="btn btn-guide fl" href="<?php echo url('home/Helpfaq/helpa'); ?>"><i class="iconfont iconfont-book"></i></a>
	<div class="header-title">
		<h1 class="title">实名认证</h1>
	</div>
	<button class="btn btn-service fr" type="button" data-toggle="matte" data-target="#service"><i class="iconfont iconfont-service"></i></button></header>
</div>
<div class="mycontent mycontent-hastabs" id="mycontent">
	<div class="myfixed">
		<div class="tabs navbar navbar-inverse">
		 <?php if($isapi == '1'): ?><a class="tab-item active" href="<?php echo url('home/Account/index'); ?>"><span>支付宝认证</span></a><?php endif; ?><a class="tab-item " href="<?php echo url('home/Account/actrealname'); ?>"><span>身份证认证</span></a>
		</div>
	</div>
	<form id="uploadImage" method="post" action="<?php echo request()->url(); ?>">
		<div class="card">
			<div class="cell">
				<div class="cell-hd">
					<label class="control-label" for="truename">真实姓名</label>
				</div>
				<div class="cell-bd">
					<input type="text" class="form-control" id="username" name="username" value="" null="请输入真实姓名" placeholder="请输入真实姓名" reg="[\u4e00-\u9fa5]{2,10}" data-input="clear">
				</div>
			</div>
			<div class="cell">
				<div class="cell-hd">
					<label class="control-label" for="idcard">身份证号</label>
				</div>
				<div class="cell-bd">
					<input type="text" class="form-control" id="idcard" name="idcard" value="" null="请输入正确的身份证号码" placeholder="请输入您的身份证号码" reg="^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$" data-input="clear">
				</div>
			</div>
		</div>
		<div class="text-center">
			<p class="text-light">
				请输入与您支付宝一致的姓名和身份证号
			</p>
		</div>
		<div class="myaction-wrapper realname-alipay" id="realname-alipay">
			<div class="myaction">
				<div class="btn-group">
				    <?php echo token_field(); ?>
					<button class="btn btn-primary" type="button" data-form="top-left,json" id="anjian" name="uploadImage">开始认证</button>
				</div>
			</div>
		</div>
	</form>
</div>
<?php if(empty($user['mobile']) || (($user['mobile'] instanceof \think\Collection || $user['mobile'] instanceof \think\Paginator ) && $user['mobile']->isEmpty())): ?>
<div class="matte actionsheet in" id="realname-mobile">
	<div class="actionsheet-body">
		<div class="messager">
			<div class="messager-icon">
				<i class="iconfont iconfont-safe-phone"></i>
			</div>
			<div class="messager-text">
				<div class="messager-desc">
					为了账号安全，请先绑定手机号码
				</div>
			</div>
			<div class="verify-module">
				<form id="submitmobile">
					<div class="sign-form">
						<div class="form-group">
							<input class="form-control" id="phoneno" type="tel" name="phoneno" reg="^1[3|4|5|7|8][0-9]{9}$" null="请输入手机号码" value="" placeholder="请输入手机号码" data-input="clear">
						</div>
						<div class="form-group">
							<input class="form-control" id="codeno" name="codeno" type="number" null="请输入短信验证码" reg="[0-9]{6}" placeholder="请输入短信验证码">
							<div class="form-action">
								<a class="text-blue" href="javascript:;" data-href="<?php echo url('home/Api/sendMsg',['scene'=>'setphoto','tip'=>'phoneno']); ?>,,top-right,post" id="mcode">获取验证码</a>
							</div>
						</div>
						<div class="form-tips">
							<p>
								短信验证码5分钟内有效,若失效或未收到,请重新获取
							</p>
						</div>
						<div class="form-group btn-group">
							<button class="btn btn-primary" type="button" data-href="<?php echo url('home/Mobile/setphoto'); ?>,,top-left,post">提交绑定</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="backdrop in" id="backdrop">
	</div>
	<?php endif; ?>
</body>
</html>