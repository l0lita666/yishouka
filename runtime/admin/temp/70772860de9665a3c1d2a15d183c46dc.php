<?php /*a:2:{s:59:"/www/wwwroot/www.ssyd.fun/app/admin/view/tongji/index.phtml";i:1600139160;s:51:"/www/wwwroot/www.ssyd.fun/app/admin/view/base.phtml";i:1602325784;}*/ ?>
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
  
</head>
<body>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        
<div class="layui-card">
	<div class="layui-fluid">
	<div class="layui-row layui-col-space15">
	<div class="layui-col-md12">
	<div class="layui-card">
		<div class="layui-tab" lay-filter="test1">
		  <div class="layui-tab-content">
			<div class="layui-tab-item layui-show">
			  <div class="layui-card-body ">
				<form class="layui-form layui-col-space5" >
							  <div class="layui-inline layui-show-xs-block">
                                    <input type="text" name="uid" placeholder="SHOPID" autocomplete="off" class="layui-input">
								</div>
								<div class="layui-inline layui-show-xs-block">
								<input type="text" name="name" placeholder="用户名|手机号" autocomplete="off" class="layui-input">
								</div>
								<div class="layui-inline layui-show-xs-block">
                                <input class="layui-input"  autocomplete="off" placeholder="开始日期" name="start" id="start">
								</div>
								<div class="layui-inline layui-show-xs-block">
									<input class="layui-input"  autocomplete="off" placeholder="截止日期" name="end" id="end">
								</div>
                                <div class="layui-inline layui-show-xs-block">
                                    <button class="layui-btn" type="button" lay-submit="" lay-filter="sreach" lay-skin="select" lay-filter="type">
                                        <i class="layui-icon">&#xe615;</i></button>
									<button class="layui-btn layui-btn-danger" type="button" lay-submit="" lay-filter="all" lay-skin="select" lay-filter="type">
                                        全部</button>
                                </div>
								</form>
                        </div>
                        <div class="layui-card-body ">
                            <table class="layui-table" id="mlist" lay-filter="mlist">
                                <thead>
                                    <tr>
                                </thead>
                            </table>
                        </div>
			</div>
			
		  </div>
		</div>
                    </div>
                </div>
            </div>
        </div>
		</div>

    </div>
</div>
<script>
var imagea="<?php echo url('/uploads/uploadImage'); ?>",imageb="<?php echo url('/uploads/uploadImage'); ?>",upfile="<?php echo url('/uploads/upFile'); ?>",Video="<?php echo url('/uploads/uploadVideo'); ?>",imagec="<?php echo url('/uploads/uploadImage'); ?>";
</script>
<script type="text/javascript" src="/static/simple/hqui/libs/layui/layui.all.js?v=15"></script>
<script type="text/javascript" src="/static/simple/js/jquery.min.js?v=11"></script>
<script type="text/javascript" src="/static/simple/js/layui.base.js?v=80"></script>
<script type="text/javascript" src="/static/simple/hqui/js/common.js?v=317"></script>


<script type="text/html" id="lirun">
      <p class="layui-bg-red">{{d.lirun}}</p>
    </script>
	<script type="text/html" id="action">
	<button class="layui-btn layui-btn-danger"  lay-event="del">删除</button>
	</script>
    <script>
	layui.use(['table','form','laydate','element'], function() {
        var table = layui.table,form = layui.form, $ = layui.jquery,laydate = layui.laydate,element = layui.element;;
        tableIn = table.render({
            elem: '#mlist',
            url: "<?php echo url('/tongji/index'); ?>",
            method: 'post',
			page:true,
			totalRow:true,
            cols: [[
			    {type: 'checkbox',width:30,minWidth:30},
				{field:'class',title:"通道", align: 'center', width:180,totalRowText: '合计：'},
			    {field:'cid',title: '订单总数',align: 'center',totalRow: true},
				{field:'money',title: '提交面额',align: 'center',totalRow: true},
				{field:'amt',title: '成功面额',align: 'center',totalRow: true},
				{field:'su',title: '用户金额',align: 'center',totalRow: true},
				{field:'supr',title: '系统金额',align: 'center',totalRow: true},
				{field:'spr',title: '获利金额',align: 'center',totalRow: true}
            ]],
			limit:15,
			limits:[10,20,50,60],
			parseData: function(res){ //res 即为原始返回的数据
                return {
                  "code": res.code, //解析接口状态
                  "msg": res.msg, //解析提示文本
                  "count": res.data.total, //解析数据长度
                  "data": res.data.data //解析数据列表
                };
            }
        });		
		element.on('tab(test1)', function(){
			$("#start").val('');
			$("#end").val('');
		  });
		form.on('submit(sreach)', function(obj){
            loading =layer.load(1, {shade: [0.1,'#fff']});
            var st=$("#start").val(),se=$("#end").val();
			var index = layer.load(3, {
					  shade: [0.1,'#fff'] //0.1透明度的白色背景
					});
                 tableIn.reload({
				     url: "<?php echo url('/tongji/index'); ?>",
					page:{curr:1},
                     where:{
						 STime:st,
						 ETime:se,
						 Uid:$("input[name=uid]").val(),
						 Name:$("input[name=name]").val()
                     }
                 });
				 layer.close(index);
        });
		form.on('submit(all)', function(obj){
            loading =layer.load(1, {shade: [0.1,'#fff']});
            $("#start").val('');
			$("#end").val('');
			$("input[name=uid]").val('');
			$("input[name=name]").val('');
			var index = layer.load(3, {
					  shade: [0.1,'#fff'] //0.1透明度的白色背景
					});
                 tableIn.reload({
				     url: "<?php echo url('/tongji/index'); ?>",
					 page:{curr:1},
                     where:{
						 STime:'',
						 ETime:'',
						 Uid:'',
						 Name:''
                     }
                 });
				 layer.close(index);
        });
		var nowTime=new Date();    
		var startTime=laydate.render({
			elem:'#start',
			type:'datetime',
			btns: ['confirm'],
			max:'nowTime',//默认最大值为当前日期
			done:function(value,date){
				endTime.config.min={    	    		
					year:date.year,
					month:date.month-1,//关键
					date:date.date,
					hours:date.hours,
					minutes:date.minutes,
					seconds:date.seconds
				};
				
			}
		})
		var endTime=laydate.render({
			elem:'#end',
			type:'datetime',
			btns: ['confirm'],
			max:'nowTime',
			done:function(value,date){   	   
				startTime.config.max={
						year:date.year,
						month:date.month-1,//关键
						date:date.date,
						hours:date.hours,
						minutes:date.minutes,
						seconds:date.seconds
				}
				
			}
		})
      });
	  
    </script>


</body>
</html>