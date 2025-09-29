<?php /*a:4:{s:61:"/www/wwwroot/ka1.y9fu.com/app/home/view/cash/cashrecords.html";i:1604302294;s:58:"/www/wwwroot/ka1.y9fu.com/app/home/view/layout/member.html";i:1605574940;s:54:"/www/wwwroot/ka1.y9fu.com/app/home/view/layout/to.html";i:1605574982;s:61:"/www/wwwroot/ka1.y9fu.com/app/home/view/layout/user_menu.html";i:1605547434;}*/ ?>
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
.lay-span{
    padding: 3px 10px;
    color: #FFF;
    border-radius: 5px;
}
</style>
    <div class="view-framework-body">
   <div class="view-framework-main">
	<div class="box">
		<h2 class="box-caption">我的提现记录<span class="h4 text-red pl10">（如遇提现失败，请联系客服了解详情！客服电话：4000518288）</span></h2>
		<div class="form-filter">
			<div class="form-group">
				<form action="<?php echo request()->url(); ?>" method="get" id="formsubmit">
					<label class="control-label" for="qStartTime">日期筛选</label>
					  <input type="text" class="form-control form-datetime" id="qStartTime" name="starttime" value="<?php echo htmlentities((isset($starttime) && ($starttime !== '')?$starttime:'')); ?>" autocomplete="off">
					  <span class="control-label">-</span>
					  <input type="text" class="form-control form-datetime mr10" id="qEndTime" name="endtime" value="<?php echo htmlentities((isset($endtime) && ($endtime !== '')?$endtime:'')); ?>" autocomplete="off">
					  <button class="btn btn-primary btn-sm btn-square" type="submit" onclick="return formtest(this);">查询</button>
					  <a class="item" href="<?php echo url('home/Cash/cashrecords'); ?>">全部</a>
					  <a class="item <?php if($day == '1'): ?>selected<?php endif; ?>" href="javascript:;" onclick="submitset('day',1)">今天</a>
                  <a class="item <?php if($day == '7'): ?>selected<?php endif; ?>" href="javascript:;" onclick="submitset('day',7)">最近7天</a>
                  <a class="item <?php if($day == '30'): ?>selected<?php endif; ?>" href="javascript:;" onclick="submitset('day',30)">1个月</a>
                  <a class="item <?php if($day == '60'): ?>selected<?php endif; ?>" href="javascript:;" onclick="submitset('day',60)">2个月</a>
                  <a class="item <?php if($day == '90'): ?>selected<?php endif; ?>" href="javascript:;" onclick="submitset('day',90)">3个月</a>
                  <a class="item <?php if($day == '365'): ?>selected<?php endif; ?>" href="javascript:;" onclick="submitset('day',365)">1年</a>
					  <input type="hidden" name="day" value="<?php echo htmlentities((isset($day) && ($day !== '')?$day:'')); ?>">
				</form>
			</div>
		</div>
		<div class="table-responsive">
			<table class="table table-custom cash-records">
			<thead>
			<tr>
			    <th class="date">
					订单号
				</th>
				<th class="date">
					日期
				</th>
				<th class="paysum">
					提现金额(元)
				</th>
				<th class="paysum">
					手续费
				</th>
				<th class="paysum">
					实际到账
				</th>
				<th class="paysum">
					提现类型
				</th>
				<th class="inid">
					提现账号
				</th>
				<th class="state">
					状态
				</th>
				<th class="note">
					说明
				</th>
			</tr>
			</thead>
			<tbody>
			  <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?>
				  <tr>
				    <th class="date"><?php echo htmlentities($p['order']); ?></th>
                    <th class="date"><?php echo htmlentities($p['create_time']); ?></th>
                    <th class="paysum" style="color: #0085fe"><?php echo htmlentities($p['money']); ?></th>
					<th class="paysum" style="color: #46be8a"><?php echo htmlentities($p['price']); ?></th>
					<th class="paysum" style="color: #f30"><?php echo htmlentities($p['money']-$p['price']); ?></th>
					<th class="paysum" style="width:100px"><?php echo htmlentities($p['type']); ?></th>
                    <th class="inid"><?php echo htmlentities($p['bankname']); ?>-<?php echo htmlentities($p['accounts']); ?></th>
                    <th class="state"><?php echo htmlspecialchars_decode($p['status']); ?></th>
                    <th class="note"><?php echo htmlentities($p['content']); ?></th>
				</tr>
			 <?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
			<tfoot>
			<tr>
				<td colspan="5">
					<p class="text-left">
						<label>本页合计提现金额：</label><span class="text-dark">¥<?php echo htmlentities($money); ?></span>
					</p>
				</td>
			</tr>
			</tfoot>
			</table>
		</div>
		<div class="pb20">
			  <?php echo $list; ?>
       </div>
	</div>
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