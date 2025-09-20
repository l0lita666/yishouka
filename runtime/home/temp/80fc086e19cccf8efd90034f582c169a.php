<?php /*a:2:{s:63:"/www/wwwroot/www.ssyd.fun/app/home/view/index/wap/feedback.html";i:1600587826;s:60:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/wap/tou2.html";i:1602249776;}*/ ?>
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
		<h1 class="title">建议反馈</h1>
	</div>
	<button class="btn btn-service fr" type="button" data-toggle="matte" data-target="#service"><i class="iconfont iconfont-service"></i></button></header>
</div>
<div class="mycontent" id="mycontent">
	<form class="card-gradient" method="post" id="feedbackbtn" action="<?php echo url('home/Index/feedback'); ?>">
		<div class="card">
			<div class="cell cell-access">
				<div class="cell-hd">
					<label class="contaol-label text-light">选择卡种</label>
				</div>
				<div class="cell-bd">
					<select class="form-control" name="type" id="card_type">
					  <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?>
						<option value="<?php echo htmlentities((string) $p['type']); ?>"><?php echo htmlentities((string) $p['title']); ?></option>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</div>
				<div class="cell-ft">
				</div>
			</div>
			<div class="cell">
				<div class="cell-bd">
					<input class="form-control" id="title" name="title" type="text" placeholder="请输入标题（必填）" maxlength="20" null="请输入标题" data-input="clear">
				</div>
			</div>
			<div class="cell">
				<div class="cell-bd">
					<textarea class="form-textarea" id="content" name="content" placeholder="请详细描述您的问题或建议（必填）" null="请详细描述您的问题或建议" rows="6"></textarea>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="cell">
				<div class="cell-hd">
					<label class="contaol-label" for="">联系方式</label>
				</div>
				<div class="cell-bd">
					<input class="form-control" id="contact" name="contact" type="number" placeholder="请输入手机号码/QQ（必填）" null="请输入联系方式" maxlength="11" data-input="clear">
				</div>
			</div>
		</div>
		<div class="myaction-warpper">
			<div class="myaction">
				<div class="btn-group">
				<?php echo token_field(); ?>
					<button class="btn btn-primary" type="button" id="anjian" name="feedbackbtn" data-form="top-left,json">提交反馈</button>
				</div>
			</div>
		</div>
	</form>
</div>
</section>
</body>
</html>