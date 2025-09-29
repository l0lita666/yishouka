<?php /*a:2:{s:58:"/www/wwwroot/www.ssyd.fun/app/admin/view/admin/index.phtml";i:1600139160;s:51:"/www/wwwroot/www.ssyd.fun/app/admin/view/base.phtml";i:1602325784;}*/ ?>
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
        <div class="layui-btn-group">
            <a href="<?php echo url('/Admin/add'); ?>" class="layui-btn ajax-iframe" data-width="450px" data-height="500px">添加管理员</a>
        </div>
    </div>
    
    <table id="tableList" lay-filter="tableList"></table>
    <!-- 表格操作列 -->
    <script type="text/html" id="tableTBTrack">
	    <button type="button" class="layui-btn" lay-event="bianji">编辑</button>
        <a href="<?php echo url('/Admin/del'); ?>?id={{d.id}}" class="layui-btn layui-btn-danger ajax-delete">删除</a>
    </script>
    <!-- 权限列 -->
    <script type="text/html" id="status">
        <input type="checkbox" name="status" lay-skin="switch" lay-filter="*" lay-text="正常|锁定" data-url="<?php echo url('/Admin/edit'); ?>?id={{d.id}}" {{d.status==1?'checked':''}}>
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

        // 渲染回访表格
        var insTb = table.render({
            elem: '#tableList',
            url: "<?php echo url('/Admin/index_json'); ?>",
            page: true,
            cellMinWidth: 100,
            limit:'15',
            limits:['15','30','50','100','200','500'],
            size:'lg',even:true,
            cols: [[
                {type:'numbers',title:'#'},
                {field: 'username', align: 'left', sort: true, title: '用户名'},
                {field: 'name', align: 'left', sort: true, title: '用户组'},
                {field: 'last_login_time', align: 'center', sort: true, title: '上次登录时间'},
                {field: 'last_login_ip', align: 'center', sort: true, title: '上次登录IP'},
                {field: 'create_time', align: 'center', sort: true, title: '创建时间'},
                {align: 'center', sort: true, title: '状态',templet:'#status',width:100},
                {align: 'center', toolbar: '#tableTBTrack', title: '操作', minWidth: 190}
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
				  var one=openUrl("编辑管理员",'600px','410px',"<?php echo url('/Admin/edit'); ?>?id="+data.id);
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

    });

</script>


</body>
</html>