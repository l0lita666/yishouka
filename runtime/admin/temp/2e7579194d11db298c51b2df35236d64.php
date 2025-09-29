<?php /*a:2:{s:59:"/www/wwwroot/www.ssyd.fun/app/admin/view/card/channel.phtml";i:1600139160;s:51:"/www/wwwroot/www.ssyd.fun/app/admin/view/base.phtml";i:1602325784;}*/ ?>
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
    <div class="layui-card-header">
        <div class="layui-btn-group" id="mbutton">
            <?php foreach($res as $v): ?>
				<button class="layui-btn <?php if($id != $v['id']): ?>layui-btn-primary<?php endif; ?>" style="margin-bottom:8px" type="button" id="moneyClick" lay-type="<?php echo htmlentities($v['id']); ?>" ><?php echo htmlentities($v['name']); ?></button> 
			   <?php endforeach; ?>	
        </div>
    </div>
    
    <table id="tableList" lay-filter="tableList"></table>
    <!-- 表格操作列 -->
    </script>
     <script type="text/html" id="status">
	     <a href="<?php echo url('/card/editchcard'); ?>?id={{d.id}}" class="layui-btn layui-btn-normal ajax-iframe" data-width="750px" data-height="690px">编辑</a>
		
     </script>
	 <script type="text/html" id="geng">
	    
		 {{#  if(d.isok == 1){ }}
		  <a href="<?php echo url('/card/updates'); ?>?id={{d.id}}" class="layui-btn layui-btn-danger ajax-action" >一键更新到用户</a>
		 {{# }else { }}
		   <a href="#" class="layui-btn layui-btn-disabled" >未绑定到销卡</a>
		 {{#  } }}
     </script>
	
    <!-- 权限列 -->
    <script type="text/html" id="type">
        <input type="text" name="type" value="{{d.type}}" autocomplete="off" class="layui-input ajax-update" data-url="<?php echo url('/card/editchcard'); ?>?id={{d.id}}">
    </script>
	
	<script type="text/html" id="operatorfl">
        <input type="text" name="operatorfl" value="{{d.operatorfl}}" autocomplete="off" class="layui-input ajax-update" data-url="<?php echo url('/card/editchcard'); ?>?id={{d.id}}">
    </script>
	
	<script type="text/html" id="payfl">
        <input type="text" name="payfl" value="{{d.payfl}}" autocomplete="off" class="layui-input ajax-update" data-url="<?php echo url('/card/editchcard'); ?>?id={{d.id}}">
    </script>
    
    
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
            url: "<?php echo url('/card/channel'); ?>",
            where:{},
            page: true,
            limit:15,
            limits:[15,30,45,60,75,90],
            cellMinWidth: 100,
            cols: [[
                {type:'numbers',title:'#'},
                {field: 'tid',align: 'content', sort: true, title: '名称',width:200},
                {templet:'#type', align: 'content', title: '通道代码',width:200},
				{field: 'content', align: 'content', title: '费率列表',minWidth:600},
                {align: 'center',  title: '操作',templet:'#status',width:100},
				{align: 'center',  title: '更新',templet:'#geng',width:180},
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
		$("#mbutton").on("click","#moneyClick",function(){
		    var e=$(this);
			e.siblings().addClass("layui-btn-primary");
			e.removeClass("layui-btn-primary");
			loading =layer.load(1, {shade: [0.1,'#fff']});
            var name=e.attr('lay-type');
			var index = layer.load(3, {
					  shade: [0.1,'#fff'] //0.1透明度的白色背景
					});
                 insTb.reload({
					page:{curr:1},
                    where:{
						 cid:name
                     }
                 });
				 layer.close(index);
		});
       
    });

</script>


</body>
</html>