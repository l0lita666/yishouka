<?php /*a:4:{s:57:"/www/wwwroot/ka1.y9fu.com/app/home/view/member/index.html";i:1604240724;s:58:"/www/wwwroot/ka1.y9fu.com/app/home/view/layout/member.html";i:1605574940;s:54:"/www/wwwroot/ka1.y9fu.com/app/home/view/layout/to.html";i:1605574982;s:61:"/www/wwwroot/ka1.y9fu.com/app/home/view/layout/user_menu.html";i:1605547434;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
 <head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  
  <title><?php echo htmlentities($C['sitename']); ?>-<?php echo htmlentities($C['title']); ?> </title>
  <meta name="keywords" content="<?php echo htmlentities($C['keywords']); ?>" />
  <meta name="description" content="<?php echo htmlentities($C['description']); ?>" />
  
  <meta name="robots" content="all" />
  <link href="/static/home/css/animate.css?20191011" rel="stylesheet" />
  <link href="/static/home/css/common.css?2020327" rel="stylesheet" />
  <link href="/static/home/css/base.css?2020327" rel="stylesheet" />
  <script type="text/javascript" src="/static/home/js/j_lipin.js?20190520"></script>
  <script type="text/javascript" src="/static/home/js/library.js?20190"></script>
  <script type="text/javascript" src="/static/home/js/common.js?20205823"></script>
  <!--[if lt IE 8]>
	<script src="/static/home/js/browserIE.js?201906142"></script>
	<![endif]--><!--[if lt IE 9]>
	<script src="/static/home/js/html5shiv.min.js"></script>
	<script src="/static/home/js/respond.min.js"></script>
	<![endif]-->
 </head>
 <body>
   <div class="hide" id="identitytips">
	<div class="modal-prompt">
		<div class="prompt prompt-warning">
			<div class="prompt-img">
				<img src="/static/home/images/sprites/identity-hand.png" alt="">
			</div>
			<div class="prompt-cont">
				<h4>请实名认证</h4>
				<p>
					为了有效保障您的<?php echo htmlentities($C['sitename']); ?>账户的资金安全，实名认证之后才可以提现哦！
				</p>
				<div class="action">
					<a class="btn btn-sm btn-primary" href="<?php echo url('home/Account/index'); ?>">立即去认证</a>
				</div>
			</div>
		</div>
	</div>
</div>
  <div id="modal-dialog" class="modal hide"></div>
  <div class="modal-cover hide" id="modal-dialog-cover"></div>
  <div class="header" id="header">
   <div class="navbar " id="navbar" data-navbar="">
    <div class="container-fluid">
     <div class="navbar-brand" id="logo">
      <a href="/"><span class="logo"><img src="<?php echo htmlentities($C['logo']); ?>" alt="<?php echo htmlentities($C['sitename']); ?>" style="display:block;margin: auto;" /></span></a>
     </div>
     <div class="navbar-primary" id="navbar-primary">
     <ul class="navbar-nav clearfix">
   <li id="navbar-home"><a href="/"><i class="iconfont"></i><span>平台首页</span></a></li> 
   <li class="" id="navbar-sell" data-hover="dropdown"><a href="<?php echo url('home/card/index'); ?>"><i class="iconfont"></i><span>我要销卡</span></a><a class="sr-only" href="<?php echo url('home/card/index'); ?>"><i class="iconfont"></i><span>我要销卡</span></a>
    <div class="dropdown-menu animated zoomIn">
     <ul class="navbar-cardnav clearfix">
	 <?php if(is_array($cardModel) || $cardModel instanceof \think\Collection || $cardModel instanceof \think\Paginator): $i = 0; $__LIST__ = $cardModel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;if($p['status'] == '1'): ?>
      <li><a href="<?php echo url('home/card/index',['cid'=>$p['id']]); ?>">
        <div class="card">
         <img class="cover" src="<?php echo htmlentities($p['image']); ?>" />
         <img class="mid" src="<?php echo htmlentities($p['image']); ?>" />
         <img class="down" src="<?php echo htmlentities($p['image']); ?>" />
        </div><span><?php echo htmlentities($p['title']); ?>回收</span></a></li>
		<?php endif; ?>
	<?php endforeach; endif; else: echo "" ;endif; ?>
     </ul>
     <div class="navbar-hotcard">
      <strong>热门回收：</strong>
	<?php if(is_array($cardModel) || $cardModel instanceof \think\Collection || $cardModel instanceof \think\Paginator): $i = 0; $__LIST__ = $cardModel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$k): $mod = ($i % 2 );++$i;if($k['istype'] == '1'): if(is_array($k['comments']) || $k['comments'] instanceof \think\Collection || $k['comments'] instanceof \think\Paginator): $ii = 0; $__LIST__ = $k['comments'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$h): $mod = ($ii % 2 );++$ii;if($ii < '5'): ?>
			  <a href="<?php echo url('home/card/index',['id'=>$h['id']]); ?>"><?php echo htmlentities($h['title']); ?></a>
			  <?php endif; ?>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		<?php endif; ?>
	<?php endforeach; endif; else: echo "" ;endif; ?>
     
     </div>
    </div></li>
   <li class="" id="navbar-buy"><a href="#" target="_blank"><i class="iconfont"></i><span>低价卡券</span></a></li>
   <?php if($C['yaostate'] == 'on'): ?>
   <li class="" id="navbar-xianxia"><a href="<?php echo url('home/Index/accets'); ?>"><i class="iconfont"></i><span>邀请活动</span></a></li><?php endif; ?>
   <!--<li class="" id="navbar-xianxia"><a href="<?php echo url('home/xiaxian/index'); ?>"><i class="iconfont"></i><span>线下卡回收</span></a></li>-->
   <?php if(!(empty($C['appimg']) || (($C['appimg'] instanceof \think\Collection || $C['appimg'] instanceof \think\Paginator ) && $C['appimg']->isEmpty()))): ?>
   <li class="" id="navbar-app" data-hover="dropdown"><a href="<?php echo url('home/index/app'); ?>"><i class="iconfont"></i><span>下载APP</span></a>
    <div class="dropdown-menu animated zoomIn">
     <div class="navbar-download"> 
      <h5>手机回收方便快捷</h5> 
      <img src="<?php echo htmlentities($C['appimg']); ?>" alt="" /> 
      <p>扫码下载卡卡APP</p>
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
         <p class="link"><a class="btn btn-primary btn-block zhiCustomBtn" href="tencent://message/?uin=<?php echo htmlentities($C['qq']); ?>&Site=QQ交谈&Menu=yes" onclick="chatinit('905bce5dd3944726a64816bd7a9b34d9');" rel="external nofollow">在线客服咨询</a></p>
        </div></li>
       <li class="navbar-hezuo"><a class="navbar-icon" href="<?php echo url('home/helpfaq/business'); ?>" title="招商合作"><i class="iconfont iconfont-hezuo"></i></a></li>
      </ul>
     </div>
    </div>
   </div>
  </div>

<div id="bank-dialog" class="modal hide">
</div>
<div class="view-framework">
	<div class="view-framework-sidebar"> 
    <div class="sidebar-body">
     <div class="sidebar-nav">
      <ul class="sidebar-items"> 
       <li <?php if($action=="index" && $contr=="Member"): ?>class="current"<?php endif; ?>><a href="<?php echo url('home/Member/index'); ?>"><i class="iconfont"></i>账户总览</a></li>
       <li <?php if(($action=="index" || $action=="bank" || $action=="weixin" ) && $contr=="Cash"): ?>class="current"<?php endif; ?>><a href="<?php echo url('home/Cash/index'); ?>"><i class="iconfont"></i>我要提现</a></li>
       <li <?php if($action=="cashrecords" && $contr=="Cash"): ?>class="current"<?php endif; ?>><a href="<?php echo url('home/Cash/cashrecords'); ?>"><i class="iconfont"></i>提现记录</a></li>
      </ul>
     </div>
     <div class="sidebar-nav">
      <ul class="sidebar-items">
       <li <?php if($action=="index" && $contr=="Sellcard"): ?>class="current"<?php endif; ?>><a href="<?php echo url('home/Sellcard/index'); ?>"><i class="iconfont icon-sell"></i>我要卖卡</a></li>
       <li <?php if(($action=="order" || $action=="selldetailinfo") && $contr=="Sellcard"): ?>class="current"<?php endif; ?>><a href="<?php echo url('home/Sellcard/order'); ?>"><i class="iconfont"></i>卖卡记录</a></li>
       <li <?php if($action=="statistics" && $contr=="Sellcard"): ?>class="current"<?php endif; ?>><a href="<?php echo url('home/Sellcard/statistics'); ?>"><i class="iconfont"></i>统计记录</a></li>
      </ul>
     </div>
     <?php if(($user['userReal']['retype']==2) OR ($user['apilib'] == 1)): ?>
	 <div class="sidebar-nav">
      <ul class="sidebar-items">
	    <li <?php if($action=="apiindex" && $contr=="Apiface"): ?>class="current"<?php endif; ?>><a href="<?php echo url('home/Apiface/apiindex'); ?>"><i class="iconfont">&#58962;</i>API管理</a></li>
        <li <?php if($action=="consign" && $contr=="Apiface"): ?>class="current"<?php endif; ?>><a href="<?php echo url('home/Apiface/consign'); ?>"><i class="iconfont"></i>收单记录</a></li>
        <li <?php if($action=="statistics" && $contr=="Apiface"): ?>class="current"<?php endif; ?>><a href="<?php echo url('home/Apiface/statistics'); ?>"><i class="iconfont">&#59178;</i>收单统计</a></li>
      </ul>
     </div>
     <?php endif; ?>
     <div class="sidebar-nav">
      <ul class="sidebar-items">
       <li <?php if($action!="index" && $contr=="Member" && $action!="memberlog"): ?>class="current"<?php endif; ?>><a href="<?php echo url('home/Member/profile'); ?>"><i class="iconfont"></i>资料管理</a></li>
       <li <?php if($action=="memberlog"): ?>class="current"<?php endif; ?>><a href="<?php echo url('home/Member/memberlog'); ?>"><i class="iconfont"></i>资金日志</a></li>
      </ul>
     </div>
     <div class="sidebar-functional">
      <a href="tencent://message/?uin=<?php echo htmlentities($C['qq']); ?>&Site=QQ交谈&Menu=yes"><i class="iconimg iconimg-qq">在线咨询</i></a>
     </div>
     <div class="sidebar-call">
      <h5>客服电话</h5>
      <p>4000518288</p>
      <small>（08:00-23:00）</small>
     </div>
    </div> 
   </div>
	<div class="view-framework-body">
	
<style>
.qiye{
    padding: 5px 10px;
    background: #007dfe;
    color: #ffffff;
    border-radius: 5px;
    height: 24px;
    line-height: 14px;
    margin-left: 8px;
    font-size: 12px;
    position: absolute;
    top: 12px;
}
</style>
    <div class="view-framework-main">
     <div class="kaka-notice">
      <div class="kaka-notice-icon">
       <i class="iconimg iconimg-notice"></i>
      </div>
      <div class="kaka-notice-time">
       <span><?php echo date("Y",strtotime($new['update_time'])); ?></span>
       <strong><?php echo date("m-d",strtotime($new['update_time'])); ?></strong>
      </div>
      <div class="kaka-notice-text">
       <h5><a href="<?php echo url('home/helpfaq/index'); ?>" target="_blank"><?php echo htmlentities($new['title']); ?></a></h5>
       <a href="<?php echo url('home/helpfaq/index'); ?>" target="_blank" title="<?php echo htmlentities($new['title']); ?>"><?php echo $new['content']; ?></a>
      </div> 
      <div class="kaka-notice-more"> 
       <a href="<?php echo url('home/helpfaq/index'); ?>" target="_blank"> <span>更多公告</span> <i class="iconfont"></i></a> 
      </div>
     </div>
     <div class="box">
      <div class="usercenter clearfix">
       <div class="usercenter-info">
        <img class="avatar" width="60" height="60" src="/static/home/images/avatar.gif" alt="" />
        <h5 style="height: 48px;line-height: 48px;">亲爱的 <?php echo htmlentities((isset($user['username']) && ($user['username'] !== '')?$user['username']:$user['mobile'])); ?>[商户ID：<?php echo htmlentities($user['shopid']); ?>]<?php if($user['userReal']['retype'] == '2'): ?><span class="qiye">企业认证</span><?php endif; ?></h5>
        <p>欢迎回到<?php echo htmlentities($C['sitename']); ?>账户中心<span class="sep">|</span><a class="text-light" href="<?php echo url('home/Login/logout'); ?>" title="如您未在自己的电脑上登录<?php echo htmlentities($C['sitename']); ?>，请务必在离开的时候点击退出，以确保您的账户安全。">退出</a></p>
        <div class="user-security">
         <label>安全等级：</label>
         <div class="user-security-progress">
          <div class="progress">
           <div class="progress-bar progress-bar-success securelevel-<?php echo security($user); ?>"></div>
          </div>
         </div>
        </div>
       </div>
       <div class="usercenter-assets">
        <div class="assets-icon">
         <i class="iconfont icon-money text-orange"></i>
        </div>
        <div class="assets-title">
         <span class="text-gray">账户余额（元）：</span>
        </div>
        <div class="assets-money">
         <?php echo htmlentities($user['money']); ?>
        </div>
       </div>
       <div class="usercenter-cash">
        <p><a class="btn btn-primary" href="<?php echo url('home/Cash/index'); ?>">提现</a><a class="btn btn-link" href="<?php echo url('home/Cash/cashrecords'); ?>">提现记录</a></p>
        <p class="text-light pt10">提现处理中的金额：&yen;<?php echo htmlentities($tix); ?></p>
       </div>
      </div>
      <ul class="security-group clearfix">
       <li class="security-item">
        <div class="security-item-bg <?php if(($user['userReal']['retype'] == '1' || $user['userReal']['retype'] == '2')): ?>security-item-finish<?php endif; ?>">
         <div class="security-item-icon">
          <i class="iconfont"></i>
         </div>
         <h5>实名认证后才可提现</h5>
        </div>
        <div class="security-item-action">
         <a class="btn <?php if(($user['userReal']['retype'] == '1' || $user['userReal']['retype'] == '2' || $user['userReal']['clas'] == '2')): ?> btn-green<?php else: ?>btn-primary<?php endif; ?>" href="<?php if(($user['userReal']['retype'] == '1' || $user['userReal']['retype'] == '2' || $user['userReal']['clas'] == '2')): ?><?php echo url('home/Account/index'); else: ?><?php echo url('home/Member/realname'); ?><?php endif; ?>"><i class="iconfont iconfont-realname"></i><?php if(($user['userReal']['retype'] == '1' || $user['userReal']['retype'] == '2' || $user['userReal']['clas'] == '2')): ?>已实名认证<?php else: ?>实名认证<?php endif; ?></a> 
        </div></li>
       <li class="security-item">
        <div class="security-item-bg <?php if(!(empty($user['mobile']) || (($user['mobile'] instanceof \think\Collection || $user['mobile'] instanceof \think\Paginator ) && $user['mobile']->isEmpty()))): ?>security-item-mobile<?php endif; ?>">
         <div class="security-item-icon">
          <i class="iconfont"></i>
         </div>
         <h5><?php if(empty($user['mobile']) || (($user['mobile'] instanceof \think\Collection || $user['mobile'] instanceof \think\Paginator ) && $user['mobile']->isEmpty())): ?>绑定手机可增强账户安全<?php else: ?><?php echo tfen($user['mobile'],3,4); ?><?php endif; ?></h5>
        </div>
        <div class="security-item-action">
         <a class="btn <?php if(empty($user['mobile']) || (($user['mobile'] instanceof \think\Collection || $user['mobile'] instanceof \think\Paginator ) && $user['mobile']->isEmpty())): ?>btn-primary<?php else: ?>btn-green<?php endif; ?>" href="<?php echo url('home/Member/photo'); ?>"><i class="iconfont iconfont-phone"></i><?php if(empty($user['mobile']) || (($user['mobile'] instanceof \think\Collection || $user['mobile'] instanceof \think\Paginator ) && $user['mobile']->isEmpty())): ?>绑定手机<?php else: ?>更换手机<?php endif; ?></a>
        </div>
	   </li>
       <li class="security-item">
        <div class="security-item-bg <?php if(!(empty($user['email']) || (($user['email'] instanceof \think\Collection || $user['email'] instanceof \think\Paginator ) && $user['email']->isEmpty()))): ?>security-item-email<?php endif; ?>">
         <div class="security-item-icon">
          <i class="iconfont"></i>
         </div>
         <h5><?php if(empty($user['email']) || (($user['email'] instanceof \think\Collection || $user['email'] instanceof \think\Paginator ) && $user['email']->isEmpty())): ?>绑定邮箱可增强账户安全<?php else: ?><?php echo tfen($user['email'],3,4); ?><?php endif; ?></h5>
        </div>
        <div class="security-item-action">
         <a class="btn <?php if(empty($user['email']) || (($user['email'] instanceof \think\Collection || $user['email'] instanceof \think\Paginator ) && $user['email']->isEmpty())): ?>btn-primary<?php else: ?>btn-green<?php endif; ?>" href="<?php echo url('home/Member/email'); ?>"><i class="iconfont"></i><?php if(empty($user['email']) || (($user['email'] instanceof \think\Collection || $user['email'] instanceof \think\Paginator ) && $user['email']->isEmpty())): ?>绑定邮箱<?php else: ?>更改邮箱<?php endif; ?></a>
        </div></li>
       <li class="security-item">
        <div class="security-item-bg security-item-password">
         <div class="security-item-icon">
          <i class="iconfont"></i>
         </div>
         <h5>使用强密码增加安全性</h5>
        </div>
        <div class="security-item-action">
         <a class="btn btn-primary" href="<?php echo url('home/Member/password'); ?>"><i class="iconfont"></i>修改密码</a>
        </div>
		</li>
		<?php if($isqq == '1'): ?>
		<li class="security-item ">
			<div class="security-item-bg <?php if(!(empty($user['qqopenid']) || (($user['qqopenid'] instanceof \think\Collection || $user['qqopenid'] instanceof \think\Paginator ) && $user['qqopenid']->isEmpty()))): ?>security-item-qq<?php endif; ?>">
			   <div class="security-item-icon">
				 <i class="iconfont"></i>
				</div>
				<h5><?php if(!(empty($user['qqopenid']) || (($user['qqopenid'] instanceof \think\Collection || $user['qqopenid'] instanceof \think\Paginator ) && $user['qqopenid']->isEmpty()))): ?>该账号已绑定QQ<?php else: ?>绑定QQ登陆便利<?php endif; ?></h5>
			</div>
			<div class="security-item-action">
			    <?php if(!(empty($user['qqopenid']) || (($user['qqopenid'] instanceof \think\Collection || $user['qqopenid'] instanceof \think\Paginator ) && $user['qqopenid']->isEmpty()))): ?>
				<a class="btn btn-green" data-dialog="<?php echo url('home/Member/delqq',['id'=>$user['id']]); ?>,350"><i class="iconfont"></i>解绑QQ</a>
				<?php else: ?>
				<a class="btn btn-primary" href="javascript:toQzoneLogin();"><i class="iconfont"></i>绑定QQ</a>
				<?php endif; ?>
			</div>
        </li>
        <?php endif; ?>
       <li>
        <div class="security-item-bg security-item-weixin">
         <img width="172" src="" />
        </div>
        <div class="security-item-action">
         <p>扫描二维码绑定微信账号<br />你的卖卡处理等信息<br />都会通过微信提醒您</p>
        </div>
        </li>
      </ul>
     </div>
     <div class="box usercenter-sellrecords">
      <h3 class="box-caption">您最近提交回收的卡：</h3>
	  <?php if(empty($res) || (($res instanceof \think\Collection || $res instanceof \think\Paginator ) && $res->isEmpty())): ?>
	  <div class="nodata">
		   <i class="iconfont icon-nodata"></i>
		   <br />您最近没有提交卡进行回收！
		   <br />
		   <a class="btn btn-primary" href="<?php echo url('home/card/index'); ?>">我要卖卡</a>
	  </div>
	  <?php else: ?>
      <div class="cards-group owl-carousel">
	  <?php if(is_array($ress) || $ress instanceof \think\Collection || $ress instanceof \think\Paginator): $i = 0; $__LIST__ = $ress;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?> 
       <div class="item">
        <div class="cards-cover">
         <a href="<?php echo url('home/card/index',['id'=>$p['tid']]); ?>" target="_blank"><img src="<?php echo htmlentities($p['phoneRecycleIcon']); ?>" alt="<?php echo htmlentities($p['title']); ?>" /> </a>
         <h5 class="title"><?php echo htmlentities($p['title']); ?></h5>
         <div class="actions">
          <a class="btn btn-default" href="<?php echo url('home/card/index',['id'=>$p['tid']]); ?>" target="_blank">我有卡要回收</a>
         </div>
        </div>
       </div>
       <?php endforeach; endif; else: echo "" ;endif; ?>
      </div>
	  <?php endif; ?>
      <script type="text/javascript" src="/static/home/js/owl.carousel.min.js"></script>
      <script>var owl = $(".owl-carousel"); owl.owlCarousel({items : 7,itemsDesktop : [1730, 6],itemsDesktopSmall : [1440, 5],itemsTablet: false,itemsMobile: false,rewindNav: false,scrollPerPage: true,navigation: true,navigationText : ["<i class='iconfont'>&#xe638;</i>", "<i class='iconfont'>&#xe629;</i>"],});<?php if($shi == '1'): ?>identitytips();<?php endif; ?></script>
     </div> 
    </div>
   
		<div class="footer footer-sm">
			<div class="text-center">
				<p class="line">
				<?php if(is_array($thisli) || $thisli instanceof \think\Collection || $thisli instanceof \think\Paginator): $i = 0; $__LIST__ = $thisli;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?>
					<a href="<?php echo url('home/Helpfaq/danye',['id'=>$p['id']]); ?>" target="_blank"><?php echo htmlentities($p['title']); ?></a><span class="sep">|</span>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</p>
				<p><?php echo htmlspecialchars_decode($C['buchong']); ?></p>
			</div>
		</div>
		
		<dl class="toolbar" id="toolbar">
			<dt data-hover="dropdown"><a href="javascript:;" id="zhiCustomBtn" onclick="chatinit('905bce5dd3944726a64816bd7a9b34d9');"><i class="iconfont iconfont-service ">&#xe63f;</i><span class="iconfont-text">在线咨询</span></a>
			<div class="dropdown-menu dropdown-menu-call animated fadeInRight">
				<h5>您也可以拨打客服电话：</h5>
				<p class="text-red h2">
					4000518288
				</p>
				<p class="text-light h6">
					（08:00-23:00）
				</p>
			</div>
			</dt>
			<dd data-hover="dropdown" class="hidden"><a href="javascript:;"><i class="iconfont iconfont-call">&#xe636;</i><span class="iconfont-text">客服<br>
			电话</span></a>
			<div class="dropdown-menu dropdown-menu-call animated fadeInRight">
				<h5>平台客服咨询电话：</h5>
				<p class="text-red h2">
				</p>
				<p class="text-light h6">
					（08:00-23:00）
				</p>
			</div>
			</dd>
			<?php if(!(empty($wx['wxewm']) || (($wx['wxewm'] instanceof \think\Collection || $wx['wxewm'] instanceof \think\Paginator ) && $wx['wxewm']->isEmpty()))): ?>
			<dd data-hover="dropdown"><a href="javascript:;"><i class="iconfont iconfont-weixin">&#xe7e5;</i><span class="iconfont-text">关注<br>
			微信</span></a>
			<div class="dropdown-menu dropdown-menu-weixin animated fadeInRight">
				<img src="<?php echo htmlentities($wx['wxewm']); ?>" alt="">
				<p class="text-light h6">
					扫码关注微信公众号
				</p>
			</div>
			</dd>
			<?php endif; ?>
			<dd><a href="<?php echo url('home/Index/feedback'); ?>" target="_blank"><i class="iconfont iconfont-feedback">&#xe644;</i><span class="iconfont-text">建议<br>
			反馈</span></a></dd><dd id="totop"><a href="#top"><i class="iconfont iconfont-top">&#xe60c;</i><span class="iconfont-text">回到<br>
			顶部</span></a></dd>
		</dl>
	</div>
</div>

<script></script>
</body>
</html>