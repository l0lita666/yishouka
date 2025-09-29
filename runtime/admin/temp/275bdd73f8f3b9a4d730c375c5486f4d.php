<?php /*a:2:{s:61:"/www/wwwroot/www.ssyd.fun/app/admin/view/apiorder/index.phtml";i:1600917314;s:51:"/www/wwwroot/www.ssyd.fun/app/admin/view/base.phtml";i:1602325784;}*/ ?>
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
        
<style>
.layui-word-a{
	margin-bottom: 1px;
}

.layui-word-a:before {
    width: 19px;
    content: "系";
    color: #FFF;
    display: inline-block;
    margin-right: 3px;
    padding: 2px;
    text-align: center;
    border-color: #198bfc;
    background-color: #198bfc;
    box-shadow: 1px 3px 13px rgba(25,139,252,.2);
    border-radius: 3px;
}
.layui-word:before {
    border-color: #01cf75;
    background-color: #01cf75;
    box-shadow: 1px 3px 13px rgba(1,207,117,.21);
    width: 19px;
    content: "商";
    color: #FFF;
    display: inline-block;
    margin-right: 3px;
    padding: 2px;
    text-align: center;
    border-radius: 3px;
}
.layui-table-cell {
    padding: 0 5px;
</style>
<div class="layui-card">
    <div class="layui-card-body">
	     <div class="layui-card-body ">
								
							  <form class="layui-form layui-col-space5" >
							  <?php if($id == '1'): ?>
							    <div class="layui-inline layui-show-xs-block" id="caoji" style="width: 100%;">
                                    <?php foreach($admin as $pp): ?>
									<button class="layui-btn layui-btn-normal ajax-batch" href="<?php echo url('/Apiorder/zhipai',['uid'=>$pp['id']]); ?>" data-tab="tableList" data-tips="指派后不能更改，确定操作吗?" type="button"   >指派给用户<?php echo htmlentities($pp['username']); ?></button>
									<?php endforeach; ?>
                                </div>
							  <?php endif; ?>
							  <div class="layui-inline layui-show-xs-block">
									<button class="layui-btn layui-btn-danger ajax-batch" type="button" href="<?php echo url('/Apiorder/batchOrder',['type'=>'del']); ?>" data-tips="确定批量删除数据吗?" data-tab="tableList" ><i class="layui-icon"></i>批量删除</button>
									<button class="layui-btn layui-btn-normal ajax-batch" type="button" data-tips="确定批量重发订单吗?" data-tab="tableList" href="<?php echo url('/Apiorder/batchOrder',['type'=>'rest']); ?>">批量重试</button>
										<button class="layui-btn layui-btn-danger ajax-batch" type="button" data-tips="确定批量成功订单吗?" data-tab="tableList" href="<?php echo url('/Apiorder/batchOrder',['type'=>'success']); ?>">批量成功</button>
                              </div>
								<div class="layui-inline layui-show-xs-block">
                                <input class="layui-input"  autocomplete="off" placeholder="开始日期" name="starttime" id="starttime">
								</div>
								<div class="layui-inline layui-show-xs-block">
									<input class="layui-input"  autocomplete="off" placeholder="截止日期" name="endtime" id="endtime">
								</div>
								<div class="layui-inline layui-show-xs-block">
								 <select name="type" id="selt" lay-skin="select">
									 <option value="shopid">SHOPID</option>
									 <option value="orderno">系统订单号</option>
									 <option value="tmporder">商户订单号</option>
									 <option value="money">提交面值</option>
									 <option value="settle_amt">成功面值</option>
									 <option value="card_no">卡号</option>
									 <option value="card_key">卡密</option>
								 </select>
                                </div>
								<div class="layui-inline layui-show-xs-block">
								<input type="hidden" id="typen" value="">
								<input type="hidden" id="money" value="">
                                    <input type="text" name="username" placeholder="搜索内容" autocomplete="off" class="layui-input">
								</div>
							
								<input type="hidden" value="" name="state" id="seltt">
                                <div class="layui-inline layui-show-xs-block">
                                    <button class="layui-btn" type="button" lay-submit="" lay-filter="sreach" lay-skin="select" lay-filter="type">
                                        <i class="layui-icon">&#xe615;</i></button>
										<button class="layui-btn" type="button" id="printt" lay-event="LAYTABLE_EXPORT">
                                        <i class="layui-icon layui-icon-export">  </i></button>
                                        <button class="layui-btn" type="button" id="printno" lay-event="LAYTABLE_EXPORT">
                                        导出卡号卡密</button>
                                        <button class="layui-btn layui-btn-danger" lay-submit=""  lay-filter="share" id="share" type="button">批量复制</button>
                                </div>
								<div class="layui-btn-group layui-show-xs-block" id="allbutton">
								   <button class="layui-btn" style="margin-bottom:8px" type="button" id="typeClick" lay-type="" >全 部</button>
								   <?php if(is_array($li) || $li instanceof \think\Collection || $li instanceof \think\Paginator): $i = 0; $__LIST__ = $li;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?>
                                    <button class="layui-btn layui-btn-primary" style="margin-bottom:8px" type="button" id="typeClick" lay-type="<?php echo htmlentities($p['type']); ?>" ><?php echo htmlentities($p['title']); ?></button> 
                                   <?php endforeach; endif; else: echo "" ;endif; ?>									
                                </div>
                                 <div class="layui-inline layui-show-xs-block" id="dorder">
                                        <button class="layui-btn layui-btn-default" type="button" id="sall" lay-type="0">全部订单</button>
								     	<button class="layui-btn layui-btn-primary" type="button" id="sall" lay-type="1">等待受理</button>
										<button class="layui-btn layui-btn-primary" type="button" id="sall" lay-type="2">正在处理</button>
								     	<button class="layui-btn layui-btn-primary" type="button" id="sall" lay-type="3">成功订单</button>
								     	<button class="layui-btn layui-btn-primary" type="button" id="sall" lay-type="4">失败订单</button>
                                </div>
								</form>
								<input type="hidden" id="font-primary" >
                        </div>
		<table id="tableList" lay-filter="tableList"></table>
    </div>
</div>
	<script type="text/html" id="number">
	   {{#  if(d.iscode > 0){ }}
	    <img src="{{d.card_no}}"  tb-img/>
	   {{#  } else { }}
	   <p id="share" lay-event="share">{{d.card_no}}</br>{{d.card_key}}</br>{{d.seccode}}</p>
	   {{# }}}
	</script>
	<script type="text/html" id="caoz">
		<div class="layui-btn-group">
		<button class="layui-btn ajax-iframe" style="background-color: #ffb800" href="<?php echo url('/Apiorder/details'); ?>?id={{d.id}}" data-width="900px" data-height="550px" >详情</button>
		<button class="layui-btn ajax-iframe" href="<?php echo url('/Apiorder/peifu'); ?>?id={{d.id}}" data-width="850px" data-height="500px" >赔付</button>
		<button class="layui-btn layui-btn-normal ajax-action"  href="<?php echo url('/Apiorder/findorder'); ?>?id={{d.id}}">查询</button>
		<button class="layui-btn layui-btn-danger ajax-action" style="background-color: #198bfc;" href="<?php echo url('/Apiorder/xiafa'); ?>?id={{d.id}}">下发</button>
		<button class="layui-btn layui-btn-danger ajax-tips" data-tips="确定删除该条数据吗?" href="<?php echo url('/Apiorder/del'); ?>?id={{d.id}}">删除</button>
		</div>
   </script>
   <script type="text/html" id="idd">
   <div class="layui-form-item" style="margin-bottom:2px">
    <div class="layui-form-mid layui-word-a" style="padding:1px !important">{{d.orderno}}</div>
   </div>
   <div class="layui-form-item" style="margin-bottom:2px">
    <div class="layui-form-mid layui-word" style="padding:1px !important">{{d.tmporder}}</div>
   </div>
     {{d.qian}}
   </script>
   <script type="text/html" id="but">
	   <p>{{d.shopid}}</p>
		 <button class="layui-btn layui-btn-normal ajax-tips" data-tips="确定执行成功操作?"  href="<?php echo url('/Apiorder/setStatus'); ?>?id={{d.id}}&type=success">成功</button>
		 <button class="layui-btn ajax-tips" data-tips="确定执行失败操作?"  href="<?php echo url('/Apiorder/setStatus'); ?>?id={{d.id}}&type=error">失败</button>
   </script>

    </div>
</div>
<script>
var imagea="<?php echo url('/uploads/uploadImage'); ?>",imageb="<?php echo url('/uploads/uploadImage'); ?>",upfile="<?php echo url('/uploads/upFile'); ?>",Video="<?php echo url('/uploads/uploadVideo'); ?>",imagec="<?php echo url('/uploads/uploadImage'); ?>";
</script>
<script type="text/javascript" src="/static/simple/hqui/libs/layui/layui.all.js?v=15"></script>
<script type="text/javascript" src="/static/simple/js/jquery.min.js?v=11"></script>
<script type="text/javascript" src="/static/simple/js/layui.base.js?v=80"></script>
<script type="text/javascript" src="/static/simple/hqui/js/common.js?v=317"></script>


<script src="/static/simple/js/clipboard.min.js"></script>
<script>
    layui.use(['layer', 'form', 'table', 'laydate'], function () {
        var $ = layui.jquery,layer = layui.layer,form = layui.form,table = layui.table,laydate=layui.laydate;
		var insTb = table.render({
            elem: '#tableList',
            url: "<?php echo url('/Apiorder/index'); ?>",
            page: true,
			//toolbar: '#toolbarDemo',开启头部工具
			//defaultToolbar: ['filter', 'exports'],
            limit:15,
            limits:[15,30,45,60,75,90],
            cellMinWidth: 100,
            cols: [[
                {field:'id',type: 'checkbox',width:30,minWidth:30},
				{toolbar: '#idd',title:"订单号", align: 'center', sort: true,width:180},
				{toolbar: '#but',title:"SHOPID", align: 'center', width:160},
			    {field:'title',title: '运营商',align: 'center',width:110,totalRowText: '合计：'},
				{title: '卡号/卡密',toolbar:'#number',align: 'left',sort: true,width:180},
					{field:'money',title: '提交面值',style:"color:#c60",align: 'center',width:100},
				{field:'amount',title: '用户结算',style:"color:#00a65a",align: 'center',totalRow: true,width:100},
				{field:'xitmoney',title:'平台结算',style:"color:#e60040",align:'center',totalRow: true,width:100},
				{field:'atime', align: 'center',title:'提交时间',width:120},
				{field:'state', title:'状态',align: 'center',width:100,sort: true},
				{field:'oper', align: 'center',title:'通道',width:100},
                {field:'remarks', align: 'center',title:'备注',width:140},
				{field:'tongzhi', align: 'center',title:'回掉通知',width:140},
				{align:'center',title:'操作',toolbar: '#caoz',width:320}
            ]],
            parseData: function(res){ //res 即为原始返回的数据
                return {
                  "code": res.code, //解析接口状态
                  "msg": res.msg, //解析提示文本
                  "count": res.data.total, //解析数据长度
                  "data": res.data.data //解析数据列表
                };
            }
        });
		var nowTime=new Date();    
		var startTime=laydate.render({
			elem:'#starttime',
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
			elem:'#endtime',
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
		$("#printt").click(function(){
					var name=$("input[name=username]").val();
					var kk=$("#selt").val(),st=$("#starttime").val(),se=$("#endtime").val();
					var state=$("#seltt").val(),cl=$("#typen").val();
					location.href="<?php echo url('/Apiorder/export'); ?>?name="+name+"&kk="+kk+"&st="+st+"&se="+se+"&state="+state+"&classa="+cl;
                    
		});
		$("#printno").click(function(){
					var name=$("input[name=username]").val();
					var kk=$("#selt").val(),st=$("#starttime").val(),se=$("#endtime").val();
					var state=$("#seltt").val(),cl=$("#typen").val();
					location.href="<?php echo url('/Order/export'); ?>?type=card&name="+name+"&kk="+kk+"&st="+st+"&se="+se+"&state="+state+"&classa="+cl;
                    
		});
        table.on('row(tableList)', function(obj){
		        var data = obj.data;
		        $("#font-primary").val("");
		    	var checkStatus = table.checkStatus("tableList"),str="";
                    $(checkStatus.data).each(function (i,o) {
                		str+=o.card_no+" "+o.card_key+"\n";
                    });
                    if($(this).find(".layui-form-checked").length==1){
    		            str+=data.card_no+" "+data.card_key+"\n";
    		        }else{
    		            str=str.replace(data.card_no+" "+data.card_key+"\n","");
    		        }
                $("#font-primary").val(str);
		})
		
		form.on('checkbox(layTableAllChoose)',function(data){
		        $("#font-primary").val("");
		        var data=table.cache.tableList;
		    	var checkStatus = table.checkStatus("tableList"),str="";
		    	if(checkStatus.data.length!=15){
                    $(data).each(function (i,o) {
                		str+=o.card_no+" "+o.card_key+"\n";
                    });
		    	}
                $("#font-primary").val(str);
		});
		
		 var clipboard1 = new ClipboardJS('#share', {
						text: function(trigger) {
						return $("#font-primary").val();
					  }
					});

        		clipboard1.on('success', function(e) {
        			console.log(e);
        			layer.msg((e.action=='copy'?'复制':'剪切')+'成功');
        		});
        		
        		clipboard1.on('error', function(e) {
        			layer.msg("内容为空");
        		});
	
		  form.on('submit(sreach)', function(obj){
            loading =layer.load(1, {shade: [0.1,'#fff']});
            var name=$("input[name=username]").val();
			var kk=$("#selt").val(),st=$("#starttime").val(),se=$("#endtime").val();
			var state=$("#seltt").val(),cl=$("#typen").val();
			var index = layer.load(3, {
					  shade: [0.1,'#fff'] //0.1透明度的白色背景
					});
                 insTb.reload({
					page:{curr:1
						 },
                     where:{
						 name:name,
						 kk:kk,
						 st:st,
						 se:se,
						 state:state,
						 classa:cl,
                     }
                 });
				 layer.close(index);
        });
		
		//卡类查询
		$("#allbutton").on("click","#typeClick",function(){
		    var e=$(this);
			e.siblings().addClass("layui-btn-primary");
			e.removeClass("layui-btn-primary");
			$("#typen").val(e.attr('lay-type'));
			loading =layer.load(1, {shade: [0.1,'#fff']});
            var name=$("input[name=username]").val();
			var kk=$("#selt").val(),st=$("#start").val(),se=$("#end").val();
			var state=$("#seltt").val(),cl=$("#typen").val();
			var index = layer.load(3, {
					  shade: [0.1,'#fff'] //0.1透明度的白色背景
					});
                 insTb.reload({
					page:{curr:1
						 },
                     where:{
						 name:name,
						 kk:kk,
						 st:st,
						 se:se,
						 state:state,
						 classa:cl,
                     }
                 });
				 layer.close(index);
		});
		//状态查询
		$("#dorder").on("click","#sall",function(){
		    var e=$(this);
			e.siblings().addClass("layui-btn-primary");
			e.removeClass("layui-btn-primary");
			$("#seltt").val(e.attr('lay-type'));
			loading =layer.load(1, {shade: [0.1,'#fff']});
            var name=$("input[name=username]").val();
			var kk=$("#selt").val(),st=$("#start").val(),se=$("#end").val();
			var state=$("#seltt").val(),cl=$("#typen").val();
			var index = layer.load(3, {
					  shade: [0.1,'#fff'] //0.1透明度的白色背景
					});
                 insTb.reload({
					page:{curr:1
						 },
                     where:{
						 name:name,
						 kk:kk,
						 st:st,
						 se:se,
						 state:state,
						 classa:cl,
                     }
                 });
				 layer.close(index);
		});
    });

</script>


</body>
</html>