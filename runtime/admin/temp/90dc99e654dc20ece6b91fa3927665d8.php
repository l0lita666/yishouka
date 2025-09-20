<?php /*a:2:{s:57:"/www/wwwroot/www.ssyd.fun/app/admin/view/user/index.phtml";i:1605091994;s:51:"/www/wwwroot/www.ssyd.fun/app/admin/view/base.phtml";i:1602325784;}*/ ?>
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
.layui-body-header.show {
    display: block;
}
.layui-form-switch{
	margin-top:0;
}
.lay-span{
	display: block;
    padding: 5px 5px;
    background: #FF5722;
    text-align: center;
    color: #fff;
    border-radius: 3px;
}
.layui-card .layui-card-body .layui-btn-group{
	margin-bottom:0;
}
.layui-card .layui-card-body .layui-table td{
	max-width:450px
}
</style>
<div class="layui-card">
    <div class="layui-card-body">
	    <div class="layui-inline layui-show-xs-block">
			<input type="text" name="username" placeholder="用户名|ID|手机号" autocomplete="off" class="layui-input">
		</div>
		<button class="layui-btn" lay-submit="" lay-filter="sreach" lay-skin="select"><i class="layui-icon"></i></button>
        <div class="layui-btn-group">
		    
            <a href="<?php echo url('/user/add',['shop_id' => input('shop_id')]); ?>" class="layui-btn ajax-iframe" data-width="600px" data-height="400px"><i class="fa fa-plus-circle"></i> 添加会员</a>
            <a href="<?php echo url('/user/export'); ?>" class="layui-btn layui-btn-primary"><i class="fa fa-file-excel-o"></i> 导出会员</a>
			
			<a href="javascript:void(0)" class="layui-btn layui-btn-danger">总余额：<?php echo htmlentities($money); ?></a>
        </div>
		
		<table id="tableList" lay-filter="tableList"></table>
    </div>
</div>
<script type="text/html" id="username">
    {{#  if(d.usernemr == "" | d.username==null){ }}未设置{{#  } else { }}{{d.username}}{{#  } }}
</script>
<script type="text/html" id="apilib">
     <input type="checkbox" name="apilib" lay-skin="switch" lay-filter="*" lay-text="开启|关闭" data-url="<?php echo url('/user/edit'); ?>?id={{d.id}}" {{d.apilib==1?'checked':''}}>
</script>
<script type="text/html" id="qqopenid">
    {{#  if(d.qqopenid == "" | d.qqopenid==null){ }}
    <span class="lay-span" style="background:#c2c2c2">未绑定</span>
	{{#  } else { }}
	<span class="lay-span" >已绑定</span>
	{{#  } }}
</script>
<script type="text/html" id="wxopenid">
    {{#  if(d.wxopenid == "" | d.wxopenid==null){ }}
    <span class="lay-span" style="background:#c2c2c2">未绑定</span>
	{{#  } else { }}
	<span class="lay-span" >已绑定</span>
	{{#  } }}
</script>
<script type="text/html" id="status">
     <input type="checkbox" name="status" lay-skin="switch" lay-filter="*" lay-text="正常|禁用" data-url="<?php echo url('/user/edit'); ?>?id={{d.id}}" {{d.status==1?'checked':''}}>
</script>
<script type="text/html" id="tableTBTrack">
   <div class="layui-btn-group">
		<button type="button" class="layui-btn" lay-event="bianji">编辑</button>
		<button type="button" class="layui-btn layui-btn-warm" lay-event="feilv">费率</button>
		<button type="button" class="layui-btn " lay-event="loginlog">登陆记录</button>
		<button type="button" class="layui-btn" style="background: #1e9fff;" lay-event="txlog">提现方式</button>
		<button type="button" class="layui-btn layui-btn-normal" lay-event="moneylog">资金记录</button>
		<button type="button" class="layui-btn layui-btn-danger" lay-event="del">删除</button>
		</div>
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


<script>
    layui.use(['layer', 'form', 'table', 'util', 'dropdown'], function () {
        var $ = layui.jquery;
        var layer = layui.layer;
        var form = layui.form;
        var table = layui.table;
        var util = layui.util;
        var admin = layui.admin;
        var dropdown = layui.dropdown;
		var insTb = table.render({
            elem: '#tableList',
            url: "<?php echo url('/User/index'); ?>",
            where:{id:$("input[name=field]").val()},
            page: true,
            limit:15,
            limits:[15,30,45,60,75,90],
            cellMinWidth: 100,
            cols: [[
                {type:'numbers',title:'#'},
                {field: 'shopid',align: 'center', sort: true, title: '商户ID',width:90},
                {templet:'#username', align: 'center', title: '用户名',minWidth:120},
				{field:'qq', align: 'center', title: '用户QQ',minWidth:120},
				{field:'retype', align: 'center', title: '认证类型'},
				{field: 'mobile', align: 'center', title: '手机号',width:120},
				{field: 'money', align: 'center', title: '余额',width:120},
				{field: 'assets', align: 'center', title: '下级',width:80},
				{field: 'last_login_ip', align: 'center', title: '登录IP',width:140},
				{align: 'center',  title: '注册时间',field:'create_time',width:160},
                {align: 'center',  title: 'API功能',templet:'#apilib'},
				{align: 'center',  title: 'QQ互联',templet:'#qqopenid'},
				{align: 'center',  title: '微信绑定',templet:'#wxopenid'},
				{align: 'center',  title: '状态',templet:'#status'},
                {align: 'center', toolbar: '#tableTBTrack', title: '操作',width: 530}
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
		
		 table.on('tool(tableList)', function(obj){ //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
			var data = obj.data //获得当前行数据
			,layEvent = obj.event; //获得 lay-event 对应的值
			switch(layEvent){
				case "bianji":
				  var one=openUrl("编辑会员",'600px','410px',"<?php echo Url('/user/edit'); ?>?id="+data.id);
				break;
				case "feilv":
				  var one=openUrl("编辑费率【"+data.username+"】",'880px','720px',"<?php echo Url('/user/feilv'); ?>?id="+data.shopid);
				break;
				case "loginlog":
				  var one=openUrl("登陆记录【"+data.username+"】",'980px','720px',"<?php echo Url('/user/log'); ?>?id="+data.shopid);
				break;
				case "txlog":
				  var one=openUrl("提现方式【"+data.username+"】",'1080px','720px',"<?php echo Url('/user/txlog'); ?>?id="+data.id);
				break;
				case "moneylog":
				   var one=openUrl("资金记录【"+data.username+"】",'880px','720px',"<?php echo Url('/user/moneylog'); ?>?id="+data.id);
				break;
				case "del":
				  layer.confirm('确定删除？', {
						icon: 3,
						title: '提示'
					}, function (index) {
						var index = layer.msg('删除中，请稍候', {
							icon: 16,
							time: false,
							shade: 0.3
						});
						$.ajax({
							url: "<?php echo Url('/user/del'); ?>?id="+data.id,
							type: 'post',
							dataType: 'json',
							success: function (result) {
								if (result.code === 1) {
									insTb.reload();
								}
								layer.close(index);
								layer.msg(result.msg);
							},
							error: function (xhr, state, errorThrown) {
								layer.close(index);
								layer.msg(state + '：' + errorThrown);
							}
						});
					});
				break;
			}
			function openUrl(title,width,height,url){
				var index = layer.open({
						title: title,
						type: 2,
						shadeClose:true,
						area: [width, height],
						content: url,
					})
				return index;
			}
		  });
		  form.on('submit(sreach)', function(obj){
            var name=$("input[name=username]").val();
			var index = layer.msg('查询中，请稍候', {
							icon: 16,
							time: false,
							shade: 0.3
						});
                 insTb.reload({
					page:{curr:1
						 },
                     where:{
						 shop_id:name
                     }
                 });
				 layer.close(index);
        });
    });

</script>


</body>
</html>