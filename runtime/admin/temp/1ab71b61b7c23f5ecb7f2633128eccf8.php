<?php /*a:2:{s:62:"/www/wwwroot/ka1.y9fu.com/app/admin/view/card/installapi.phtml";i:1600784232;s:51:"/www/wwwroot/ka1.y9fu.com/app/admin/view/base.phtml";i:1602325784;}*/ ?>
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
          <a href="<?php echo url('/card/addapi'); ?>" class="layui-btn ajax-iframe" data-width="750px" data-height="150px"><i class="fa fa-plus-circle"></i> 添加接口</a>
        </div>
    </div>
    
    <table id="tableList" lay-filter="tableList"></table>
    <!-- 表格操作列 -->
    <script type="text/html" id="tableTBTrack">
	    {{#  if(d.isok == 1){ }}
        <a href="<?php echo url('/card/configEdit'); ?>?id={{d.id}}" class="layui-btn layui-btn-normal ajax-iframe" data-width="750px" data-height="500px">编辑</a>
        <a href="<?php echo url('/card/apidel'); ?>?id={{d.id}}" class="layui-btn layui-btn-danger ajax-delete">删除</a>
		{{# }else if(d.isok==2){ }}
		 <a href="<?php echo url('/card/apidel'); ?>?id={{d.id}}" class="layui-btn layui-btn-danger ajax-delete">接口文件不存在-删除</a>
		{{#  } else { }}
		<a href="<?php echo url('/card/addapi'); ?>?id={{d.class}}" class="layui-btn layui-btn-normal ajax-action" >安装接口</a>
		{{#  } }}
    </script>
     <script type="text/html" id="status">
                <input type="checkbox" name="status" lay-skin="switch" lay-filter="*" lay-text="开启|关闭" data-url="<?php echo url('/card/apiedit'); ?>?id={{d.class}}" {{d.status==1?'checked':''}}>
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
            url: "<?php echo url('/card/installapi'); ?>",
            page: false,
            cellMinWidth: 100,
            size:'lg',even:true,
            cols: [[
                {type:'numbers',title:'#'},
                {field: 'type', align: 'center', sort: true, title: '接口类型'},
                {field: 'name',align: 'center', sort: true, title: '运营商名称'},
                {field: 'url', align: 'left', sort: true, title: '网址'},
				{field: 'qq',align: 'center', sort: true, title: '作者QQ',},
                {align: 'center', title: '是否开启',templet:'#status'},
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