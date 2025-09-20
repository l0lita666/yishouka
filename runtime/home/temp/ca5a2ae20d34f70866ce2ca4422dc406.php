<?php /*a:3:{s:57:"/www/wwwroot/www.ssyd.fun/app/home/view/login/signup.html";i:1751611621;s:57:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/index.html";i:1605435704;s:54:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/to.html";i:1605574982;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
 <head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  
  <title><?php echo htmlentities((string) $C['sitename']); ?>-注册账号 </title>

  <meta name="robots" content="all" />
  <link href="/static/home/css/animate.css?20191011" rel="stylesheet" />
  <link href="/static/home/css/common.css?2020327" rel="stylesheet" />
  <link href="/static/home/css/base.css?2020327" rel="stylesheet" />
  <script type="text/javascript" src="/static/home/js/j_lipin.js?20190520"></script>
  <script type="text/javascript" src="/static/home/js/library.js?20190"></script>
  <script type="text/javascript" src="/static/home/js/common.js?20205823"></script>
  <meta name="baidu-site-verification" content="code-W7e3uhR6xr" />
  <meta name="shenma-site-verification" content="6a93b5494925f504b599b5e92510e0d7_1603538572">
  <!-- aixiaoka.net Baidu tongji analytics -->
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?651a89293c33d2acb27f1f5e0da8e617";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
 </head>
 <body>
  <div id="modal-dialog" class="modal hide"></div>
  <div class="modal-cover hide" id="modal-dialog-cover"></div>
  <div class="header" id="header">
   <div class="navbar " id="navbar" data-navbar="">
    <div class="container-fluid">
     <div class="navbar-brand" id="logo">
      <a href="/"><span class="logo"><img src="<?php echo htmlentities((string) $C['logo']); ?>" style="display:block;margin: auto;" alt="<?php echo htmlentities((string) $C['sitename']); ?>" /></span></a>
     </div>
     <div class="navbar-primary" id="navbar-primary">
     <ul class="navbar-nav clearfix">
   <li id="navbar-home"><a href="/"><i class="iconfont"></i><span>首页</span></a></li> 
   <li class="" id="navbar-sell" data-hover="dropdown"><a href="<?php echo url('home/card/index'); ?>"><i class="iconfont"></i><span>我要销卡</span></a><a class="sr-only" href="<?php echo url('home/card/index'); ?>"><i class="iconfont"></i><span>我要销卡/span></a>
    <div class="dropdown-menu animated zoomIn">
     <ul class="navbar-cardnav clearfix">
	 <?php if(is_array($cardModel) || $cardModel instanceof \think\Collection || $cardModel instanceof \think\Paginator): $i = 0; $__LIST__ = $cardModel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;if($p['status'] == '1'): ?>
      <li><a href="<?php echo url('home/card/index',['cid'=>$p['id']]); ?>">
        <div class="card">
         <img class="cover" src="<?php echo htmlentities((string) $p['image']); ?>" />
         <img class="mid" src="<?php echo htmlentities((string) $p['image']); ?>" />
         <img class="down" src="<?php echo htmlentities((string) $p['image']); ?>" />
        </div><span><?php echo htmlentities((string) $p['title']); ?>回收</span></a></li>
		<?php endif; ?>
	<?php endforeach; endif; else: echo "" ;endif; ?>
     </ul>
     <div class="navbar-hotcard">
      <strong>热门回收：</strong>
	<?php if(is_array($cardModel) || $cardModel instanceof \think\Collection || $cardModel instanceof \think\Paginator): $i = 0; $__LIST__ = $cardModel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$k): $mod = ($i % 2 );++$i;if($k['istype'] == '1'): if(is_array($k['comments']) || $k['comments'] instanceof \think\Collection || $k['comments'] instanceof \think\Paginator): $ii = 0; $__LIST__ = $k['comments'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$h): $mod = ($ii % 2 );++$ii;if($ii < '5'): ?>
			  <a href="<?php echo url('home/card/index',['id'=>$h['id']]); ?>"><?php echo htmlentities((string) $h['title']); ?></a>
			  <?php endif; ?>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		<?php endif; ?>
	<?php endforeach; endif; else: echo "" ;endif; ?>
     
     </div>
    </div></li>
   <li class="" id="navbar-buy"><a href="https://www.aixiaoka.net/help_danye/22.html" target="_blank"><i class="iconfont"></i><span>关于我们</span></a></li>
   <li class="" id="navbar-xianxia"><a href="http://bbs.aixiaoka.net" target=“_blank”><i class="iconfont"></i><span>论坛<span></a></li> 
 <li class="" id="navbar-xianxia"><a href="https://www.aixiaoka.net/business.html"><i class="iconfont"></i><span>线下卡回收</span></a></li> 
   <?php if(!(empty($wx['appimg']) || (($wx['appimg'] instanceof \think\Collection || $wx['appimg'] instanceof \think\Paginator ) && $wx['appimg']->isEmpty()))): ?>
   <li class="" id="navbar-app" data-hover="dropdown"><a href="<?php echo url('home/index/app'); ?>"><i class="iconfont"></i><span>关注公众号</span></a>
    <div class="dropdown-menu animated zoomIn">
     <div class="navbar-download"> 
      <h5>手机回收方便快捷</h5> 
      <img src="<?php echo htmlentities((string) $wx['appimg']); ?>" alt="" /> 
      <p>扫码关注</p>
     </div>
    </div></li>
	<?php endif; ?>
  </ul>
     </div>
     <div class="navbar-customer" id="navbar-customer">
      <ul class="navbar-login clearfix">
       <li class="navbar-user userstate1"><a class="btn btn-primary" href="<?php echo url('home/login/login'); ?>">登录</a><a class="btn btn-default" href="<?php echo url('home/Login/register'); ?>">注册</a></li>
       <li class="navbar-user userstate2 hide" data-hover="dropdown"><a class="btn btn-primary navbar-avatar" href="<?php echo url('home/Member/index'); ?>"><span class="avatar"><i class="iconfont"></i></span><span class="username">username</span></a>
        <div class="dropdown-menu animated zoomIn">
         <div class="navbar-account">
          <div class="navbar-account-name hide">
           <h3 class="ellipsis"><a href="<?php echo url('home/Member/index'); ?>">我的账户</a></h3>
           <p class="levels "><a href="###"><span class="level level0">K0</span></a></p>
           <p class=""><a href="###">我的特权（普通用户）</a></p>
          </div>
          <div class="navbar-account-nav">
           <ul class="clearfix">
            <li><a class="btn btn-default" href="<?php echo url('home/Sellcard/index'); ?>"><i class="iconfont"></i>我要卖卡</a></li>
            <li><a class="btn btn-default" href="<?php echo url('home/Sellcard/order'); ?>"><i class="iconfont"></i>卖卡记录</a></li>
            <li><a class="btn btn-default" href="<?php echo url('home/Cash/index'); ?>"><i class="iconfont"></i>我要提现</a></li>
            <li><a class="btn btn-default" href="<?php echo url('home/Cash/cashrecords'); ?>"><i class="iconfont"></i>账户记录</a></li>
           </ul>
          </div>
          <div class="navbar-account-set clearfix">
           <a class="pull-left" href="<?php echo url('home/Member/profile'); ?>">资料管理</a>
           <a class="pull-right" href="<?php echo url('home/Login/logout'); ?>">安全退出</a>
          </div>
         </div>
        </div></li>
       <li class="navbar-help" data-hover="dropdown"><a class="navbar-icon" href="<?php echo url('home/helpfaq/index'); ?>"><i class="iconfont iconfont-help"></i></a>
        <div class="dropdown-menu animated zoomIn">
         <p class="link"><a href="<?php echo url('home/helpfaq/index'); ?>">帮助中心</a><em class="sep">|</em><a href="<?php echo url('home/helpfaq/danye',['id'=>17]); ?>">卖卡流程</a></p>
         <p class="tel">或直接拨打客服热线<br /><span class="text-red h2">4000518288</span><br /><small class="text-light">（08:00-23：00:00）</small></p>
         <p class="link"><a class="btn btn-primary btn-block zhiCustomBtn" href="tencent://message/?uin=<?php echo htmlentities((string) $C['qq']); ?>&Site=QQ交谈&Menu=yes" onclick="chatinit('905bce5dd3944726a64816bd7a9b34d9');" rel="external nofollow">在线客服咨询</a></p>
        </div></li>
       <li class="navbar-hezuo"><a class="navbar-icon" href="<?php echo url('home/helpfaq/business'); ?>" title="招商合作"><i class="iconfont iconfont-hezuo"></i></a></li>
      </ul>
     </div>
    </div>
   </div>
  </div>
 
<div class="content">
	<div class="panel panel-register">
		<div class="container box">
			<div class="register">
				<div class="register-primary">
					<form action="<?php echo request()->url(); ?>" method="post" id="signup">
						<div class="form-group mb0">
							<label class="control-label">&nbsp;</label>
							<div class="help-block">
								<h2 class="text-dark">欢迎注册<span>已有账号？<a class="text-blue" href="<?php echo url('home/Login/login'); ?>">请登录</a></span></h2>
							</div>
						</div>
						<div class="form-group mb0">
							<label class="control-label">&nbsp;</label>
							<div class="help-block form-error" id="sign-error">
							</div>
						</div>
						<div class="sr-only">
							<input type="text" name="fakeusernameremembered"><input type="password" name="fakepasswordremembered">
							<p>
								防止浏览器自动乱填充表单
							</p>
						</div>
						<div class="form-group">
							<label class="control-label" for="username">用户名：</label><input type="text" class="form-control" id="username" name="username" reg="^[A-Za-z0-9]{6,20}$" maxlength="20" placeholder="您的帐户名和登录名" null="用户名不能为空" err="用户名格式错误">
							<div class="help-block">
								<span class="onshow"><i class="iconfont"></i>支持字母、数字的组合，6-20个字符，不支持中文</span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label" for="newpsw">设置密码：</label><input type="password" class="form-control" id="newpsw" name="newpsw" reg="^[A-Za-z0-9_-~!@#$%^&amp;*()\[\]_+-={}?,.\/]{6,20}$" maxlength="20" placeholder="必须至少使用两种字符组合" null="请输入密码">
							<div class="help-block">
								<span class="onshow"><i class="iconfont"></i>建议使用字母、数字和符号两种及以上的组合，6-20个字符</span>
								<div class="security-level" id="setpass_security">
									<span class="text-blue" data-tip="<div class='password-suggestion'><h5>密码设置建议</h5><p class='text-red'>据统计研究，80%的被盗账号都是由于密码太简单而被猜到引起的。</p><p><strong>因此，我们建议：</strong></p><p>1. 密码设置至少6位以上，由数字、字母和符号混合而成，安全性最高；</p><p>2. 不允许空格，不允许特殊字符，如；<>;'\。 <br/>    允许的符号为： ~!@#$%^&*()_+-={}[]?/,.；</p><p>3. 不要使用7位以下的纯数字，这样容易被人猜到；</p><p>4. 不要和用户名太相似，这样容易被人猜到；</p><p>5. 不要用太多连续或重复的字符（如：1234、abcd、3333、 ssss等）；</p><p>6. 不要用手机号、电话号码、生日、学号、身份证号等个人信息。</p><p style='font-weight:bold'>友情提醒：用户名和密码要做好相应记录，以免忘记</p></div>"><i class="iconfont"></i>安全程度：</span><span class="levs"><span class="lev lev1">弱</span><span class="lev lev2">中</span><span class="lev lev3">强</span></span><span class="text"><span class="txt1">弱</span><span class="txt2">中</span><span class="txt3">强</span></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label" for="verifypsw">确认密码：</label><input type="password" class="form-control" id="verifypsw" name="verifypsw" placeholder="请再次输入密码" null="请输入确认密码">
						<div class="help-block">
							<span class="onshow"><i class="iconfont"></i>请再次输入登录密码</span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label" for="qq">联系QQ：</label><input type="number" class="form-control" id="qq" name="qq" placeholder="请输入QQ号码" null="请输入qq">
						<div class="help-block">
							<span class="onshow"><i class="iconfont"></i>填写QQ方便管理员与你的联系</span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label" for="phoneno">手机号码：</label><input type="text" class="form-control" id="phoneno" name="phoneno" placeholder="请输入手机号码" reg="^1[23456789]{1}\d{9}$" null="请输入手机号码">
						<div class="help-block">
							<span class="onshow"><i class="iconfont"></i>完成验证后，你可以用该手机登录和找回密码</span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label" for="verifycode">右侧验证码：</label>
						<div class="form-element">
							<input type="text" id="regcode" class="form-control" name="regcode" placeholder="请输入验证码" value="" null="请输入验证码"><img src="<?php echo captcha_src(); ?>" class="verifyimg code pull-left" onclick="this.src=this.src+'?'+Math.random()" title="点击图片刷新验证码">	
						</div>
					</div>
					<div class="form-group">
						<label class="control-label" for="codeno">短信验证码：</label><input class="form-control form-control-short" id="codeno" name="codeno" type="text" placeholder="手机验证码" null="请输入手机验证码" reg="[0-9]{6}"><a class="btn btn-green" href="javascript:;" data-href="<?php echo url('home/Api/sendMsg',['scene'=>'regcode','tip'=>'mcode']); ?>,,top-left,post" id="mcode">获取验证码</a>
						<div class="help-block">
							<span class="onshow"><i class="iconfont"></i>请输入收到的手机短信验证码</span>
						</div>
					</div>
					<div class="form-group hidden">
						<label class="control-label">&nbsp;</label><label class="checkbox referee-checkbox pull-left"><input type="checkbox" id="user-referee"><span class="checkbox-text">使用推广号</span></label><input type="hidden" name="refer" value="">
					</div>
					<div class="form-group mb0">
						<label class="control-label">&nbsp;</label><label class="checkbox pull-left" for="agreement" data-tip="<span class='fsz16 text-purple'>阅读和同意用户服务协议和隐私政策后才能注册！</span>"><input type="checkbox" id="agreement" ><span class="checkbox-text" >已阅读并同意「<a class="text-blue" target="_blank" href="<?php echo url('home/helpfaq/danye',['id'=>18]); ?>"><?php echo htmlentities((string) $C['sitename']); ?>用户服务协议</a>」和「<a class="text-blue" href="<?php echo url('home/helpfaq/danye',['id'=>19]); ?>">隐私政策</a>」</span></label>
					</div>
					<div class="form-group">
					    <?php echo token_field(); ?>
						<label class="control-label">&nbsp;</label><button class="btn btn-primary btn-block btn-md" type="submit" data-form="top-left,json" name="signup" id="signupbtn">同意协议并创建帐户</button>
					</div>
					<div class="form-group">
						<label class="control-label">&nbsp;</label>
						<div class="login-other">
							<fieldset class="orline">
								<legend class="orline-title" align="center">使用其他登录方式</legend>
							</fieldset>
							<a class="login-other-qzone <?php if($isqq == '0'): ?>hidden<?php endif; ?>" href="javascript:;" target="_top" rel="nofollow" onclick="toQzoneLogin();"><i class="iconfont iconfont-qq"></i>QQ帐号直接登录</a>
							<a class="login-other-wechat <?php if($iswx == '0'): ?>hidden<?php endif; ?>" href="javascript:;" target="_top" rel="nofollow" onclick="towxLogin();"><i class="iconfont iconfont-wechat"></i>微信帐号直接登录</a>
						</div>
					</div>
				</form>
				<script>
				$("#agreement").click(function(){var a=$(this).prop("checked");if(a){$("input[name=refer]").val(1);}else{$("input[name=refer]").val(0);}});
				$(function() {$('#newpsw').keyup(function () { var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g"); var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g"); var enoughRegex = new RegExp("(?=.{6,}).*", "g"); if (false == enoughRegex.test($(this).val())) { $('#setpass_security').hide(); $('#setpass_security').removeClass('security-level-weak'); $('#setpass_security').removeClass('security-level-medium'); $('#setpass_security').removeClass('security-level-strong'); /*密码小于六位的时候，密码强度图片都为灰色*/} else if (strongRegex.test($(this).val())) { $('#setpass_security').show(); $('#setpass_security').removeClass('security-level-weak'); $('#setpass_security').removeClass('security-level-medium'); $('#setpass_security').removeClass('security-level-strong'); $('#setpass_security').addClass('security-level-strong');  /*密码为八位及以上并且字母数字特殊字符三项都包括,强度最强 */} else if (mediumRegex.test($(this).val())) { $('#setpass_security').show(); $('#setpass_security').removeClass('security-level-weak'); $('#setpass_security').removeClass('security-level-medium'); $('#setpass_security').removeClass('security-level-strong'); $('#setpass_security').addClass('security-level-medium');  /*密码为七位及以上并且字母、数字、特殊字符三项中有两项，强度是中等 */} else { $('#setpass_security').show(); $('#setpass_security').removeClass('security-level-weak'); $('#setpass_security').removeClass('security-level-medium'); $('#setpass_security').removeClass('security-level-strong'); $('#setpass_security').addClass('security-level-weak');  /*如果密码为6为及以下，就算字母、数字、特殊字符三项都包括，强度也是弱的 */} return true; }); });</script>
			</div>
		</div>
	</div>
</div>
</div>

  <div class="footer" id="footer">
   <div class="footer-primary">
    <div class="container">
     <dl class="footer-help">
      <dt>
       回收指南
      </dt>
      <dd>
       <ul class="footer-links clearfix">
	   <li><a href="<?php echo url('home/helpfaq/index'); ?>" target="_blank">&middot; 平台公告</a></li>
	   <?php if(is_array($thisli) || $thisli instanceof \think\Collection || $thisli instanceof \think\Paginator): $i = 0; $__LIST__ = $thisli;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?>
        <li><a href="<?php echo url('home/Helpfaq/danye',['id'=>$p['id']]); ?>" target="_blank">&middot; <?php echo htmlentities((string) $p['title']); ?></a></li>
		<?php endforeach; endif; else: echo "" ;endif; ?>
       </ul>
      </dd>
     </dl>
     <dl class="footer-service">
      <dt>
       联系客服
      </dt>
      <dd>
       <p class="call"><strong class="text-red">4000-518-288</strong><small>（电话客服 在线时间8:00-23:00）</small></p>
       <div class="online">
           <a class="btn btn-primary"  href="tencent://message/?uin=<?php echo htmlentities((string) $C['qq']); ?>&Site=Sambow&Menu=yes" ><i class="iconfont iconfont-service "></i><span class="iconfont-text">QQ在线咨询</span></a>
       <!-- <a class="btn btn-primary" href="javascript:;" onclick="chatinit('905bce5dd3944726a64816bd7a9b34d9');" rel="external nofollow"> <i class="iconfont"></i>在线客服咨询</a>-->
       </div>
       <p class="time">客服时间： 周一至周日 08:00-23:00  邮箱： one@aixiaoka.net </p>
      </dd>
      <dd class="tips">
       <div class="alert alert-alt alert-danger">
        <s></s>
        <h4>爱销卡友情提示</h4>
        <p>注册即视为同意爱销卡服务协议，非法渠道获取的卡不受保护。如果您通过非官方客服号码进行咨询或处理二手卡回收造成损失，本平台概不负责。</p>
       </div>
      </dd>
     </dl>
     <dl class="footer-qrcode"> 
      <dd>
       <ul class="clearfix">
	   <?php if(!(empty($wx['appimg']) || (($wx['appimg'] instanceof \think\Collection || $wx['appimg'] instanceof \think\Paginator ) && $wx['appimg']->isEmpty()))): ?>
        <li><img src="<?php echo htmlentities((string) $wx['appimg']); ?>" /><h5>关注微信公众号</h5></li>
		<?php endif; if(!(empty($C['wxewm']) || (($C['wxewm'] instanceof \think\Collection || $C['wxewm'] instanceof \think\Paginator ) && $C['wxewm']->isEmpty()))): ?>
        <li><img src="<?php echo htmlentities((string) $C['wxewm']); ?>" /><h5>扫码添加微信客服</h5></li>
		<?php endif; ?>
       </ul>
      </dd>
     </dl>
    </div>
   </div>
   <div class="footer-about">
    <div class="container">
     <ul class="clearfix" style="text-align:center;margin-top:20px">
	  <li style="margin:0 8px;float:left;border: 1px solid #ccc;padding: 2px 8px;"><span>友情链接</span></li>
	 <?php $_result=get_link(5,'desc');if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?>
      <li style="margin:0 8px;float:left;padding: 2px 8px;"><a href="<?php echo htmlentities((string) $p['url']); ?>" target="<?php echo htmlentities((string) $p['target']); ?>" rel="nofollow"><span><?php echo htmlentities((string) $p['name']); ?></span></a></li>
	  <?php endforeach; endif; else: echo "" ;endif; ?>
     </ul>
  
    </div>
   </div>
   <div class="footer-about">
    <div class="container">
     <ul class="authentication clearfix">
	 <?php $_result=get_link(6,'desc');if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?>
      <li><a href="<?php echo htmlentities((string) $p['url']); ?>" target="<?php echo htmlentities((string) $p['target']); ?>" rel="nofollow"><i class="iconimg"><img style="display: block;
    height: 100%;" src="<?php echo htmlentities((string) $p['image']); ?>"></i><span><?php echo htmlspecialchars_decode($p['name']); ?></span></a></li>
     <?php endforeach; endif; else: echo "" ;endif; ?>
     </ul>
     <div class="copyright">
      <p><?php echo htmlentities((string) $C['copyright']); ?><span class="sep">|</span><a href="/" target="_blank"><?php echo htmlentities((string) $C['sitename']); ?></a></p>
      <p><a href="http%3A%2F%2Fwww.miitbeian.gov.cn%2F" target="_blank" rel="nofollow">ICP证：<?php echo htmlentities((string) $C['beian']); ?></a><?php echo htmlspecialchars_decode($C['buchong']); ?></p>
     </div>
    </div>
   </div>
  </div>
  <dl class="toolbar" id="toolbar">
   <dt data-hover="dropdown">
       <a href="tencent://message/?uin=<?php echo htmlentities((string) $C['qq']); ?>&Site=QQ交谈&Menu=yes" ><i class="iconfont iconfont-service "></i><span class="iconfont-text">QQ在线咨询</span></a>

    <!--<a href="javascript:;" id="zhiCustomBtn" onclick="chatinit('905bce5dd3944726a64816bd7a9b34d9');"><i class="iconfont iconfont-service "></i><span class="iconfont-text">在线咨询</span></a>-->
    <div class="dropdown-menu dropdown-menu-call animated fadeInRight">
     <h5>您也可以拨打客服电话：</h5>
     <p class="text-red h2">4000-518-288</p>
     <p class="text-light h6">（08:00-23:00）</p>
    </div>
   </dt>
   <dd data-hover="dropdown" class="hidden">
    <a href="javascript:;"><i class="iconfont iconfont-call"></i><span class="iconfont-text">客服<br />电话</span></a>
    <div class="dropdown-menu dropdown-menu-call animated fadeInRight">
     <h5>平台客服咨询电话：</h5>
     <p class="text-red h2">4000-518-288</p>
     <p class="text-light h6">（08:00-23:00）</p>
    </div>
   </dd>
   <?php if(!(empty($C['wxewm']) || (($C['wxewm'] instanceof \think\Collection || $C['wxewm'] instanceof \think\Paginator ) && $C['wxewm']->isEmpty()))): ?>
   <dd data-hover="dropdown">
    <a href="javascript:;"><i class="iconfont iconfont-weixin"></i><span class="iconfont-text">关注<br/>微信</span></a>
    <div class="dropdown-menu dropdown-menu-weixin animated fadeInRight">
     <img src="https://www.aixiaoka.net/uploads/20201029/bc443a9bc0b7fce83a04d1995b7bb65e.png" alt="爱销卡卡密回收" />
     <p class="text-light h6">扫码关注微信公众号</p>
    </div>
   </dd>
   <?php endif; ?>
   <dd>
    <a href="<?php echo url('home/Index/feedback'); ?>" target="_blank"><i class="iconfont iconfont-feedback"></i><span class="iconfont-text">建议<br />反馈</span></a>
   </dd>
   <dd id="totop">
    <a href="#top"><i class="iconfont iconfont-top"></i><span class="iconfont-text">回到<br />顶部</span></a>
   </dd>
  </dl>
  <script>
  <?php echo htmlspecialchars_decode($C['tongji']); ?>
  </script>
 </body>
</html>