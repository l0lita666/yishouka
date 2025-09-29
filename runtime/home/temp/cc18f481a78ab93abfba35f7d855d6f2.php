<?php /*a:5:{s:55:"/www/wwwroot/www.ssyd.fun/app/home/view/card/index.html";i:1605169160;s:57:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/index.html";i:1605435704;s:54:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/to.html";i:1605574982;s:63:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/home_buttom.html";i:1600587826;s:60:"/www/wwwroot/www.ssyd.fun/app/home/view/layout/home_wen.html";i:1606023322;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
 <head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  
  <title><?php echo htmlentities($C['sitename']); ?>-<?php echo htmlentities($ress['title']); ?> </title>
  <meta name="keywords" content="<?php echo htmlentities($ress['keywords']); ?>" />
  <meta name="description" content="<?php echo htmlentities($ress['description']); ?>" />
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
      <a href="/"><span class="logo"><img src="<?php echo htmlentities($C['logo']); ?>" style="display:block;margin: auto;" alt="<?php echo htmlentities($C['sitename']); ?>" /></span></a>
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
   <li class="" id="navbar-buy"><a href="https://www.aixiaoka.net/help_danye/22.html" target="_blank"><i class="iconfont"></i><span>关于我们</span></a></li>
   <li class="" id="navbar-xianxia"><a href="http://bbs.aixiaoka.net" target=“_blank”><i class="iconfont"></i><span>论坛<span></a></li> 
 <li class="" id="navbar-xianxia"><a href="https://www.aixiaoka.net/business.html"><i class="iconfont"></i><span>线下卡回收</span></a></li> 
   <?php if(!(empty($wx['appimg']) || (($wx['appimg'] instanceof \think\Collection || $wx['appimg'] instanceof \think\Paginator ) && $wx['appimg']->isEmpty()))): ?>
   <li class="" id="navbar-app" data-hover="dropdown"><a href="<?php echo url('home/index/app'); ?>"><i class="iconfont"></i><span>关注公众号</span></a>
    <div class="dropdown-menu animated zoomIn">
     <div class="navbar-download"> 
      <h5>手机回收方便快捷</h5> 
      <img src="<?php echo htmlentities($wx['appimg']); ?>" alt="" /> 
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
         <p class="link"><a class="btn btn-primary btn-block zhiCustomBtn" href="tencent://message/?uin=<?php echo htmlentities($C['qq']); ?>&Site=QQ交谈&Menu=yes" onclick="chatinit('905bce5dd3944726a64816bd7a9b34d9');" rel="external nofollow">在线客服咨询</a></p>
        </div></li>
       <li class="navbar-hezuo"><a class="navbar-icon" href="<?php echo url('home/helpfaq/business'); ?>" title="招商合作"><i class="iconfont iconfont-hezuo"></i></a></li>
      </ul>
     </div>
    </div>
   </div>
  </div>
 
  <div class="content"> 
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
          <?php if(is_array($cardModel) || $cardModel instanceof \think\Collection || $cardModel instanceof \think\Paginator): $i = 0; $__LIST__ = $cardModel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;if($p['istype'] == '0'): ?>
           <li id="cardType_<?php echo htmlentities($p['id']); ?>" <?php if($p['id'] == $cid): ?>class="active"<?php endif; ?>><a class="btn-card btn-card-<?php echo htmlentities($p['route']); ?>" href="<?php echo url('home/card/index',['cid'=>$p['id']]); ?>"><i class="iconfont iconfont-<?php echo htmlentities($p['route']); ?>"></i><span><?php echo htmlentities($p['title']); ?></span> </a> </li> 
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
         <!--<div class="form-group fast-deal hide" id="fast-deal">
          <div class="col-xs-11 col-xs-offset-1">
           <label class="checkbox" for="urgent"><input type="checkbox" id="urgent" /><span class="checkbox-text">我要加急处理<span class="gray">(9:00-18:00)</span> <span class="text-red hide" id="urgent-money">（手续费:3%）</span> </span></label>
          </div>
         </div>-->
         <div id="recycle-check">
          <div class="form-group">
           <div class="col-xs-11 col-xs-offset-1">
            <label class="checkbox" for="protocol"><input type="checkbox" id="protocol" checked="checked" /><span class="checkbox-text"> 我已阅读，理解并接受「<a class="text-blue" target="_blank" href="<?php echo url('home/Helpfaq/danye',['id'=>21]); ?>"><?php echo htmlentities($C['sitename']); ?>礼品卡转让协议</a>」和「<a class="text-blue" target="_blank" href="<?php echo url('home/Helpfaq/danye',['id'=>20]); ?>">礼品卡回收说明</a>」</span></label>
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
   <script>var cardtype = <?php echo htmlentities($cid); ?>;var cardid=<?php echo htmlentities($tid); ?>;</script>
   <script src="/static/home/js/webuploader.min.js"></script>
   <script src="/static/home/js/recycle.common.js?<?php echo time(); ?>"></script>
   <script src="/static/home/js/recycle.primary.js?<?php echo time(); ?>"></script> 
   <div class="panel panel-stepflow-inverse">
    <div class="container">
     <div class="kaka-stepflows">
      <ul class="stepflow-group clearfix">
       <li>
        <div class="icon">
         <i class="iconfont iconfont-step-sign"></i>
        </div>
        <div class="title">
         注册账号
        </div>
        <div class="num">
         01
        </div></li>
       <li>
        <div class="flow">
         登录卡卡账户
        </div></li>
       <li>
        <div class="icon">
         <i class="iconfont iconfont-step-realname"></i>
        </div>
        <div class="title">
         实名认证
        </div>
        <div class="num">
         02
        </div></li>
       <li>
        <div class="flow">
         绑定提现账号
        </div></li>
       <li>
        <div class="icon">
         <i class="iconfont iconfont-step-input"></i>
        </div>
        <div class="title">
         提交卡密
        </div>
        <div class="num">
         03
        </div></li>
       <li>
        <div class="flow">
         等待平台验卡
        </div></li>
       <li>
        <div class="icon">
         <i class="iconfont iconfont-step-verify"></i>
        </div>
        <div class="title">
         验卡成功
        </div>
        <div class="num">
         04
        </div> </li>
       <li>
        <div class="flow">
         相应资金到账
        </div></li>
       <li>
        <div class="icon">
         <i class="iconfont iconfont-step-cash"></i>
        </div>
        <div class="title">
         账户提现
        </div>
        <div class="num">
         05
        </div></li>
       <li>
        <div class="flow">
         银行或支付宝
        </div></li>
       <li>
        <div class="icon">
         <i class="iconfont iconfont-step-completed"></i>
        </div>
        <div class="title">
         交易成功
        </div>
        <div class="num">
         06
        </div></li>
      </ul>
     </div>
    </div>
   </div>
 <div class="panel panel-bggray panel-cards">
    <div class="container">
     <div class="cards">
      <ul class="cards-tabs">
	  <?php if(is_array($cardModel) || $cardModel instanceof \think\Collection || $cardModel instanceof \think\Paginator): $i = 0; $__LIST__ = $cardModel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?>
       <li id="card<?php echo htmlentities($i); ?>" onclick="setTab('card', <?php echo htmlentities($i); ?>, 7);" <?php if($i == '1'): ?>class="active"<?php endif; ?>><a href="javascript:;"><i class="iconfont <?php echo htmlentities($p['icon']); ?>"></i><span><?php echo htmlentities($p['title']); ?></span><span class="cover"><img src="<?php echo htmlentities($p['image']); ?>" /></span></a></li>
	   <?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
      <div class="cards-content">
	  <?php if(is_array($cardModel) || $cardModel instanceof \think\Collection || $cardModel instanceof \think\Paginator): $m = 0; $__LIST__ = $cardModel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$k): $mod = ($m % 2 );++$m;?>
       <div id="con_card_<?php echo htmlentities($m); ?>" class="cards-item <?php if($m != '1'): ?>hide<?php endif; ?>">
        <div class="cards-group owl-carousel clearfix" id="silder">
		<?php if(is_array($k['comments']) || $k['comments'] instanceof \think\Collection || $k['comments'] instanceof \think\Paginator): $i = 0; $__LIST__ = $k['comments'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$b): $mod = ($i % 2 );++$i;?>
         <div class="item">
          <div class="cards-cover">
           <a href="<?php echo url('home/card/index',['id'=>$b['id']]); ?>" target="_blank"><img src="<?php echo htmlentities($b['phoneRecycleIcon']); ?>" alt="<?php echo htmlentities($b['title']); ?>" /></a>
           <h5 class="title"><a href="<?php echo url('home/card/index',['id'=>$b['id']]); ?>"><?php echo htmlentities($b['title']); ?></a></h5>
           <h6 class="discount"><?php echo hasTone($b['tid'],$b['type']); ?></h6>
           <div class="actions">
            <a class="btn btn-default" href="<?php echo url('home/card/index',['id'=>$b['id']]); ?>" target="_blank">我有卡要回收</a>
           </div>
          </div>
         </div>
		 <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
       </div>
	   <?php endforeach; endif; else: echo "" ;endif; ?>
      </div>
     </div>
     <script type="text/javascript" src="/static/home/js/owl.carousel.min.js"></script>
     <script>$(".owl-carousel").owlCarousel({items : 7,itemsDesktop: [2048,7],itemsDesktopSmall: [1900,6],itemsTablet: [1280,5],itemsMobile: false,rewindNav: false,scrollPerPage: true,navigation: true,navigationText : ["<i class='iconfont'>&#xe638;</i>", "<i class='iconfont'>&#xe629;</i>"],});</script>
</div>
</div> 
 <div class="panel panel-faq">
	<div class="container">
		<div class="panel-heading">
			<h3 class="panel-title">回收常见问题</h3>
			<div class="panel-subtitle">
				<p>
					<a href="<?php echo url('home/helpfaq/danye',['id'=>17]); ?>">回收流程</a><span class="sep">|</span><a href="<?php echo url('home/helpfaq/index'); ?>">帮助中心</a><span class="sep">|</span><a href="<?php echo url('home/helpfaq/danye',['id'=>23]); ?>">商家合作</a><span class="sep">|</span><a href="<?php echo url('home/helpfaq/index'); ?>">更多</a>
				</p>
			</div>
		</div>
		<div class="faq-group clearfix">
			<ul class="pull-left">
				<li>
				<h5><strong>1、</strong><?php echo htmlentities($C['sitename']); ?>平台必须实名吗？</h5>
				<div class="faq-content">
					<p>
						<?php echo htmlentities($C['sitename']); ?>根据法律法规和相关部门规定，爱销卡用户注册必须实名和绑定实名电话，否则无法提交二手回收卡和提现，提现账号必须和注册实名账号一致。为保障您的权益及资金安全，请及时绑定邮箱和修改安全密码。
					</p>
					<p class="text-danger">
						<strong>注册即视为同意爱销卡平台所有协议和规则。</strong>
					</p>
				</div>
				</li>
				<li>
				<h5><strong>3、</strong>游戏卡与话费卡必看问题！</h5>
				<div class="faq-content">
					<p>
						游戏卡与话费卡为“自动结算”形式回收，用户提交订单后最快几分钟内即可完成交易
					</p>
					<p class="text-danger">
						<strong>请提交前认真核对选择的面额，如实际面额与选择面额不符，则需要人工干预，不仅有钱款损失的风险，且费时费力。</strong>
					</p>
				</div>
				</li>
				<li>
				<h5><strong>5、</strong>哪些卡不支持回收？</h5>
				<div class="faq-content">
					<p>
						凡是已使用的卡、偷盗卡、非正常渠道获得的卡以及网站上没有的卡种我们都不回收。
					</p>
				</div>
				</li>
			</ul>
			<ul class="pull-right">
				<li>
				<h5><strong>2、</strong>回收需要手续费么？</h5>
				<div class="faq-content">
					<p>
						回收价格已经包含手续费，不会再收取任何形式的手续费（加急处理功能除外）提现受银行和代付限制，每笔收取2元。夜间受银行及代付公司影响，可能造成到账延时，提现时间建议在8：00-23：00.
					</p>
				</div>
				</li>
				<li>
				<h5><strong>4、</strong>电子卡和实体卡都支持回收吗？</h5>
				<div class="faq-content">
					<p>
						实体卡是实物的，是一张卡片的形式，卡的背面有卡号和密码；电子卡是虚拟的，是通过网上在线购买获取卡号和密码的；
					</p>
					<p>
						实体卡和电子卡进行回收时只需要有卡号和密码即可，不区分电子卡和实体卡。
					</p>
				</div>
				</li>
				<li>
				<h5><strong>6、</strong>验证成功后，如何收款？</h5>
				<div class="faq-content">
					<p>
						验证成功后，会直接转账到登录网站的账号上，绑定银行卡或支付宝即可。
					</p>
					<p>
						工作时间内提交，一般半个小时内处理完成（特殊情况除外）；夜间不建议进行提现，银行或者代付机构不在线，导致提现延时到账。非工作时间内，处理时间将延期到下一个工作时间。
					</p>
				</div>
				</li>
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
        <li><a href="<?php echo url('home/Helpfaq/danye',['id'=>$p['id']]); ?>" target="_blank">&middot; <?php echo htmlentities($p['title']); ?></a></li>
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
           <a class="btn btn-primary"  href="tencent://message/?uin=<?php echo htmlentities($C['qq']); ?>&Site=Sambow&Menu=yes" ><i class="iconfont iconfont-service "></i><span class="iconfont-text">QQ在线咨询</span></a>
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
        <li><img src="<?php echo htmlentities($wx['appimg']); ?>" /><h5>关注微信公众号</h5></li>
		<?php endif; if(!(empty($C['wxewm']) || (($C['wxewm'] instanceof \think\Collection || $C['wxewm'] instanceof \think\Paginator ) && $C['wxewm']->isEmpty()))): ?>
        <li><img src="<?php echo htmlentities($C['wxewm']); ?>" /><h5>扫码添加微信客服</h5></li>
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
      <li style="margin:0 8px;float:left;padding: 2px 8px;"><a href="<?php echo htmlentities($p['url']); ?>" target="<?php echo htmlentities($p['target']); ?>" rel="nofollow"><span><?php echo htmlentities($p['name']); ?></span></a></li>
	  <?php endforeach; endif; else: echo "" ;endif; ?>
     </ul>
  
    </div>
   </div>
   <div class="footer-about">
    <div class="container">
     <ul class="authentication clearfix">
	 <?php $_result=get_link(6,'desc');if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?>
      <li><a href="<?php echo htmlentities($p['url']); ?>" target="<?php echo htmlentities($p['target']); ?>" rel="nofollow"><i class="iconimg"><img style="display: block;
    height: 100%;" src="<?php echo htmlentities($p['image']); ?>"></i><span><?php echo htmlspecialchars_decode($p['name']); ?></span></a></li>
     <?php endforeach; endif; else: echo "" ;endif; ?>
     </ul>
     <div class="copyright">
      <p><?php echo htmlentities($C['copyright']); ?><span class="sep">|</span><a href="/" target="_blank"><?php echo htmlentities($C['sitename']); ?></a></p>
      <p><a href="http%3A%2F%2Fwww.miitbeian.gov.cn%2F" target="_blank" rel="nofollow">ICP证：<?php echo htmlentities($C['beian']); ?></a><?php echo htmlspecialchars_decode($C['buchong']); ?></p>
     </div>
    </div>
   </div>
  </div>
  <dl class="toolbar" id="toolbar">
   <dt data-hover="dropdown">
       <a href="tencent://message/?uin=<?php echo htmlentities($C['qq']); ?>&Site=QQ交谈&Menu=yes" ><i class="iconfont iconfont-service "></i><span class="iconfont-text">QQ在线咨询</span></a>

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