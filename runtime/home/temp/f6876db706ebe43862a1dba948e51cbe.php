<?php /*a:4:{s:62:"/www/wwwroot/ka1.y9fu.com/app/home/view/sellcard/usercard.html";i:1606131630;s:58:"/www/wwwroot/ka1.y9fu.com/app/home/view/layout/member.html";i:1605574940;s:54:"/www/wwwroot/ka1.y9fu.com/app/home/view/layout/to.html";i:1605574982;s:61:"/www/wwwroot/ka1.y9fu.com/app/home/view/layout/user_menu.html";i:1605547434;}*/ ?>
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
      .feilv{
          height: 50px;
            border-radius: 5px;
            border: 2px solid #e4ecfa;
            padding-left: 8px;
            font-size: 18px;
            float: left;
      }
      .feilv:focus{
           border: 2px solid #ff1880
      }
      #feilvnote{
          display: block;
            width: 50%;
            float: left;
            margin-left: 20px;
      }
  </style>
    <div class="view-framework-body">
   <div class="view-framework-main">
	<div class="box py10">
		<!-- <h2 class="box-caption hidden">我要卖卡<span class="h4 pl10">（您好，a182362754，您是的<span class="text-red"></span>客户）</span></h2> -->
	<div class="recycle-primary">
    <div class="container">
     <div class="recycle-loader" id="recycleLoader">
      <div class="recycle-loading"> 
       <img src="/static/home/images/sprites/loader.gif" />
       <h3>回收表单加载中，请稍候...</h3>
       <p>如长时间未加载成功，请刷新重试~</p>
       <p><a class="btn btn-default btn-sm" href="javascript:location.reload();">点我刷新或Ctrl+F5</a></p>
      </div>
      <div class="recycle-former recycle-placeholder">
       <div class="form-group">
        <div class="col-xs-11 col-xs-offset-1">
         <ul class="btn-group btn-group-tall clearfix">
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li> 
         </ul>
        </div>
       </div>
       <hr />
	   <div class="form-group">
        <div class="col-xs-11 col-xs-offset-1">
         <ul class="btn-group btn-group-tall clearfix">
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li> 
         </ul>
        </div>
       </div>
       <hr />
	   <div class="form-group">
        <div class="col-xs-11 col-xs-offset-1">
         <ul class="btn-group btn-group-tall clearfix">
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li> 
         </ul>
        </div>
       </div>
       <hr />
	   <div class="form-group">
        <div class="col-xs-11 col-xs-offset-1">
         <ul class="btn-group btn-group-tall clearfix">
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li> 
         </ul>
        </div>
       </div>
       <hr />
	   <div class="form-group">
        <div class="col-xs-11 col-xs-offset-1">
         <ul class="btn-group btn-group-tall clearfix">
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li>
          <li><span class="btn btn-placeholder"></span></li> 
         </ul>
        </div>
       </div>
       <hr />
      </div>
     </div>
     <div class="recycle-former hide" id="recycleFormer">
      <form method="post" name="sell" id="sell">
       <div class="form-group">
        <div class="col-xs-1">
         <label class="control-label">选择卡类：</label>
        </div>
        <div class="col-xs-11">
         <ul class="btn-group btn-group-cardtype clearfix" id="cardTypeBtns"> 
          <?php if(is_array($cardModel) || $cardModel instanceof \think\Collection || $cardModel instanceof \think\Paginator): $i = 0; $__LIST__ = $cardModel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;if($p['status'] == '1'): ?>
           <li id="cardType_<?php echo htmlentities($p['id']); ?>" <?php if($p['id'] == $cid): ?>class="active"<?php endif; ?>><a class="btn-card btn-card-<?php echo htmlentities($p['route']); ?>" onclick="getSpecies(this,<?php echo htmlentities($p['id']); ?>)"><i class="iconfont iconfont-<?php echo htmlentities($p['route']); ?>"></i><span><?php echo htmlentities($p['title']); ?></span> </a> </li> 
		  <?php endif; ?>
		  <?php endforeach; endif; else: echo "" ;endif; ?>
          
         </ul>
        </div>
       </div>
       <hr />
       <div class="form-group">
        <div class="col-xs-1">
         <label class="control-label">选择卡种：</label>
        </div>
        <div class="col-xs-11">
         <ul class="btn-group btn-group-tall clearfix" id="cardSpecies"></ul>
        </div>
       </div>
       <hr />
       <div class="recycle-opening" id="recycle-opening">
        <div class="isQbi">
         <div class="form-group" id="card-facevalue-wrapper">
          <div class="col-xs-1">
           <label class="control-label" id="recycle-danzhang">单张面值：<br /><span class="text-red">不得选错&nbsp;&nbsp;&nbsp;</span></label>
          </div>
          <div class="col-xs-11 card-facevalue-box" id="cardFacevalueBox">
           <ul class="btn-group btn-group-value clearfix" id="cardFacevalue"></ul>
           <div class="card-facevalue-tips"></div>
          </div>
         </div>
         <hr />
          <div class="form-group hide" id="fast-deal">
          <div class="col-xs-1">
           <label class="control-label" id="recycle-batch">定义折扣：</label>
          </div>
          <div class="col-xs-11">
           <input type="text" name="feilv" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,4})?).*$/g, '$1')" class="feilv">
            <p class="text-orange h4 pt10 hide" id="feilvnote"></p>
          </div>
         </div>
         <div class="form-group" id="batch">
          <div class="col-xs-1">
           <label class="control-label" id="recycle-batch">提交方式：</label>
          </div>
          <div class="col-xs-11">
           <ul class="btn-group btn-group-figure btn-group-units clearfix" id="chooseMode">
            <li class="active"><a class="btn" id="choose-batch" href="#batchMode"><i class="iconfont iconfont-batch"></i>批量提交<b></b></a></li>
            <li class=""><a class="btn" id="choose-single" href="#singleMode"><i class="iconfont iconfont-single"></i>单张提交<b></b></a></li>
            <li class="hide" id="uploadModeBtn"><a class="btn" id="choose-upload" href="#uploadMode"><i class="iconfont iconfont-upload-img"></i>图片提交<b></b></a></li>
           </ul>
           <p class="text-orange h4 pt10 hide" id="cardnote"></p>
          </div>
         </div>
         <div class="recycle-mode" id="batchMode">
          <div class="form-group">
           <div class="col-xs-1">
            <label class="control-label" id="recycle-cardnopsw">卡号/密码：</label>
           </div>
           <div class="col-xs-11">
            <div class="textarea-wrapper">
             <textarea class="form-control" name="cardlist" id="cardlist" onkeydown="cardnum(this,event)" onblur="cardnum(this,'blur')" wrap="off"></textarea>
             <div class="textarea-tips">
              <div class="mask-black"></div>
              <ul class="textarea-tips-list" id="card-tips">
               <li class="textarea-attention"><i class="iconfont iconfont-tips"></i> <p class="text-red nocode">卡号与卡密之间请用<strong class="text-orange">“空格”</strong>隔开，<br />每张卡占用一行用 <strong class="text-orange">&quot;回车(Enter键)&quot;</strong> 隔开，例：</p><p class="text-red hide onlypass">此卡种无需卡号，只需填写卡密，<br />每张一行用<strong class="text-orange">&quot;回车(Enter键)&quot;</strong>隔开！</p><p class="h5 text-gray" id="cardlizi"></p></li>
              </ul>
             </div>
            </div>
            <div class="help-block">
             <a class="btn btn-sm btn-primary cardlist-neaten" id="cardlist-neaten" href="javascript:;">整理卡号/密码</a>
             <span class="inline-block pl20">已经输入 <strong id="cardnum" class="text-red">0</strong> 张面值 <strong class="text-red"><strong id="cardmz">0</strong>元</strong> 的卡，每次最多可提交1000张 </span>
            </div>
           </div>
          </div>
         </div>
         <div class="recycle-mode hide" id="singleMode">
          <div class="form-group nocode">
           <div class="col-xs-1">
            <label class="control-label" id="recycle-cardno">输入卡号：</label>
           </div>
           <div class="col-xs-4">
            <input class="form-control" name="cardno[]" type="text" placeholder="请输入卡号" />
           </div>
          </div>
          <div class="form-group">
           <div class="col-xs-1">
            <label class="control-label" id="recycle-cardpsw">输入卡密：</label>
           </div>
           <div class="col-xs-4">
            <input class="form-control" name="cardpsw[]" type="text" placeholder="请输入卡密" reg="^[A-Za-z0-9_-]{4,30}$" />
           </div>
          </div>
          <div class="form-group switchVerify">
           <div class="col-xs-1 verifycode-label">
            <label class="control-label">卡验证码：</label>
           </div>
           <div class="col-xs-2 verifycode-input">
            <input class="form-control" name="cardcode[]" type="text" placeholder="请输入卡验证码" />
           </div>
          </div>
         </div>
         <div class="recycle-mode hide" id="uploadMode">
          <div class="form-group">
           <div class="col-xs-1">
            <label class="control-label">上传图片：</label>
           </div>
           <div class="col-xs-11">
            <div class="uploadimg-group clearfix" id="uploadimg-group">
             <ul id="uploadimg-preview"></ul>
             <div class="uploadimg-btn">
              <label class="btn btn-default btn-uploadfile" for="uploadimg" id="uploadimg"><span><i class="iconfont"></i>上传<em class="upload-text">实体卡</em></span></label>
             </div>
            </div>
            <div class="help-block">
             <p>可多选，最多可同时提交<strong class="text-red">10</strong>张<em class="upload-text">实体卡</em>图片</p>
            </div>
           </div>
          </div>
         </div>
        </div>
       
        <div class="recycle-sumbit" id="recycle-sumbit">
         <hr />
        <!-- <div class="form-group fast-deal hide" id="fast-deal">
          <div class="col-xs-11 col-xs-offset-1">
           <label class="checkbox" for="urgent"><input type="checkbox" id="urgent" /><span class="checkbox-text">我要加急处理<span class="gray">(9:00-18:00)</span> <span class="text-red hide" id="urgent-money">（手续费:3%）</span> </span></label>
          </div>
         </div>-->
         <div id="recycle-check">
          <div class="form-group">
           <div class="col-xs-11 col-xs-offset-1">
            <label class="checkbox" for="protocol"><input type="checkbox" id="protocol" checked="checked" /><span class="checkbox-text"> 我已阅读，理解并接受「<a class="text-blue" target="_blank" href="/home/help_danye/21.html"><?php echo htmlentities($C['sitename']); ?>礼品卡转让协议</a>」和「<a class="text-blue" target="_blank" href="/home/help_danye/20.html">礼品卡回收说明</a>」</span></label>
           </div>
          </div>
          <div class="form-group">
           <div class="col-xs-11 col-xs-offset-1">
            <label class="checkbox" for="legal"><input type="checkbox" id="legal" checked="checked" /><span class="checkbox-text">我已确认该<span class="isQbi notQbijs">卡号卡密</span><span class="recycle-qbi isQbijs hide">账号内Q币</span><strong class="text-primary">来源合法</strong>，如有问题，本人愿意承担一切法律责任。</span></label>
           </div>
          </div>
          <div class="form-group" id="isFaceerr">
           <div class="col-xs-11 col-xs-offset-1">
            <label class="checkbox" for="faceerr"><input type="checkbox" id="faceerr" /><span class="checkbox-text">我已确认该卡<strong class="text-primary">面值</strong>准确无误，<strong class="text-primary">如有面值错误余额恕不退还！损失自行承担！</strong></span></label>
           </div>
          </div>
         </div>
         <hr />
         <div class="form-group isQbi">
          <div class="col-xs-11 col-xs-offset-1">
           <input type="hidden" name="urgent" id="urgentval" value="0" />
           <input type="hidden" name="type" id="type" value="0" />
		   <input type="hidden" name="cardtype" id="cardtype" value="0" />
           <input type="hidden" name="cardprice" id="cardprice" value="" />
		   <input type="hidden" name="mcode" id="mcode" value="" />
           <button class="btn btn-green btn-lg btn-sellform" type="button" id="sellbutton" name="sell" onclick="tijiao();">确认提交卖卡</button>
          </div>
         </div>
        
        </div>
       </div>
       <div class="recycle-closed recycle-closed-maintain hide" id="recycle-closed-1">
        <div class="inner">
         <i class="iconimg iconimg-maintain"></i>
         <div class="textips">
          <h3>非常抱歉，<strong class="text-red">此卡回收通道维护中，暂时无法提交</strong></h3>
          <p>具体恢复时间，将以网站公告形式通知！</p>
         </div>
        </div>
       </div>
       <div class="recycle-closed recycle-closed-qiye hide" id="recycle-closed-2">
        <p class="h3 hide"><strong class="text-red">非常抱歉，此卡只针对企业用户</strong></p>
        <a class="btn btn-orange" href="javascript:;" onclick="chatinit();" rel="external nofollow">详情请咨询在线客服</a>
       </div>
      </form>
     </div>
     <div class="recycle-usable hide" id="recycleUsable">
      <i class="iconimg iconimg-disabled"></i>
      <h3>非常抱歉，<strong class="text-red">暂不支持您提交本卡类</strong></h3>
      <a class="btn btn-primary" href="javascript:;" onclick="chatinit();" rel="external nofollow">如有疑问请咨询在线客服</a>
      <fieldset class="orline">
       <legend class="orline-title" align="center">您也可以选择其他卡类进行回收</legend>
      </fieldset>
      <ul class="recycle-usable-cardbtns">
	    <?php if(is_array($cardModel) || $cardModel instanceof \think\Collection || $cardModel instanceof \think\Paginator): $i = 0; $__LIST__ = $cardModel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;if($p['status'] == '1'): ?>
           <li id="cardUsable_<?php echo htmlentities($p['id']); ?>"><a href="<?php echo url('home/card/index',['cid'=>$p['id']]); ?>"><img src="<?php echo htmlentities($p['image']); ?>" /><span><?php echo htmlentities($p['title']); ?></span> </a> </li> 
		  <?php endif; ?>
		  <?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
     </div>
    </div>
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

     <div id="carddiy" class="modal hide" style="width: 300px">
    <div class="cardprice-modal">
     <div class="form-tips text-red" id="carddiyTips"></div>
     <div class="form-group">
      <input class="form-control" name="diyprice" type="text" placeholder="请输入10-10000元的面值" maxlength="20" />
     </div>
     <div class="form-group">
      <button class="btn btn-primary btn-block" type="button" name="login-form" onclick="idiyselect();">确 定</button>
     </div>
    </div>
   </div> 
   <script>var cardtype = 32;var cardid=0;</script>
   <script src="/static/home/js/webuploader.min.js"></script>
   <script src="/static/home/js/recycle.common.js?<?php echo time(); ?>"></script>
   <script src="/static/home/js/recycle.primary.js?<?php echo time(); ?>"></script> 
   
<script></script>
</body>
</html>