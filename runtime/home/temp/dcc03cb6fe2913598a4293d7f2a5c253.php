<?php /*a:2:{s:58:"/www/wwwroot/www.ssyd.fun/app/home/view/cash/wap/bank.html";i:1606274654;s:60:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/wap/tou2.html";i:1602249776;}*/ ?>
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
		<h1 class="title">我要提现</h1>
	</div>
	<button class="btn btn-service fr" type="button" data-toggle="matte" data-target="#service"><i class="iconfont iconfont-service"></i></button></header>
</div>
<div class="mycontent mycontent-hastabs" id="mycontent">
	<div class="myfixed">
		<div class="tabs navbar navbar-inverse">
			 <?php if($pei['alitype'] == '1'): ?>
			<a class="tab-item " href="<?php echo url('home/Cash/index'); ?>"><span>提现至支付宝</span></a><?php endif; if($pei['banktype'] == '1'): ?>
			<a class="tab-item active" href="<?php echo url('home/Cash/bank'); ?>"><span>提现至银行卡</span></a><?php endif; if($pei['wxtype'] == '1'): ?>
			<a class="tab-item" href="<?php echo url('home/Cash/weixin'); ?>"><span>提现至微信</span></a><?php endif; ?>
		</div>
	</div>
	<div class="form-primary">
		<form action="<?php echo url('home/Cash/withdraw'); ?>" method="post" id="formbtn">
			<div class="card">
				<div class="alert alert-alt alert-danger text-center" style="margin-bottom: 0; ">
					因费率及到账延时问题，银行卡每日限制提现1次<?php if($pei['bankfeilv'] == '0'): ?>,免手续费<?php else: if($pei['bankfeilv'] > '0.99'): ?>,每笔手续费<?php echo htmlentities($pei['bankfeilv']); ?>元<?php else: ?>,每笔手续费<?php echo htmlentities($pei['bankfeilv']); ?>%<?php endif; ?><?php endif; ?>
				</div>
				 <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?>
				<div class="cashlist" id="cashlist">
					<label class="cell cell-label" for="bank_<?php echo htmlentities($p['id']); ?>">
					<div class="cell-hd">
						<img class="img-36" src="<?php echo htmlentities($p['logo1']); ?>" alt="">
					</div>
					<div class="cell-bd">
						<h5 class="text-gray"><?php echo htmlentities($p['bankname']); ?></h5>
						<p>
							尾号 <?php echo substr($p['accounts'],-5); ?>
						</p>
					</div>
					<div class="cell-ft">
						<input class="icheck" type="radio" checked="" name="bank_id" id="bank_<?php echo htmlentities($p['id']); ?>" value="<?php echo htmlentities($p['id']); ?>"><i class="owlicon owlicon-checked"></i>
					</div>
					</label>
				</div>
				<?php endforeach; endif; else: echo "" ;endif; ?>
				<div class="card-footer">
					<div class="cell cell-condensed">
						<div class="cell-bd">
							<p class="text-light h5" data-dialog="<?php echo url('home/Bank/addbank'); ?>,600,添加银行卡">
								<i class="plus"></i> 添加银行卡帐号
							</p>
						</div>
						<div class="cell-ft">
							<a class="text-blue" href="<?php echo url('home/Member/setcash'); ?>">管理</a>
						</div>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="cell cash-primary">
					<div class="cell-hd">
						<label class="control-label" for="moneyoff">提现金额</label>
					</div>
					<div class="cell-bd">
						<input class="form-control" name="moneyoff" id="moneyoff" type="text" num="0|0.00" maxlength="8" null="请输入要提现的金额" placeholder="输入提现金额" reg="^\d+(\.\d+)?$" oninput="if(value.length>8)value=value.slice(0,8)">
					</div>
					<div class="cell-ft">
						可提现<?php echo htmlentities($user['money']); ?>
					</div>
				</div>
				<div class="cell cell-condensed">
					<div class="cell-bd">
						最低提现<?php echo htmlentities($pei['bank_min']); ?>元，单笔提现不能超过<?php echo htmlentities($pei['bank_max']); ?>元，推荐支付宝提现
					</div>
				</div>
			</div>
			<div class="card">
			   <div class="cell cash-primary">
					<div class="cell-hd">
						<label class="control-label" >安全密码</label>
					</div>
					<div class="cell-bd">
						<input class="form-control form-control-error" placeholder="输入安全密码"  name="paypass" id="paypass" null="请输入安全密码" type="password" value="" >
					</div>
				</div>
				</div>
			<div class="cells-tips text-center">
				<p class="text-light">
					如显示提现成功但仍未到账可联系客服查询银行处理结果
				</p>
			</div>
			<div class="myaction-wrapper">
				<div class="myaction">
					<div class="btn-group">
					    <?php echo token_field(); ?>
						 <input type="hidden" name="type" value="bank">
						<button class="btn btn-primary" type="button"  id="anjian" data-form="top-left,json" name="formbtn">确定提现</button>
					</div>
				</div>
			</div>
		</form>
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