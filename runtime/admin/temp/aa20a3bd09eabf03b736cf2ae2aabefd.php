<?php /*a:2:{s:57:"/www/wwwroot/www.ssyd.fun/app/admin/view/card/index.phtml";i:1600139160;s:51:"/www/wwwroot/www.ssyd.fun/app/admin/view/base.phtml";i:1602325784;}*/ ?>
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
            <a href="<?php echo url('/card/add'); ?>" class="layui-btn ajax-iframe" data-width="750px" data-height="500px"><i class="fa fa-plus-circle"></i> 添加分类</a>
        </div>
    </div>
    
    <table id="tableList" lay-filter="tableList"></table>
    <!-- 表格操作列 -->
    <script type="text/html" id="tableTBTrack">
        <a href="<?php echo url('/card/edit'); ?>?id={{d.id}}" class="layui-btn layui-btn-normal ajax-iframe" data-width="750px" data-height="500px">编辑</a>
        <a href="<?php echo url('/card/del'); ?>?id={{d.id}}" class="layui-btn layui-btn-danger ajax-delete">删除</a>
    </script>
     <script type="text/html" id="istype">
                <input type="checkbox" name="istype" lay-skin="switch" lay-filter="*" lay-text="综合|独立" data-url="<?php echo url('/card/edit'); ?>?id={{d.id}}" {{d.istype==1?'checked':''}}>
     </script>
	 <script type="text/html" id="status">
                <input type="checkbox" name="status" lay-skin="switch" lay-filter="*" lay-text="显示|隐藏" data-url="<?php echo url('/card/edit'); ?>?id={{d.id}}" {{d.status==1?'checked':''}}>
     </script>
	<script type="text/html" id="image">
		<img src="{{d.image}}">
	</script>
	<script type="text/html" id="isauto">
          <input type="checkbox" name="istype" lay-skin="switch" lay-filter="*" lay-text="图片|卡密" data-url="<?php echo url('/card/edit'); ?>?id={{d.id}}" {{d.istype==1?'checked':''}}>
            </script>
    <!-- 权限列 -->
    <script type="text/html" id="sort">
        <input type="text" name="sort_order" value="{{d.sort_order}}" autocomplete="off" class="layui-input ajax-update" data-url="<?php echo url('/card/edit'); ?>?id={{d.id}}">
    </script>
	<script type="text/html" id="icon">
        <input type="text" name="icon" value="{{d.icon}}" autocomplete="off" class="layui-input ajax-update" data-url="<?php echo url('/card/edit'); ?>?id={{d.id}}">
    </script>
	<script type="text/html" id="route">
        <input type="text" name="route" value="{{d.route}}" autocomplete="off" class="layui-input ajax-update" data-url="<?php echo url('/card/edit'); ?>?id={{d.id}}">
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
            url: "<?php echo url('/card/index_json'); ?>",
            page: false,
            cellMinWidth: 100,
            size:'lg',even:true,
            cols: [[
                {type:'numbers',title:'#'},
                {field: 'title',align: 'content', sort: true, title: '分类名称'},
                {templet:'#image', align: 'content', sort: true, title: '图片'},
				{align: 'center', sort: true, title: '大图标',templet:'#icon',width:200},
				{align: 'center', sort: true, title: '小图标',templet:'#route',width:100},
				{align: 'center', sort: true, title: '分类类型',templet:'#istype'},
                {align: 'center', sort: true, title: '是否显示',templet:'#status'},
                {align: 'center', sort: true, title: '排序',templet:'#sort',width:150},
                {align: 'center', toolbar: '#tableTBTrack', title: '操作', minWidth: 200}
            ]],
            parseData: function(res){ //res 即为原始返回的数据
                return {
                  "code": res.code, //解析接口状态
                  "msg": res.msg, //解析提示文本
                  "count": res.data, //解析数据长度
                  "data": res.data //解析数据列表
                };
            }
        });

    });

</script>


</body>
</html>