<?php /*a:1:{s:58:"/www/wwwroot/www.ssyd.fun/app/admin/view/index/index.phtml";i:1605368572;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>后台管理 - 爱销卡</title>
    <link rel="stylesheet" href="/static/simple/hqui/libs/layui/css/layui.css"/>
    <link rel="stylesheet" href="/static/simple/hqui/module/admin.css?v=316"/>
    <!-- 风格 -->
    <link rel="stylesheet" href="/static/simple/hqui/css/theme.css"/>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <!-- 头部 -->
    <div class="layui-header">
        <div class="layui-logo">
            <img src="/static/simple/hqui/images/logo.png"/>
            <cite>爱销卡</cite>
        </div>
        <ul class="layui-nav layui-layout-left">
            <li class="layui-nav-item" lay-unselect>
                <a ew-event="flexible" title="侧边伸缩"><i class="layui-icon layui-icon-shrink-right"></i></a>
            </li>
            <li class="layui-nav-item" lay-unselect>
                <a ew-event="refresh" title="刷新"><i class="layui-icon layui-icon-refresh-3"></i></a>
            </li>
        </ul>
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item" lay-unselect>
                <a href="/" target="_blank" title="网站首页"><i class="layui-icon layui-icon-home"></i> 网站首页</a>
            </li>
            <li class="layui-nav-item layui-hide-xs" lay-unselect>
                <a ew-event="fullScreen" title="全屏"><i class="layui-icon layui-icon-screen-full"></i> 全屏显示</a>
            </li>
            <li class="layui-nav-item" lay-unselect style="margin-right: 25px;">
                <a>
                    <i class="layui-icon layui-icon-user"></i>
                    <cite><?php echo htmlentities($userinfo['username']); ?> </cite>
                </a>
                <dl class="layui-nav-child">
                    <dd lay-unselect>
                        <a ew-href="<?php echo url('/Index/editPassword'); ?>">修改密码</a>
                    </dd>
                    <hr>
                    <dd lay-unselect>
                        <a ew-event="logout" data-url="<?php echo url('/Login/logout'); ?>">退出</a>
                    </dd>
                </dl>
            </li>
            <!--<li class="layui-nav-item" lay-unselect>
                <a ew-event="theme" title="主题"><i class="layui-icon layui-icon-more-vertical"></i></a>
            </li>-->

        </ul>
    </div>

    <!-- 侧边栏 -->
    <div class="layui-side">
        <div class="layui-side-scroll">
            <ul class="layui-nav layui-nav-tree arrow2" lay-filter="admin-side-nav" lay-accordion="true">
                <?php if(is_array($navbar) || $navbar instanceof \think\Collection || $navbar instanceof \think\Paginator): if( count($navbar)==0 ) : echo "" ;else: foreach($navbar as $key=>$v): ?>
                <li class="layui-nav-item">
                    <a <?php if(isset($v['children'])): ?>href="javascript:;"<?php else: ?>lay-href="<?php echo url($v['url']); ?>"<?php endif; ?>><i class="layui-icon <?php echo htmlentities($v['icon']); ?>"></i>&emsp;<cite><?php echo htmlentities($v['name']); ?></cite></a>
                    <?php if(isset($v['children'])): ?>
                    <dl class="layui-nav-child">
                        <?php if(is_array($v['children']) || $v['children'] instanceof \think\Collection || $v['children'] instanceof \think\Paginator): if( count($v['children'])==0 ) : echo "" ;else: foreach($v['children'] as $key=>$n1): ?>
                        <dd>
                            <a <?php if(isset($n1['children'])): ?>href="javascript:;"<?php else: ?>lay-href="<?php echo url($n1['url']); ?>"<?php endif; ?>><?php echo htmlentities($n1['name']); ?></a>
                            <?php if(isset($n1['children'])): ?>
                            <dl class="layui-nav-child">
                                <?php if(is_array($n1['children']) || $n1['children'] instanceof \think\Collection || $n1['children'] instanceof \think\Paginator): if( count($n1['children'])==0 ) : echo "" ;else: foreach($n1['children'] as $key=>$n2): ?>
                                <dd><a lay-href="<?php echo url($n2['url']); ?>"><?php echo htmlentities($n2['name']); ?></a></dd>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </dl>
                            <?php endif; ?>
                        </dd>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </dl>
                    <?php endif; ?>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>

    <!-- 主体部分 -->
    <div class="layui-body"></div>
    <!-- 底部 -->
    <div class="layui-footer">
        copyright © 2020 <a href="http://www.aixiaoka.net" target="_blank">爱销卡</a> all rights reserved .
        <span class="pull-right">Version 1.0.0</span>
    </div>
</div>

<!-- 加载动画 -->
<div class="page-loading">
    <div class="ball-loader">
        <span></span><span></span><span></span><span></span>
    </div>
</div>
<div id="audio"></div>
<!-- js部分 -->
<script type="text/javascript" src="/static/simple/hqui/libs/layui/layui.js"></script>
<script type="text/javascript" src="/static/simple/hqui/js/common.js?v=316"></script>
<script>
    layui.use(['index'], function () {
        var $ = layui.jquery;
        var index = layui.index;
        // 默认加载主页
        index.loadHome({
            menuPath: '<?php echo url("/Index/home"); ?>',
            menuName: '<i class="layui-icon layui-icon-home"> </i>'
        });
        $('.layui-body>.layui-tab[lay-filter="admin-pagetabs"]').attr('lay-autoRefresh', 'true');
    });
layui.use(['notice', 'jquery', 'layer','index'], function () {
        var notice = layui.notice;
        var layer = layui.layer;
        var $ = layui.jquery;
		var index = layui.index;

         // 初始化配置，同一样式只需要配置一次，非必须初始化，有默认配置
         notice.options = {
            closeButton:true,//显示关闭按钮
            debug:false,//启用debug
            positionClass:"toast-top-right",//弹出的位置,
            showDuration:"300",//显示的时间
            hideDuration:"1000",//消失的时间
            timeOut:"2000",//停留的时间
            extendedTimeOut:"1000",//控制时间
            showEasing:"swing",//显示时的动画缓冲方式
            hideEasing:"linear",//消失时的动画缓冲方式
            iconClass: 'toast-info', // 自定义图标，有内置，如不需要则传空 支持layui内置图标/自定义iconfont类名
            onclick: function(e){
				var str=e.currentTarget.innerText;
				console.log(e.currentTarget.innerText); // 点击关闭回调
				if(str.indexOf("订单") != -1 ){
				     $.post("<?php echo url('/Index/guanbi'); ?>",{tab:'Order'},function(){
						 $(".admin-iframe").attr("src","<?php echo url('/Order/index'); ?>").attr("lay-id","<?php echo url('/Order/index'); ?>");
						});
                  }else if(str.indexOf("API")!= -1){
				   $.post("<?php echo url('/Index/guanbi'); ?>",{tab:'Apiorder'},function(){
					    $(".admin-iframe").attr("src","<?php echo url('/Apiorder/index'); ?>").attr("lay-id","<?php echo url('/Apiorder/index'); ?>");
					 })
				  }else{
					  $.post("<?php echo url('/Index/guanbi'); ?>",{tab:'Withdraw'},function(){
						  $(".admin-iframe").attr("src","<?php echo url('/Cash/index'); ?>").attr("lay-id","<?php echo url('/Cash/index'); ?>");  
					 })
               }				  
			}
        };
		
        window.setInterval(function () {
		 $.post("<?php echo url('/Index/ssedistill'); ?>",function(e){
			   if(e.order>0){
			      $("#audio").html('<audio id="chatAudio"><source src="/static/simple/hqui/module/notice/2.wav" type="audio/wav"></audio>');
                  $('#chatAudio')[0].play();
				  notice.info("新提交订单" + e.order + "笔","订单提醒",12);
			   }else  if(e.api>0){
			      $("#audio").html('<audio id="chatAudio"><source src="/static/simple/hqui/module/notice/3.wav" type="audio/wav"></audio>');
                  $('#chatAudio')[0].play();
				  notice.info("API" + e.api + "笔","API提醒",12);
			   }else if(e.cash>0){
			      $("#audio").html('<audio id="chatAudio"><source src="/static/simple/hqui/module/notice/1.wav" type="audio/wav"></audio>');
                  $('#chatAudio')[0].play();
				  notice.success("待处理提现" + e.cash + "笔","提现提醒");
			   }
		 })
        },3000);
    });
   
</script>
</body>
</html>