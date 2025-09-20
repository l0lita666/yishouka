<?php /*a:2:{s:68:"/www/wwwroot/www.ssyd.fun/app/home/view/account/wap/actrealname.html";i:1600139160;s:60:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/wap/tou2.html";i:1602249776;}*/ ?>
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
			 <?php if($isapi == '1'): ?><a class="tab-item " href="<?php echo url('home/Account/index'); ?>"><span>支付宝认证</span></a><?php endif; ?><a class="tab-item active" href="<?php echo url('home/Account/actrealname'); ?>"><span>身份证认证</span></a>
		</div>
	</div>
	<form id="uploadImage" method="post" action="">
		<div class="card">
			<div class="cell">
				<div class="cell-hd">
					<label class="control-label" for="truename">真实姓名</label>
				</div>
				<div class="cell-bd">
					<input type="text" class="form-control" id="username" name="username" value="<?php echo htmlentities((string) (isset($da['name']) && ($da['name'] !== '')?$da['name']:'')); ?>" null="请输入真实姓名" placeholder="请输入真实姓名" reg="[\u4e00-\u9fa5]{2,10}" data-input="clear">
				</div>
			</div>
			<div class="cell">
				<div class="cell-hd">
					<label class="control-label" for="idcard">身份证号</label>
				</div>
				<div class="cell-bd">
					<input type="text" class="form-control" id="idcard" name="idcard" value="<?php echo htmlentities((string) (isset($da['idcard']) && ($da['idcard'] !== '')?$da['idcard']:'')); ?>" null="请输入正确的身份证号码" placeholder="请输入您的身份证号码" reg="^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$" data-input="clear">
				</div>
			</div>
		</div>
		<div class="realname-identity" id="realname-identity">
			<div class="card">
				<div class="cell">
					<div class="cell-bd">
						<ul class="realname-upload-group clearfix">
							<li>
							<h5>身份证正面照（<a class="text-blue" href="javascript:;" data-toggle="matte" data-target="#idcardFront">示例</a>）</h5>
							<div class="realname-upload">
								<div class="realname-upload-preview" id="preview_0">
									<div class="realname-upload-tips realname-upload-tips-<?php if(empty($da['positive_img']) || (($da['positive_img'] instanceof \think\Collection || $da['positive_img'] instanceof \think\Paginator ) && $da['positive_img']->isEmpty())): ?>front<?php else: ?>again<?php endif; ?>">
										<div class="camera">
											<i class="iconfont iconfont-camera"></i>
										</div>
									</div>
                                  <img src="<?php echo htmlentities((string) (isset($da['positive_img']) && ($da['positive_img'] !== '')?$da['positive_img']:'')); ?>">
								</div>
								<div class="realname-upload-btn webuploader-container" id="uploadfile_0">
									<div class="webuploader-pick" style="">
										上传图片
									</div>
									<div id="rt_rt_1efocqa5t1r9enhpcae1rfr16mf1" style="position: absolute; top: -250px; left: -16px; width: 195px; height: 98px; overflow: hidden; bottom: auto; right: auto;">
										<input type="file" name="file" class="webuploader-element-invisible" multiple="multiple" accept="image/*"><label style="opacity: 0; width: 100%; height: 100%; display: block; cursor: pointer; background: rgb(255, 255, 255);"></label>
									</div>
									
								</div>
								<div class="realname-upload-status hide" id="status_0">
									<div class="progress">
										<div class="progress-bar progress-bar-success">
										</div>
									</div>
									
								</div>
								<input type="hidden" name="idjust" id="idjus" value="<?php echo htmlentities((string) $da['positive_img']); ?>">
							</div>
							</li>
							<li>
							<h5>身份证反面照（<a class="text-blue" href="javascript:;" data-toggle="matte" data-target="#idcardBack">示例</a>）</h5>
							<div class="realname-upload">
								<div class="realname-upload-preview" id="preview_1">
									<div class="realname-upload-tips realname-upload-tips-<?php if(empty($da['back_img']) || (($da['back_img'] instanceof \think\Collection || $da['back_img'] instanceof \think\Paginator ) && $da['back_img']->isEmpty())): ?>front<?php else: ?>again<?php endif; ?>">
										<div class="camera">
											<i class="iconfont iconfont-camera"></i>
										</div>
									</div>
									<img src="<?php echo htmlentities((string) (isset($da['back_img']) && ($da['back_img'] !== '')?$da['back_img']:'')); ?>">
								</div>
								<div class="realname-upload-btn webuploader-container" id="uploadfile_1">
									<div class="webuploader-pick" style="">
										上传图片
									</div>
									<div id="rt_rt_1efocqa5v1mhrd571mn41qrodn35" style="position: absolute; top: -250px; left: -227px; width: 195px; height: 98px; overflow: hidden; bottom: auto; right: auto;">
										<input type="file" name="file" class="webuploader-element-invisible" multiple="multiple" accept="image/*"><label style="opacity: 0; width: 100%; height: 100%; display: block; cursor: pointer; background: rgb(255, 255, 255);"></label>
									</div>
								</div>
								<div class="realname-upload-status hide" id="status_1">
									<div class="progress">
										<div class="progress-bar progress-bar-success">
										</div>
									</div>
								</div>
								<input type="hidden" name="idback" id="idback" value="{da.back_img}">
							</div>
							</li>
							<li>
							<h5>手持身份证照片（<a class="text-blue" href="javascript:;" data-toggle="matte" data-target="#idcardHand">示例</a>）</h5>
							<div class="realname-upload">
								<div class="realname-upload-preview" id="preview_2">
									<div class="realname-upload-tips realname-upload-tips-<?php if(empty($da['hand_img']) || (($da['hand_img'] instanceof \think\Collection || $da['hand_img'] instanceof \think\Paginator ) && $da['hand_img']->isEmpty())): ?>front<?php else: ?>again<?php endif; ?>">
										<div class="camera">
											<i class="iconfont iconfont-camera"></i>
										</div>
									</div>
									<img src="<?php echo htmlentities((string) (isset($da['hand_img']) && ($da['hand_img'] !== '')?$da['hand_img']:'')); ?>">
								</div>
								<div class="realname-upload-btn webuploader-container" id="uploadfile_2">
									<div class="webuploader-pick" style="">
										上传图片
									</div>
									<div id="rt_rt_1efocqa6014vodo1fv1fe21bhm8" style="position: absolute; top: -382px; left: -16px; width: 195px; height: 98px; overflow: hidden; bottom: auto; right: auto;">
										<input type="file" name="file" class="webuploader-element-invisible" multiple="multiple" accept="image/*"><label style="opacity: 0; width: 100%; height: 100%; display: block; cursor: pointer; background: rgb(255, 255, 255);"></label>
									</div>
								</div>
								<div class="realname-upload-status hide" id="status_2">
									<div class="progress">
										<div class="progress-bar progress-bar-success">
										</div>
									</div>
								</div>
								<input type="hidden" name="license" id="idjus" value="{da.hand_img}">
							</div>
							</li>
							<li>
							<h5>&nbsp;</h5>
							<ul class="list list-circle realname-upload-desc">
								<li>照片完全清晰可辨</li>
								<li>信息完整无缺失</li>
								<li>身份照片真实无误</li>
								<li>持证人五官清晰可见</li>
								<li>严禁经过ps处理</li>
							</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="cells-tips text-center">
				<p class="text-light">
					您提供的照片信息仅作为卡卡礼品网实名认证使用，<br>
					我们不会泄露用户任何隐私！
				</p>
			</div>
		</div>
		<div class="myaction-wrapper realname-identity">
			<div class="myaction">
				<div class="btn-group">
				 <?php echo token_field(); ?>
					<button class="btn btn-primary" type="button" data-form="top-left,json" name="uploadImage">确认，提交上传</button>
				</div>
			</div>
		</div>
		<script src="/static/home/js/webuploader.min.js"></script>
		<script src="/static/home/js/jquery.img.js"></script>
		<div class="matte modal" id="idcardFront">
			<button class="close modal-close" type="button" data-dismiss="matte"></button>
			<div class="modal-body">
				<p class="text-center h6 pb5">
					身份证正面照需要能看清姓名、身份证号码等信息
				</p>
				<img class="img-response img-radius" src="/static/home/images/idcard0.jpg" alt="">
			</div>
		</div>
		<div class="matte modal" id="idcardBack">
			<button class="close modal-close" type="button" data-dismiss="matte"></button>
			<div class="modal-body">
				<p class="text-center h6 pb5">
					身份证反面照需要看清签发机关、有效期限等信息
				</p>
				<img class="img-response img-radius" src="/static/home/images/idcard1.jpg" alt="">
			</div>
		</div>
		<div class="matte modal" id="idcardHand">
			<button class="close modal-close" type="button" data-dismiss="matte"></button>
			<div class="modal-body">
				<p class="text-center h6 pb5">
					请确保要求人物和身份证正面信息完全清晰
				</p>
				<img class="img-response img-radius" src="/static/home/images/idcard2.jpg" alt="">
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
<script>
            var url = "<?php echo url('home/Account/uploadImage'); ?>";
        </script>
</body>
</html>