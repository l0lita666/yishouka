<?php /*a:2:{s:62:"/www/wwwroot/ka1.y9fu.com/app/admin/view/user_auth/index.phtml";i:1600940726;s:51:"/www/wwwroot/ka1.y9fu.com/app/admin/view/base.phtml";i:1602325784;}*/ ?>
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
			<input type="text" name="username" placeholder="商户ID" autocomplete="off" class="layui-input">
		</div>
		<button class="layui-btn" lay-submit="" lay-filter="sreach" lay-skin="select"><i class="layui-icon"></i></button>
		<table id="tableList" lay-filter="tableList"></table>
    </div>
</div>

<script type="text/html" id="hastype">
    {{#  if(d.hastype == 1){ }}
    <span class="lay-span" style="background:#1e9fff">人工审核</span>
	{{#  } else { }}
	<span class="lay-span" >API实名</span>
	{{#  } }}
</script>
<script type="text/html" id="idcard">
  {{#  if(d.hastype == 1){ }}
     <button type="button" class="layui-btn" lay-event="idcard">查看照片</button>
	 {{#  } else { }}
	<span class="lay-span" style="background:#c2c2c2">API未提</span>
	{{#  } }}
</script>
<script type="text/html" id="company">
    {{#  if(d.clas ==2){ }}
     <button type="button" class="layui-btn" lay-event="company">查看照片</button>
	{{#  } else { }}
	<span class="lay-span" style="background:#c2c2c2">个人未提</span>
	{{#  } }}
</script>
<script type="text/html" id="status">
     {{#  if(d.retype ==3){ }}
    <span class="lay-span" style="background:#c2c2c2">等待审核</span>
	{{#  } else if(d.retype ==4) { }}
	<span class="lay-span" style="background:#dc515f" >重新提交</span>
	{{#  } else { }}
	<span class="lay-span" style="background:#5fb878">实名通过</span>
	{{#  } }}
</script>
<script type="text/html" id="tableTBTrack">
   <div class="layui-btn-group">
		<button type="button" class="layui-btn" lay-event="bianji">通过</button>
		<button type="button" class="layui-btn layui-btn-warm" lay-event="rest">重提</button>
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
            url: "<?php echo url('/UserAuth/index'); ?>",
            where:{id:$("input[name=field]").val()},
            page: true,
            limit:15,
            limits:[15,30,45,60,75,90],
            cellMinWidth: 100,
            cols: [[
                {type:'numbers',title:'#'},
                {field: 'username',align: 'center', sort: true, title: '用户名',minWidth:120},
				{field:'rename', align: 'center', title: '认证类型'},
				{toolbar: '#hastype', align: 'center', title: '认证方式'},
				{field: 'name', align: 'center', title: '真实姓名'},
				{field: 'company_name', align: 'center', title: '企业名称'},
				{field: 'idcard', align: 'center', title: '身份证号',minWidth:170},
				{align: 'center',  title: '身份证照',toolbar: '#idcard',minWidth:125},
				{field: 'canada', align: 'center', title: '营业执照号',minWidth:180},
				{toolbar: '#company', align: 'center', title: '营业执照',minWidth:125},
				{align: 'center',  title: '状态',templet:'#status'},
				{field: 'create_time', align: 'center', title: '提交时间',minWidth:160},
                {align: 'center', toolbar: '#tableTBTrack', title: '操作',minWidth:225}
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
				case "idcard":
				  var one=openUrl("查看身份证照片【"+data.username+"】",'600px','500px',"<?php echo url('/UserAuth/lookPhoto'); ?>?tpl=idcard&id="+data.id);
				break;
				case "company":
				  var one=openUrl("查看营业执照【"+data.username+"】",'600px','500px',"<?php echo url('/UserAuth/lookPhoto'); ?>?tpl=canada&id="+data.id);
				break;
				
				case 'bianji':
				   var index = layer.msg('更新数据中，请稍候', {
							icon: 16,
							time: false,
							shade: 0.3
						});
				  $.post("<?php echo url('/UserAuth/edit'); ?>",{id:data.id,real:data.clas},function(e){
					  layer.close(index);
					  layer.msg(e.msg);
					  insTb.reload();
				  })
				break;
				case 'rest':
				  var intu=layer.open({
				    title: '输入失败原因',
				    skin:'layui-layer-demo',
				    area:['450px', 'auto'],
				    content:' <div class="row" style="width: 400px;  margin-left:7px; margin-top:10px;"><div class="layui-form-item"><input id="firstpwd" type="text" class="layui-input" placeholder="请输入失败原因"></div></div>',
				    btn:['保存','取消'],
				    btn1: function (index,layero) {
						var res=$("#firstpwd").val();
						var index = layer.msg('更新数据中，请稍候', {
							icon: 16,
							time: false,
							shade: 0.3
						});
						$.post("<?php echo url('/UserAuth/editres'); ?>",{id:data.id,remarks:res},function(p){
							layer.close(index);
							layer.close(intu);
							layer.msg(p.msg);
					        insTb.reload();
						})
					}
				  })
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
							url: "<?php echo url('/UserAuth/del'); ?>?id="+data.id,
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
						 shopid:name
                     }
                 });
				 layer.close(index);
        });
    });

</script>


</body>
</html>