<?php /*a:1:{s:59:"/www/wwwroot/ka1.y9fu.com/app/home/view/card/wap/index.html";i:1606131786;}*/ ?>
<h<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no, initial-scale=1,viewport-fit=cover">
<meta name="format-detection" content="telephone=no">
<meta name="format-detection" content="email=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="no" http-equiv="Cache-Control">
<title><?php echo htmlentities($ress['title']); ?>-<?php echo htmlentities($C['sitename']); ?></title>
<meta name="keywords" content="<?php echo htmlentities($ress['keywords']); ?>">
<meta name="description" content="<?php echo htmlentities($ress['description']); ?>">
<link rel="stylesheet" href="/static/home/css/wap/owlui.animate.css?20191011">
<link rel="stylesheet" href="/static/home/css/wap/owlui.icon.css?20191011">
<link rel="stylesheet" href="/static/home/css/wap/owlui.css?2020526">
<link rel="stylesheet" href="/static/home/css/wap/base.css?202062">
<script src="/static/home/js/wap/j_lipin.js?20190521"></script>
<script src="/static/home/js/wap/library.js?20190521"></script>
<script src="/static/home/js/jquery.cookie.js?20181116"></script>
<script src="/static/home/js/wap/touchslide.js"></script>
<script src="/static/home/js/wap/base.js?v=2028"></script>
<style>
.allcards-group .title{
  float: right;
    margin-right: 20px
}
.allcards-group > li > a {
    position: unset;
    display: unset;
    height: .5rem;
    line-height: .5rem;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    padding: 0 .25rem;
}
.feilv{
    border: 0;
    border-bottom: 1px solid #c6c6c6;
    width: 100%;
    padding-left: 8px;
    background: center;
    font-size: 22px;
    color: #fe5339;
}
.feilv:focus{
    border-bottom: 1px solid #007fde;
}
</style>
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
	<header class="header"><button class="btn btn-back fl" type="button" onclick="javascript:history.back(-1);"><i class="iconfont iconfont-back"></i></button>
	<div class="header-title">
		<h1 class="title"><a href="/"><?php echo htmlentities($ress['title']); ?></a></h1>
	</div>
	<button class="btn btn-service fr" type="button" data-toggle="matte" data-target="#service"><i class="iconfont iconfont-service"></i></button></header>
</div>
<div class="mycontent mycontent-myaction" id="mycontent">
	<div class="recycle-primary">
		<div class="recycle-loader" id="recycleLoader" style="display: none;">
			<div class="recycle-loading">
				<span class="loader"></span>
				<h3>回收表单加载中，请稍候...</h3>
				<p>
					如长时间未加载成功，请刷新重试~
				</p>
				<p>
					<a class="btn btn-primary btn-sm btn-inline btn-circle" href="javascript:location.reload();">点我刷新</a>
				</p>
			</div>
			<div class="recycle-placeholder">
				<div class="card cells-placeholder">
					<div class="cell">
						<div class="cell-hd">
							<span class="text"></span>
						</div>
						<div class="cell-bd">
							<span class="text"></span>
						</div>
						<div class="cell-ft">
							<i class="icon"></i>
						</div>
					</div>
					<div class="cell">
						<div class="cell-hd">
							<span class="text"></span>
						</div>
						<div class="cell-bd">
							<span class="text"></span>
						</div>
						<div class="cell-ft">
							<i class="icon"></i>
						</div>
					</div>
					<div class="cell">
						<div class="cell-hd">
							<span class="text"></span>
						</div>
						<div class="cell-bd">
							<span class="text"></span>
						</div>
						<div class="cell-ft">
							<i class="icon"></i>
						</div>
					</div>
				</div>
				<div class="card cells-placeholder">
					<div class="cell navbar">
						<div class="cell-bd">
							<span class="text"></span>
						</div>
						<div class="cell-bd">
							<span class="text"></span>
						</div>
					</div>
					<div class="cell">
						<div class="cell-bd">
							<div class="form-textarea-placeholder">
							</div>
						</div>
					</div>
					<div class="cell cell-condensed">
						<div class="cell-hd">
							<span class="text"></span>
						</div>
						<div class="cell-bd">
							<span class="text"></span>
						</div>
					</div>
				</div>
				<div class="card cells-placeholder">
					<div class="cell cell-condensed">
						<div class="cell-hd">
							<span class="text"></span>
						</div>
						<div class="cell-bd">
							<span class="text"></span>
						</div>
					</div>
					<div class="cell cell-condensed">
						<div class="cell-hd">
							<span class="text"></span>
						</div>
						<div class="cell-bd">
							<span class="text"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="recycle-former hide" id="recycleFormer" style="display: block;">
			<form class="card-gradient" name="sell" method="post" id="sell">
				<div class="card recycle-former-cards">
					<div class="cell cell-menuer" data-toggle="matte" data-target="#card-types">
						<div class="cell-hd">
							<label class="control-label">卡类</label>
						</div>
						<div class="cell-bd">
							<div class="types">
							<?php if(is_array($cardModel) || $cardModel instanceof \think\Collection || $cardModel instanceof \think\Paginator): $i = 0; $__LIST__ = $cardModel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;if($p['istype'] == '0'): ?>
								<p class="<?php if($p['id'] == $cid): ?>active<?php endif; ?>">
									<?php echo htmlentities($p['title']); ?>
								</p>
								<?php endif; ?>
							<?php endforeach; endif; else: echo "" ;endif; ?>
							</div>
						</div>
						<div class="cell-ft">
							<div class="types">
								<p class="">
									<span class="svgcard svgcard-ecard"><i class="iconfont iconfont-type-ecard"></i></span>
								</p>
								<p class="active">
									<span class="svgcard svgcard-cost"><i class="iconfont iconfont-type-mobile"></i></span>
								</p>
								<p class="">
									<span class="svgcard svgcard-oils"><i class="iconfont iconfont-type-oil"></i></span>
								</p>
								<p class="">
									<span class="svgcard svgcard-game"><i class="iconfont iconfont-type-game"></i></span>
								</p>
								<p class="">
									<span class="svgcard svgcard-foods"><i class="iconfont iconfont-type-foods"></i></span>
								</p>
								<p class="">
									<span class="svgcard svgcard-video"><i class="iconfont iconfont-type-video"></i></span>
								</p>
							</div>
						</div>
					</div>
					<div class="cell cell-menuer" data-toggle="matte" data-target="#card-species">
						<div class="cell-hd">
							<label class="control-label">卡种</label>
						</div>
						<div class="cell-bd cell-hd-selected" id="species-selected">
							
						</div>
						<div class="cell-ft">
						</div>
					</div>
					<div class="cell cell-menuer" data-toggle="matte" data-target="#card-facevalue">
						<div class="cell-hd">
							<label class="control-label" id="recycle-danzhang">面值</label>
						</div>
						<div class="cell-bd cell-hd-selected" id="facevalue-selected">
							<p class="text-light">
								请选择单张卡的面值
							</p>
						</div>
						<div class="cell-ft">
						</div>
					</div>
					<div class="cell cell-menuer" id="fast-deal" style="display:none">
						<div class="cell-hd">
							<label class="control-label" id="recycle-danzhang">费率</label>
						</div>
						<div class="cell-bd cell-hd-selected" id="facevalue-selected">
							 <input type="text" name="feilv" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,4})?).*$/g, '$1')" class="feilv">
						</div>
					</div>
				</div>
				
				<div class="recycle-opening" id="recycle-opening">
					<div class="card recycle-former-codes">
						<div class="tabs navbar recycle-tabs isCard" id="chooseMode">
							<a class="tab-item active" id="choose-batch" href="#batchMode"><span>批量提交</span></a><a class="tab-item" id="choose-single" href="#singleMode"><span>单卡提交</span></a><a class="tab-item" id="choose-upload" href="#uploadMode" style="display: none;"><span>图片提交</span></a>
						</div>
						<div class="recycle-mode-wrapper">
							<div class="recycle-mode" id="batchMode" style="display: block;">
								<div class="cell">
									<div class="cell-bd" style="overflow-x: hidden;">
										<textarea class="form-textarea striped" name="cardlist" id="cardlist" rows="20" cols="20" onkeydown="cardnum(this,event)" onblur="cardnum(this,'blur')" wrap="off" placeholder="每张卡密为一行，卡号与密码之间用“空格”隔开"></textarea>
										<ul class="textarea-tips-list" id="card-tips">
										</ul>
									</div>
								</div>
								<div class="cell cell-condensed">
									<div class="cell-hd">
										<a class="btn btn-xs btn-secondary btn-noshadow btn-inline cardlist-neaten text-nowrap" id="cardlist-neaten" href="javascript:;">整理卡密</a>
									</div>
									<div class="cell-bd">
										<p class="h6 text-right text-light text-nowrap">
											已输 <strong id="cardnum" class="text-red">0</strong> 张，最多1000张<span class="sep">·</span><a class="text-blue" href="javascript::" data-toggle="matte" data-target="#cardexample">卡密示例</a>
										</p>
									</div>
								</div>
							</div>
							<div class="recycle-mode hide" id="singleMode" style="display: none;">
								<div class="cell nocode">
									<div class="cell-hd">
										<label class="control-label" for="cardid" id="recycle-cardno">卡号</label>
									</div>
									<div class="cell-bd">
										<input class="form-control" name="cardno[]" type="text" placeholder="请输入卡号" data-input="clear">
									</div>
								</div>
								<div class="cell">
									<div class="cell-hd">
										<label class="control-label" for="cardpsw" id="recycle-cardpsw">卡密</label>
									</div>
									<div class="cell-bd">
										<input class="form-control" name="cardpsw[]" type="text" placeholder="请输入卡密" reg="^[A-Za-z0-9_-]{4,30}$" data-input="clear">
									</div>
								</div>
								<div class="cell verifycode-input">
									<div class="cell-hd">
										<label class="control-label long verifycode-label" for="cardcode">卡验证码</label>
									</div>
									<div class="cell-bd">
										<input class="form-control" name="cardcode[]" type="text" placeholder="请输入卡验证码" data-input="clear">
									</div>
								</div>
							</div>
							<div class="recycle-mode hide" id="uploadMode" style="display: none;">
								<div class="card-heading">
									<h5>上传<span class="upload-text">实体卡</span>图片提交</h5>
								</div>
								<div class="uploadimg-group clearfix" id="uploadimg-group">
									<ul id="uploadimg-preview">
									</ul>
									<div class="uploadimg-btn">
										<label class="btn-uploadfile" for="uploadimg" id="uploadimg"><span class="plus"></span></label>
									</div>
								</div>
								<div class="cell cell-condensed">
									<div class="cell-bd">
										<p class="h6 text-orange text-nowrap">
											可多选，最多可同时提交<strong class="text-red">10</strong>张<span class="upload-text">实体卡</span>图片
										</p>
									</div>
								</div>
							</div>
							<label class="cell cell-label" for="urgent" id="fast-deal" style="display: none;">
							<div class="cell-hd">
								<input class="icheck" type="checkbox" id="urgent"><i class="owlicon owlicon-checked"></i>
							</div>
							<div class="cell-bd">
								加急处理<span class="text-gray">(9:00-18:00)</span>
							</div>
							<div class="cell-ft">
								<small class="text-red" id="urgent-money">手续费:3%</small>
							</div>
							</label>
						</div>
					</div>
					<div class="card">
						<div class="cell isQbi" style="display: none;">
							<div class="cell-bd">
								<p class="text-dark dinfont">
									一个账号一天只能寄售<strong class="text-red h4">2000</strong>Q币（比如QQ里有3000 Q币，<span class="text-red h4"><strong>我们只处理2000Q币</strong></span>，多余的我们不处理）
								</p>
							</div>
						</div>
						<div class="cell recycle-former-message" id="cardnoteC" style="display: flex;">
							<div class="cell-bd">
								<p class="text-red h6" id="cardnote">
									面值不符将全单损失！卡号与密码不匹配将全单损失！河南移动卡不收！提交一律失败！卡号15开头及以下不支持处理，【卡密规则】卡号为17位，密码18位。批量提交无效卡永久封号不予解封！
								</p>
							</div>
						</div>
					</div>
					<div class="card recycle-former-link isCard">
						<div class="tabs tabs-pills">
							<a class="tab-item" href="<?php echo url('home/Helpfaq/guide'); ?>"><span class="text-gray">交易步骤</span></a><a class="tab-item" href="<?php echo url('home/Helpfaq/faq'); ?>"><span class="text-gray">常见问题</span></a>
						</div>
					</div>
					<div class="recycle-sumbit" id="recycle-sumbit">
						<div class="myaction">
							<div class="btn-group">
								<button class="btn btn-primary" id="sumbit-card" type="button" onclick="checkCard();">提交</button><span id="get-card-sumbit" data-toggle="matte" data-target="#card-sumbit"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="recycle-closed hide" id="recycle-closed-1" style="display: none;">
					<div class="card">
						<div class="messager">
							<div class="messager-icon sm">
								<i class="iconfont iconfont-repair text-light"></i>
							</div>
							<div class="messager-text">
								<h2 class="messager-title">通道维护中</h2>
								<div class="messager-desc">
									<p>
										<strong class="text-red">此卡回收通道维护中，暂时无法提交<br>
										您可以选择其他卡券进行回收</strong>
									</p>
									<p>
										具体恢复时间，将以网站公告形式通知
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="recycle-closed hide" id="recycle-closed-2" style="display: none;">
					<div class="card">
						<div class="messager">
							<div class="messager-icon sm">
								<i class="iconfont iconfont-company-full text-blue"></i>
							</div>
							<div class="messager-text">
								<h2 class="messager-title">此卡只针对企业用户</h2>
								<p class="messager-desc">
									非常抱歉，此卡只针对企业用户<br>
									如果您是企业用户，您可以联系我们洽谈
								</p>
							</div>
							<div class="messager-action">
								<div class="btn-group">
									<a class="btn btn-secondary" href="tel:<?php echo htmlentities($C['kefu']); ?>" rel="external nofollow">在线电话咨询</a><a class="btn btn-primary" onclick="chatinit('905bce5dd3944726a64816bd7a9b34d9');" rel="external nofollow">在线咨询客服</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card card-appdown" id="appdownload" style="display: none;">
					<button class="close" type="button" onclick="closeclick();"></button><a class="cell" href="/appcode">
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
				<script type="text/javascript">function cookiesave(n, v, mins, dn, path){if(n){if(!mins) mins = 365 * 24 * 60;if(!path) path = "/";var date = new Date();date.setTime(date.getTime() + (mins * 60 * 1000));var expires = "; expires=" + date.toGMTString();if(dn) dn = "domain=" + dn + "; ";document.cookie = n + "=" + v + expires + "; " + dn + "path=" + path;}}function cookieget(n){var name = n + "=";var ca = document.cookie.split(';');for(var i=0;i<ca.length;i++) {var c = ca[i];while (c.charAt(0)==' ') c = c.substring(1,c.length);if (c.indexOf(name) == 0) return c.substring(name.length,c.length);}return "";}function closeclick(){document.getElementById('appdownload').style.display='none';cookiesave('closeclick','closeclick','','','');}function clickclose(){if(cookieget('closeclick')=='closeclick'){document.getElementById('appdownload').style.display='none';}else{document.getElementById('appdownload').style.display='block';}}window.onload=clickclose;</script>
				<div class="matte actionsheet" id="card-sumbit">
					<div class="actionsheet-header">
						<h5 class="actionsheet-title-text"><span class="text-light">请确认以下协议再提交</span></h5>
						<button class="close" type="button" data-dismiss="matte"></button>
					</div>
					<div class="actionsheet-body">
						<div class="cells recycle-former-check" id="recycle-former-check">
							<label class="cell cell-label" for="protocol">
							<div class="cell-hd">
								<input class="icheck" type="checkbox" id="protocol" checked="checked"><i class="owlicon owlicon-checked"></i>
							</div>
							<div class="cell-bd">
								<p>
									我已阅读、理解并接受「<a class="text-blue" target="_blank" href="<?php echo url('home/Helpfaq/protocol'); ?>"><?php echo htmlentities($C['sitename']); ?>礼品卡转让协议</a>」和「<a class="text-blue" target="_blank" href="<?php echo url('home/Helpfaq/adeclare'); ?>">礼品卡回收说明</a>」
								</p>
							</div>
							</label><label class="cell cell-label" for="legal">
							<div class="cell-hd">
								<input class="icheck" type="checkbox" id="legal"><i class="owlicon owlicon-checked"></i>
							</div>
							<div class="cell-bd">
								<p>
									我已确认该<span class="notQbi notQbijs">卡号卡密</span><span class="isQbi isQbijs hide" style="display: none;">账号内Q币</span><strong class="text-primary">来源合法</strong>，如有问题，本人愿意承担一切法律责任。
								</p>
							</div>
							</label><label class="cell cell-label isUse" for="faceerr" id="isFaceerr" style="display: nones;">
							<div class="cell-hd">
								<input class="icheck" type="checkbox" id="faceerr"><i class="owlicon owlicon-checked"></i>
							</div>
							<div class="cell-bd">
								<p>
									我已确认该卡<strong class="text-primary">面值</strong>准确无误，<strong class="text-primary">如有面值错误余额恕不退还！损失自行承担！</strong>
								</p>
							</div>
							</label>
						</div>
						<div class="btn-group">
							<input type="hidden" name="urgent" id="urgentval" value="0" />
						   <input type="hidden" name="type" id="type" value="0" />
						   <input type="hidden" name="cardtype" id="cardtype" value="0" />
						   <input type="hidden" name="cardprice" id="cardprice" value="" />
						   <input type="hidden" name="mcode" id="mcode" value="" />
							<button class="btn btn-secondary btn-sumbit btn-disabled" type="button" id="sellbutton" name="sell" onclick="tijiao();" disabled="">请确认面值无误</button>
						</div>
					</div>
				</div>
				<div class="matte actionsheet" id="card-types">
					<div class="actionsheet-header">
						<h5 class="actionsheet-title-text">请选择卡类</h5>
						<button class="close" type="button" data-dismiss="matte"></button>
					</div>
					<div class="actionsheet-body">
						<ul class="cardnav-group clearfix">
						<?php if(is_array($cardModel) || $cardModel instanceof \think\Collection || $cardModel instanceof \think\Paginator): $i = 0; $__LIST__ = $cardModel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;if($p['istype'] == '0'): ?>
							<li><a href="<?php echo url('home/card/index',['cid'=>$p['id']]); ?>"><img src="<?php echo htmlentities($p['image']); ?>"><span><?php echo htmlentities($p['title']); ?></span></a></li><?php endif; ?>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
				</div>
				<div class="matte actionsheet" id="card-species">
					<div class="actionsheet-header">
						<h5 class="actionsheet-title-text">请选择卡种</h5>
						<button class="close" type="button" data-dismiss="matte"></button>
					</div>
					<div class="actionsheet-body">
						<ul class="recycle-btn-group recycle-btn-group-species clearfix" id="cardSpecies">
							
						</ul>
					</div>
				</div>
				<div class="matte actionsheet" id="card-facevalue">
					<div class="actionsheet-header">
						<h5 class="actionsheet-title-text">请选择单张面值</h5>
						<button class="close" type="button" data-dismiss="matte"></button>
					</div>
					<div class="recycle-former-tips">
						您所选的为单张卡的面值，请勿搞错！！！
					</div>
					<div class="actionsheet-body">
						<ul class="recycle-btn-group recycle-btn-group-value clearfix" id="cardFacevalue">
						</ul>
					</div>
				</div>
				<div class="matte modal" id="cardexample">
					<button class="close modal-close" type="button" data-dismiss="matte"></button>
					<div class="modal-body">
						<div class="messager recycle-example">
							<div class="messager-icon">
								<i class="iconfont iconfont-bulb text-orange"></i>
							</div>
							<div class="messager-text">
								<p class="text-red nocode">
									卡号与卡密之间请用<strong class="text-orange">“空格”</strong>隔开，<br>
									每张卡占用一行用<strong class="text-orange">“换行”</strong>隔开，例：
								</p>
								<p class="text-red hide onlypass" style="display: none;">
									此卡种无需卡号，只需填写卡密，<br>
									每张一行用<strong class="text-orange">“换行”</strong>隔开！
								</p>
								<p class="h6 text-gray" id="cardlizi">
									
								</p>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="recycle-usable hide" id="recycleUsable">
			<div class="card">
				<div class="messager">
					<div class="messager-icon sm">
						<i class="owlicon owlicon-warn"></i>
					</div>
					<div class="messager-text">
						<h2 class="messager-title text-warning">本卡类暂不支持您提交</h2>
						<p class="messager-desc">
							非常抱歉，本卡类暂不支持您提交<br>
							如需<strong class="text-red">开通</strong>或有疑问请咨询在线客服
						</p>
					</div>
					<div class="messager-action">
						<div class="btn-group">
							<a class="btn btn-secondary" href="tel:<?php echo htmlentities($C['kefu']); ?>" rel="external nofollow">在线电话咨询</a><a class="btn btn-primary" onclick="chatinit('905bce5dd3944726a64816bd7a9b34d9');" rel="external nofollow">在线咨询客服</a>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		<div class="card features">
				<div class="panel-heading text-center">
					专业礼品卡回收
				</div>
				<div class="panel-body">
					<ul class="cardnav-group clearfix">
					   <?php if(is_array($cardModel) || $cardModel instanceof \think\Collection || $cardModel instanceof \think\Paginator): $i = 0; $__LIST__ = $cardModel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;if($p['istype'] == '0'): ?>
							<li><a href="<?php echo url('home/card/index',['cid'=>$p['id']]); ?>"><img src="<?php echo htmlentities($p['image']); ?>"><span>电商购物</span></a></li><?php endif; ?>
							<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
			</div>
	</div>
	<div id="carddiy" class="modal hide">
		<div class="form-primary">
			<div class="form-tips text-red" id="carddiyTips">
			</div>
			<div class="form-group">
				<input class="form-control" name="diyprice" type="number" placeholder="请输入10-10000元的面值" maxlength="20">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="button" name="login-form" onclick="idiyselect();">确 定</button>
			</div>
		</div>
	</div>
	
	
	<script>var cardtype = <?php echo htmlentities($cid); ?>; var cardid= <?php echo htmlentities($tid); ?>;</script>
	<script src="/static/home/js/webuploader.min.js"></script>
	<script src="/static/home/js/wap/recycle.primary.js?v=184"></script>
	<script src="/static/home/js/wap/recycle.common.js?v=185"></script>
</div>
<div class="tooltip" id="tooltip" style="display: none;">
	<div class="tooltip-arrow">
	</div>
	<a class="tooltip-close close" href="javascript:;">×</a>
	<div class="tooltip-inner">
	</div>
</div>
<div class="backdrop" id="backdrop">
</div>
  <?php echo htmlspecialchars_decode($C['tongji']); ?>
</body>
</html>