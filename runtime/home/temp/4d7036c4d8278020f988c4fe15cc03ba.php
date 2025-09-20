<?php /*a:4:{s:58:"/www/wwwroot/www.ssyd.fun/app/home/view/helpfaq/index.html";i:1600139160;s:57:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/index.html";i:1605435704;s:54:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/to.html";i:1605574982;s:58:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/tomenu.html";i:1600587826;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
 <head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  
  <title><?php echo htmlentities((string) $C['sitename']); ?>-<?php echo htmlentities((string) $C['title']); ?> </title>
  <meta name="keywords" content="<?php echo htmlentities((string) $res['keywords']); ?>" />
  <meta name="description" content="<?php echo htmlentities((string) $res['description']); ?>" />

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
   <div class="container help-center">
    <div class="help-aside">
     <div class="help-aside-inner" id="side-float">
          <?php if(is_array($fg) || $fg instanceof \think\Collection || $fg instanceof \think\Paginator): $i = 0; $__LIST__ = $fg;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?>
	  <dl class="help-links">
	  <?php if($i == '1'): ?>
       <dt>
        关于我们
       </dt>
	   <dd <?php if($id == '0'): ?>class="current"<?php endif; ?>>
        <a href="<?php echo url('home/Helpfaq/index'); ?>" >平台公告</a>
       </dd>
	   <?php endif; if(is_array($p) || $p instanceof \think\Collection || $p instanceof \think\Paginator): $k = 0; $__LIST__ = $p;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$k): $mod = ($k % 2 );++$k;?>
		   <dd <?php if($id == $k['id']): ?>class="current"<?php endif; ?>>
			<a href="<?php echo url('home/Helpfaq/danye',['id'=>$k['id']]); ?>"><?php echo htmlentities((string) $k['title']); ?></a>
		   </dd>
		<?php endforeach; endif; else: echo "" ;endif; if($i == '1'): ?>
	   <dd <?php if($action == 'feedback'): ?>class="current"<?php endif; ?>>
        <a href="<?php echo url('home/Index/feedback'); ?>" >意见反馈</a>
       </dd>
	   <?php endif; ?>
      </dl>
    <?php endforeach; endif; else: echo "" ;endif; ?>
     </div> 
    </div>
    <script src="/static/home/js/jquery.fixed.js"></script>
    <script>$(document).ready(function(){$("#side-float").smartFloat({classname: 'fixed',reference: $("#footer").offset().top - 135});});</script>
    <div class="help-main">
	<h2>平台公告</h2>
	<div class="timeline notice-timeline">
		<s class="timeline-line"></s>
		<ul class="timeline-listing">
		<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?>
			<li class="timeline-item">
			<div class="timeline-date">
				<i class="dot"></i><?php echo date("m-d",strtotime($p['update_time'])); ?><span><?php echo date("Y",strtotime($p['update_time'])); ?></span>
			</div>
			<div class="timeline-main">
				<h5><?php echo htmlentities((string) $p['title']); ?></h5>
				<?php echo htmlspecialchars_decode($p['content']); ?>
			</div>
			</li>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
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