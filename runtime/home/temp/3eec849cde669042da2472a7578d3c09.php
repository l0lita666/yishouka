<?php /*a:3:{s:61:"/www/wwwroot/www.ssyd.fun/app/home/view/member/wap/index.html";i:1605251896;s:60:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/wap/tou2.html";i:1602249776;s:63:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/wap/butmenu.html";i:1600139160;}*/ ?>
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
 .tubiao{
    background:url(/static/home/images/level/1.jpg) no-repeat
  }
  .act1{
        width: 16px;
    height: 16px;
    display: inline-block;
    background-position: -8px -16px;
	position: relative;
    top: 3px;
    margin-left: 2px
  }
  .act2{
    width: 16px;
    height: 16px;
    display: inline-block;
    background-position: -8px -48px;
	position: relative;
    top: 3px;
    margin-left: 2px
  }
  .act3{
    width: 16px;
    height: 16px;
    display: inline-block;
    background-position: -8px -79px;
	position: relative;
    top: 3px;
    margin-left: 2px
  }
  .tui{
         border-radius: 15px;
		padding: 1px 8px;
		font-size: 0.1rem;
		color: #FFF;
		background-color: #0085fe;
		background: -webkit-linear-gradient(to right, #0085fe 0%, #20d071 100%);
		background: linear-gradient(to right, #0085fe 0%, #10aeff 100%);
		box-shadow: 0 0.01rem 0.02rem #00aaff;
		border: 1px solid #0085fe;
  }
</style>
<div class="myheader" id="myheader">
	<header class="header header-sm"><button class="btn btn-back fl" type="button" onclick="javascript:history.back(-1);"><i class="iconfont iconfont-back"></i></button><a class="btn btn-guide fl" href="<?php echo url('home/Helpfaq/helpa'); ?>"><i class="iconfont iconfont-book"></i></a>
	<div class="header-title">
		<h1 class="title">我的帐户</h1>
	</div>
	<button class="btn btn-service fr" type="button" data-toggle="matte" data-target="#service"><i class="iconfont iconfont-service"></i></button></header>
</div>
<div class="mycontent mycontent-hasfooter" id="mycontent">
	<div class="gradient">
		<a class="cell cell-access account-profile" href="<?php echo url('home/Member/profile'); ?>">
		<div class="cell-hd">
			<i class="avatar avatar-default"></i>
		</div>
		<div class="cell-bd">
			<h3><?php echo htmlentities((isset($user['username']) && ($user['username'] !== '')?$user['username']:$user['mobile'])); ?> [商户ID：<?php echo htmlentities($user['shopid']); ?>]</h3>
			<p>
				欢迎登录<?php echo htmlentities($C['sitename']); ?>
			</p>
			<span class="tui">当前推广级别<span class="tubiao act<?php echo htmlentities($res['level']); ?>"></span></span>
		</div>
		<div class="cell-ft">
			<span class="h6">编辑</span>
		</div>
		</a>
		<?php if(($user['userReal']['retype'] == '0' || $user['userReal']['retype'] == '')): ?>
		<a class="account-realname" href="<?php echo url('home/Member/realname'); ?>">当前帐号还未实名认证，为了您的账户安全，请点击认证</a><?php endif; ?>
	</div>
	<div class="card-gradient">
		<div class="card">
			<div class="cell account-balance">
				<div class="cell-hd">
					<h5>账户余额（元）</h5>
					<p>
						<?php echo htmlentities($user['money']); ?>
					</p>
				</div>
				<div class="cell-bd">
					<a class="btn btn-sm btn-inline btn-default" href="<?php echo url('home/Cash/cashrecords'); ?>">记录</a><a class="btn btn-sm btn-inline btn-secondary" href="<?php echo url('home/Cash/index'); ?>"><i class="iconfont iconfont-cash"></i>我要提现</a>
				</div>
			</div>
		</div>
	</div>
	<div class="card">
		<a class="cell cell-access kaka-notice" href="<?php echo url('home/helpfaq/index'); ?>">
		<div class="cell-hd">
			<img src="/static/home/images/bulletin.png" alt="">
		</div>
		<div class="cell-bd">
			<p class="ellipsis">
				<?php echo htmlentities($new['title']); ?>
			</p>
		</div>
		<div class="cell-ft">
			<?php echo date("m-d",strtotime($new['update_time'])); ?>
		</div>
		</a>
	</div>
	<div class="card">
		<div class="cell account-deal">
			<a class="cell-bd" href="<?php echo url('home/Sellcard/statistics'); ?>"><i class="iconfont iconfont-statistics bg-red"></i><span>我的统计</span></a>
			<a class="cell-bd" href="<?php echo url('home/Sellcard/order'); ?>"><i class="iconfont iconfont-trade bg-info"></i><span>卖卡记录</span></a><a class="cell-bd" href="<?php echo url('home/Apiface/consign'); ?>"><i class="iconfont iconfont-order bg-pink"></i><span>API收单</span></a>
			<a class="cell-bd" href="<?php echo url('home/Apiface/statistics'); ?>"><i class="iconfont iconfont-history bg-orange"></i><span>API统计</span></a>
		</div>
	</div>
	<div class="card">
	    <a class="cell cell-access" href="<?php echo url('home/Member/assets'); ?>">
		<div class="cell-hd">
			<i class="iconfont iconfont-trip text-orange"></i>
		</div>
		<div class="cell-bd">
			邀请管理
		</div>
		<div class="cell-ft">
			<span class="h6">邀请有礼</span>
		</div>
		</a>
		
		<a class="cell cell-access" href="<?php echo url('home/Member/profile'); ?>">
		<div class="cell-hd">
			<i class="iconfont iconfont-set text-choc"></i>
		</div>
		<div class="cell-bd">
			资料管理
		</div>
		<div class="cell-ft">
			<span class="h6">手机/邮箱/实名认证</span>
		</div>
		</a>
		<?php if($xt=="IOS" && $wx['isourl']!=""): ?>
		<a class="cell cell-access" href="<?php echo htmlentities((isset($wx['isourl']) && ($wx['isourl'] !== '')?$wx['isourl']:"")); ?>">
		<div class="cell-hd">
			<i class="iconfont iconfont-hot text-choc"></i>
		</div>
		<div class="cell-bd">
			APP下载
		</div>
		<div class="cell-ft">
			<span class="h6">更简单、更快捷、更安全</span>
		</div>
		</a>
		<?php endif; if($xt=="Android" && $wx['apkurl']!=""): ?>
		<a class="cell cell-access" href="<?php echo htmlentities((isset($wx['apkurl']) && ($wx['apkurl'] !== '')?$wx['apkurl']:"")); ?>">
		<div class="cell-hd">
			<i class="iconfont iconfont-hot text-choc"></i>
		</div>
		<div class="cell-bd">
			APP下载
		</div>
		<div class="cell-ft">
			<span class="h6">更简单、更快捷、更安全</span>
		</div>
		</a>
		<?php endif; ?>
	</div>
	<div class="card">
		<a class="cell cell-access" href="<?php echo url('home/index/company'); ?>">
		<div class="cell-hd">
			<i class="iconfont iconfont-company text-orange"></i>
		</div>
		<div class="cell-bd">
			企业合作
		</div>
		<div class="cell-ft">
			<span class="h6">针对金融、保险等企业</span>
		</div>
		</a><a class="cell cell-access" href="<?php echo url('home/index/cooperation'); ?>">
		<div class="cell-hd">
			<i class="iconfont iconfont-cooperation text-orange"></i>
		</div>
		<div class="cell-bd">
			招商合作
		</div>
		<div class="cell-ft">
			<span class="h6">针对游戏公会，各类商家</span>
		</div>
		</a>
	</div>
	<div class="card">
		<a class="cell cell-access" href="<?php echo url('home/Index/feedback'); ?>">
		<div class="cell-hd">
			<i class="iconfont iconfont-feedback text-purple"></i>
		</div>
		<div class="cell-bd">
			建议反馈
		</div>
		<div class="cell-ft">
		</div>
		</a><a class="cell cell-access" href="<?php echo url('home/Member/memberlog'); ?>">
		<div class="cell-hd">
			<i class="iconfont iconfont-log text-purple"></i>
		</div>
		<div class="cell-bd">
			操作日志
		</div>
		<div class="cell-ft">
		</div>
		</a>
	</div>
</div>
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
</body>
</html>