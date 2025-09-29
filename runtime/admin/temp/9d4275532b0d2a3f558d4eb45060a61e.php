<?php /*a:2:{s:57:"/www/wwwroot/ka1.y9fu.com/app/admin/view/index/home.phtml";i:1600139160;s:51:"/www/wwwroot/ka1.y9fu.com/app/admin/view/base.phtml";i:1602325784;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>点卡综合后台管理</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/static/simple/hqui/libs/layui/css/layui.css"/>
    <link rel="stylesheet" href="/static/simple/hqui/module/admin.css?v=316"/>
  <link rel="stylesheet" href="/static/simple/css/fonts.css">
  <link rel="stylesheet" href="/static/simple/css/base.css">
  
<link rel="stylesheet" href="/static/simple/css/admin.css">
<style>
#tf{
 width: 80%;
    float: left;
    margin-top: 8px;
}
#tf h3, #tf cite, #cf h3, #cf cite{
color:#FFF
}
#bf{
    width: 80%;
    float: left;
    margin-top: 8px;
}

#cf{
    width: 40%;
    float: left;
    margin-top: 8px;
	margin-right:20px
}
#fft h3,#fft cite{
color:#FFF
}
#liw{
  width:50%
}
@media screen and (min-width: 992px){
	#liw{
	 width:12.5%
	}
}
.layui-col-md2{
	width:20%;
	    min-width: 200px;
}
.x-admin-backlog-body p cite{
	font-size:18px
}
</style>

</head>
<body>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        
   <div class="layui-col-md8">
      <div class="layui-row layui-col-space15">
        <div class="layui-col-md6">
          <div class="layui-card">
            <div class="layui-card-header">快捷方式</div>
            <div class="layui-card-body">
              
              <div class="layui-carousel layadmin-carousel layadmin-shortcut" lay-anim="" lay-indicator="inside" lay-arrow="none" style="width: 100%; height: 280px;">
                <div carousel-item="">
                  <ul class="layui-row layui-col-space10 layui-this">
				      <li class="layui-col-xs3">
                        <a ew-href="<?php echo url('/user/index'); ?>">
                          <i class="layui-icon layui-icon-user"></i>
                          <cite>用户管理</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a ew-href="<?php echo url('/Cash/index'); ?>">
                          <i class="layui-icon layui-icon-console"></i>
                          <cite>提现审核</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a ew-href="<?php echo url('/UserAuth/index'); ?>">
                          <i class="layui-icon layui-icon-chart"></i>
                          <cite>实名认证</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a ew-href="<?php echo url('/Order/index'); ?>">
                          <i class="layui-icon layui-icon-template-1"></i>
                          <cite>点卡订单</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a ew-href="<?php echo url('/Apiorder/index'); ?>">
                          <i class="layui-icon layui-icon-chat"></i>
                          <cite>企业订单</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a ew-href="<?php echo url('/Card/index'); ?>">
                          <i class="layui-icon layui-icon-find-fill"></i>
                          <cite>接口管理</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a ew-href="<?php echo url('/Card/index'); ?>">
                          <i class="layui-icon layui-icon-survey"></i>
                          <cite>卡类管理</cite>
                        </a>
                      </li>
                      
                      <li class="layui-col-xs3">
                        <a ew-href="<?php echo url('/Config/param'); ?>">
                          <i class="layui-icon layui-icon-set"></i>
                          <cite>参数设置</cite>
                        </a>
                      </li>
                    </ul>
                    
                </div>
              <!-- <div class="layui-carousel-ind"><ul><li class="layui-this"></li><li></li></ul></div> --><button class="layui-icon layui-carousel-arrow" lay-type="sub"></button><button class="layui-icon layui-carousel-arrow" lay-type="add"></button></div>
              
            </div>
          </div>
        </div>
        <div class="layui-col-md6">
          <div class="layui-card">
            <div class="layui-card-header">待办事项</div>
            <div class="layui-card-body">

              <div class="layui-carousel layadmin-carousel layadmin-backlog" lay-anim="" lay-indicator="inside" lay-arrow="none" style="width: 100%; height: 280px;">
                <div carousel-item="">
                  <ul class="layui-row layui-col-space10 layui-this">
                    <li class="layui-col-xs6">
                      <a ew-href="<?php echo url('/UserAuth/index'); ?>" class="layadmin-backlog-body">
                        <h3>实名待审</h3>
                        <p><cite><?php echo htmlentities($da['real']); ?></cite></p>
                      </a>
                    </li>
                    <li class="layui-col-xs6">
                      <a ew-href="<?php echo url('/Cash/index'); ?>" class="layadmin-backlog-body">
                        <h3>提现待审</h3>
                        <p><cite><?php echo htmlentities($da['cash']); ?></cite></p>
                      </a>
                    </li>
                    <li class="layui-col-xs6">
                      <a ew-href="<?php echo url('/Order/index'); ?>" class="layadmin-backlog-body">
                        <h3>订单待审</h3>
                        <p><cite><?php echo htmlentities($da['order']); ?></cite></p>
                      </a>
                    </li>
                    <li class="layui-col-xs6">
                      <a ew-href="<?php echo url('/Apiorder/index'); ?>" class="layadmin-backlog-body">
                        <h3>API待审</h3>
                        <p><cite><?php echo htmlentities($da['api']); ?></cite></p>
                      </a>
                    </li>
                  </ul>
                </div>
              <!--<div class="layui-carousel-ind"><ul><li class="layui-this"></li><li></li></ul></div>--><button class="layui-icon layui-carousel-arrow" lay-type="sub"></button><button class="layui-icon layui-carousel-arrow" lay-type="add"></button></div>
            </div>
          </div>
        </div>
		<div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-header">数据统计</div>
                        <div class="layui-card-body ">
                            <ul class="layui-row layui-col-space10 layui-this x-admin-carousel x-admin-backlog">
							 <li class="layui-col-md2 layui-col-xs6">
                                   <a href="javascript:;" class="x-admin-backlog-body" id="tf" style="background:#ff5722">
                                        <h3>总会员</h3>
                                        <p>
                                            <cite><?php echo htmlentities($f['user']); ?></cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body" id="tf" style="background:#1e9fff">
                                        <h3>销卡总计</h3>
                                        <p>
                                            <cite>￥<?php echo htmlentities($f['card_num']); ?>/<?php echo htmlentities($f['card_count']); ?>笔</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body" id="tf" style="background:#32c5d2">
                                        <h3>成功总计</h3>
                                        <p>
                                            <cite>￥<?php echo htmlentities($f['secc_num']); ?>/<?php echo htmlentities($f['secc_count']); ?>笔</cite></p>
                                    </a>
									
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body" id="tf" style="background:#8E44AD">
                                        <h3>失败总计</h3>
                                        <p>
                                            <cite>￥<?php echo htmlentities($f['err_num']); ?>/<?php echo htmlentities($f['err_count']); ?>笔</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body" id="tf" style="background:#322ece">
                                        <h3>利润总计</h3>
                                        <p>
                                            <cite>￥<?php echo htmlentities($f['profit']); ?></cite></p>
                                    </a>
                                </li>
                               
                                
                            </ul>
                        </div>
                    </div>
                </div>
				<div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-header">今日数据统计</div>
                        <div class="layui-card-body ">
                            <ul class="layui-row layui-col-space10 layui-this x-admin-carousel x-admin-backlog">
							<li class="layui-col-md2 layui-col-xs6">
                                   <a href="javascript:;" class="x-admin-backlog-body" id="bf" >
                                        <h3 style="color:#ff5722">今日注册</h3>
                                        <p>
                                            <cite style="color:#ff5722"><?php echo htmlentities($f['d_user']); ?></cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body" id="bf">
                                        <h3 style="color:#1e9fff">销卡总计</h3>
                                        <p>
                                            <cite style="color:#1e9fff">￥<?php echo htmlentities($f['d_card_num']); ?>/<?php echo htmlentities($f['d_card_count']); ?>笔</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body" id="bf">
                                        <h3 style="color:#32c5d2">成功总计</h3>
                                        <p>
                                            <cite style="color:#32c5d2">￥<?php echo htmlentities($f['d_secc_num']); ?>/<?php echo htmlentities($f['d_secc_count']); ?>笔</cite></p>
                                    </a>
									
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body" id="bf" >
                                        <h3 style="color:#8E44AD">失败总计</h3>
                                        <p>
                                            <cite style="color:#8E44AD">￥<?php echo htmlentities($f['d_err_num']); ?>/<?php echo htmlentities($f['d_err_count']); ?>笔</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body" id="bf" >
                                        <h3 style="color:#322ece">利润总计</h3>
                                        <p>
                                            <cite style="color:#322ece">￥<?php echo htmlentities($f['d_profit']); ?></cite></p>
                                    </a>
                                </li>
                               
                                
                            </ul>
                        </div>
                    </div>
                </div>
        <div class="layui-col-md12">
          <div class="layui-card">
                        <div class="layui-card-header">一月数据统计</div>
                        <div class="layui-card-body" style="min-height: 280px;">
                            <div id="main1" class="layui-col-sm12" style="height: 300px;"></div>

                        </div>
                    </div>
        </div>
		<!-- <div class="layui-col-md12">
              <div class="layui-card">
                        <div class="layui-card-header">网站流量统计</div>
                        <div class="layui-card-body" style="min-height: 280px;">
                            <div id="main2" class="layui-col-sm12" style="height: 300px;"></div>

                        </div>
                    </div>
              
         </div> -->
      </div>
    </div>
	<div class="layui-col-md4">
      <div class="layui-card">
        <div class="layui-card-header">版本信息</div>
        <div class="layui-card-body layui-text">
          <table class="layui-table">
            <colgroup>
              <col width="100">
              <col>
            </colgroup>
            <tbody>
              <tr>
                <td>当前版本</td>
                <td>
                  <script type="text/html" template="">
                  </script> v1.4.0 pro
                  <a href="javascript:;" ew-href="<?php echo url('/Upsystem/index'); ?>" layadmin-event="update" style="padding-left: 5px;">检查更新</a>
                </td>
              </tr>
			  <tr>
                <td>操作系统</td>
                <td>
                  <script type="text/html" template="">
                  </script> <?php echo htmlentities($server['os']); ?>
                </td>
              </tr>
			   <tr>
                <td>PHP版本</td>
                <td>
                  <script type="text/html" template="">
                  </script> <?php echo htmlentities($server['version']); ?>
                </td>
              </tr>
              <tr>
                <td>基于框架</td>
                <td>
                  <script type="text/html" template="">
      
                  </script> ThinkPHP 6.1
               </td>
              </tr>
              <tr>
                <td>主要特色</td>
                <td>响应式 / 清爽 / 极简</td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>
	  <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-header">API数据统计</div>
                        <div class="layui-card-body ">
                            <ul class="layui-row layui-col-space10 layui-this x-admin-carousel x-admin-backlog">
                                <li class="layui-col-md2 layui-col-xs6" style="width: 100%;">
                                    <a href="javascript:;" class="x-admin-backlog-body" id="cf" style="background:#ff5722">
                                        <h3 >销卡总计</h3>
                                        <p>
                                            <cite >￥<?php echo htmlentities($ff['card_num']); ?>/<?php echo htmlentities($ff['card_count']); ?>笔</cite></p>
                                    </a>
									<a href="javascript:;" class="x-admin-backlog-body" id="cf">
                                        <h3 style="color:#1e9fff">今日销卡</h3>
                                        <p>
                                            <cite style="color:#1e9fff">￥<?php echo htmlentities($ff['d_card_num']); ?>/<?php echo htmlentities($ff['d_card_count']); ?>笔</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6" style="width: 100%;">
                                    <a href="javascript:;" class="x-admin-backlog-body" id="cf" style="background:#32c5d2">
                                        <h3>成功总计</h3>
                                        <p>
                                            <cite>￥<?php echo htmlentities($ff['secc_num']); ?>/<?php echo htmlentities($ff['secc_count']); ?>笔</cite></p>
                                    </a>
									 <a href="javascript:;" class="x-admin-backlog-body" id="cf">
                                        <h3 style="color:#32c5d2">今日成功</h3>
                                        <p>
                                            <cite style="color:#32c5d2">￥<?php echo htmlentities($ff['d_secc_num']); ?>/<?php echo htmlentities($ff['d_secc_count']); ?>笔</cite></p>
                                    </a>
									
                                </li>
                                <li class="layui-col-md2 layui-col-xs6" style="width: 100%;">
                                    <a href="javascript:;" class="x-admin-backlog-body" id="cf" style="background:#8E44AD" >
                                        <h3>失败总计</h3>
                                        <p>
                                            <cite>￥<?php echo htmlentities($ff['err_num']); ?>/<?php echo htmlentities($ff['err_count']); ?>笔</cite></p>
                                    </a>
									<a href="javascript:;" class="x-admin-backlog-body" id="cf" >
                                        <h3 style="color:#8E44AD">今日失败</h3>
                                        <p>
                                            <cite style="color:#8E44AD">￥<?php echo htmlentities($ff['d_err_num']); ?>/<?php echo htmlentities($ff['d_err_count']); ?>笔</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6" style="width: 100%;">
                                    <a href="javascript:;" class="x-admin-backlog-body" id="cf" style="background:#322ece" >
                                        <h3>利润总计</h3>
                                        <p>
                                            <cite>￥<?php echo htmlentities($ff['profit']); ?></cite></p>
                                    </a>
									<a href="javascript:;" class="x-admin-backlog-body" id="cf" >
                                        <h3 style="color:#322ece">今日利润</h3>
                                        <p>
                                            <cite style="color:#322ece">￥<?php echo htmlentities($ff['d_profit']); ?></cite></p>
                                    </a>
                                </li>
                               
                                
                            </ul>
                        </div>
                    </div>
                </div>
    </div>
	<style id="LAY_layadmin_theme">.layui-side-menu,.layadmin-pagetabs .layui-tab-title li:after,.layadmin-pagetabs .layui-tab-title li.layui-this:after,.layui-layer-admin .layui-layer-title,.layadmin-side-shrink .layui-side-menu .layui-nav>.layui-nav-item>.layui-nav-child{background-color:#20222A !important;}.layui-nav-tree .layui-this,.layui-nav-tree .layui-this>a,.layui-nav-tree .layui-nav-child dd.layui-this,.layui-nav-tree .layui-nav-child dd.layui-this a{background-color:#009688 !important;}.layui-layout-admin .layui-logo{background-color:#20222A !important;}</style>

    </div>
</div>
<script>
var imagea="<?php echo url('/uploads/uploadImage'); ?>",imageb="<?php echo url('/uploads/uploadImage'); ?>",upfile="<?php echo url('/uploads/upFile'); ?>",Video="<?php echo url('/uploads/uploadVideo'); ?>",imagec="<?php echo url('/uploads/uploadImage'); ?>";
</script>
<script type="text/javascript" src="/static/simple/hqui/libs/layui/layui.all.js?v=15"></script>
<script type="text/javascript" src="/static/simple/js/jquery.min.js?v=11"></script>
<script type="text/javascript" src="/static/simple/js/layui.base.js?v=80"></script>
<script type="text/javascript" src="/static/simple/hqui/js/common.js?v=317"></script>



<script src="/static/simple/hqui/libs/echarts/echarts.min.js"></script>
<script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        
		$.post("<?php echo url('/index/getDa'); ?>",{},function(e){
		       // 指定图表的配置项和数据
			   var myChart = echarts.init(document.getElementById('main1'));
			var option = {
				grid: {
					top: '15%',
					right: '1%',
					left: '1%',
					bottom: '5%',
					containLabel: true
				},
				tooltip: {
					trigger: 'axis'
				},
				xAxis: {
					type: 'category',
					data: e.data.t
				},
				yAxis: {
					type: 'value'
				},
				legend: {
					data: ['提现','订单','API','利润']
				},
				series: [{
					name:'提现',
					data: e.data.user,
					type: 'line',
					itemStyle: {
						normal: {
							areaStyle: {
								type: "default"
							}
						}
					},
					smooth: true
				},{
					name:'订单',
					data: e.data.rech,
					type: 'line',
					itemStyle: {
						normal: {
							areaStyle: {
								type: "default"
							}
						}
					},
					smooth: true
				},{
					name:'API',
					data: e.data.pay,
					type: 'line',
					itemStyle: {
						normal: {
							areaStyle: {
								type: "default"
							}
						}
					},
					smooth: true
				},{
					name:'利润',
					data: e.data.lirun,
					type: 'line',
					itemStyle: {
						normal: {
							areaStyle: {
								type: "default"
							}
						}
					},
					smooth: true
				}]
			};
			// 使用刚指定的配置项和数据显示图表。
			myChart.setOption(option);
			});
	$.post("<?php echo url('/index/getDa'); ?>",{},function(e){
			var myCharta = echarts.init(document.getElementById('main2'));
			var opa={
            title: {
                text: "今日流量趋势",
                x: "center",
                textStyle: {
                    fontSize: 14
                }
            },
            tooltip: {
                trigger: "axis"
            },
            legend: {
                data: ["", ""]
            },
            xAxis: [{
                type: "category",
                boundaryGap: !1,
                data: ["06:00", "06:30", "07:00", "07:30", "08:00", "08:30", "09:00", "09:30", "10:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30", "18:00", "18:30", "19:00", "19:30", "20:00", "20:30", "21:00", "21:30", "22:00", "22:30", "23:00", "23:30"]
            }],
            yAxis: [{
                type: "value"
            }],
            series: [{
                name: "PV",
                type: "line",
                smooth: !0,
                itemStyle: {
                    normal: {
                        areaStyle: {
                            type: "default"
                        }
                    }
                },
                data: [111, 222, 333, 444, 555, 666, 3333, 33333, 55555, 66666, 33333, 3333, 6666, 11888, 26666, 38888, 56666, 42222, 39999, 28888, 17777, 9666, 6555, 5555, 3333, 2222, 3111, 6999, 5888, 2777, 1666, 999, 888, 777]
            }, {
                name: "UV",
                type: "line",
                smooth: !0,
                itemStyle: {
                    normal: {
                        areaStyle: {
                            type: "default"
                        }
                    }
                },
                data: [11, 22, 33, 44, 55, 66, 333, 3333, 5555, 12666, 3333, 333, 666, 1188, 2666, 3888, 6666, 4222, 3999, 2888, 1777, 966, 655, 555, 333, 222, 311, 699, 588, 277, 166, 99, 88, 77]
            }]
        };
		myCharta.setOption(opa);
			});
		layui.use(['index'], function () {
				var $ = layui.jquery;
				var index = layui.index;
			});
</script>


</body>
</html>