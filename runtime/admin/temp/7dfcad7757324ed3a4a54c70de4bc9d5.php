<?php /*a:2:{s:56:"/www/wwwroot/www.ssyd.fun/app/admin/view/auth/rule.phtml";i:1600139160;s:51:"/www/wwwroot/www.ssyd.fun/app/admin/view/base.phtml";i:1602325784;}*/ ?>
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
  
<link rel="stylesheet" href="/static/simple/libs/ztree/css/zTreeStyle/zTreeStyle.css">

</head>
<body>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        
<div class="layui-card">
    <div class="layui-card-body">
        <div class="layui-btn-group">
            <a href="javascript:;" class="layui-btn" id="addRule"><i class="fa fa-plus-circle"></i> 添加规则</a>
            <a href="javascript:;" class="layui-btn layui-btn-normal" id="editRule"><i class="fa fa-edit"></i> 编辑规则</a>
            <a href="javascript:;" class="layui-btn layui-btn-danger" id="delRule"><i class="fa fa-trash-o"></i> 删除规则</a>
        </div>
        <div class="ztree" id="authRule"></div>
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


<script src="/static/simple/libs/ztree/js/jquery.ztree.all.min.js"></script>
<script>
$.fn.zTree.init($("#authRule"), {
    view: {
        dblClickExpand: false,
        showLine: true,
        showIcon: false,
        selectedMulti: false
    },
    edit: {
        enable: true,
        editNameSelectAll: true,
        showRemoveBtn: false,
        showRenameBtn: false
    },
    data: {
        simpleData: {
            enable: true
        }
    }
}, <?php echo json_encode($authRule); ?>);


$('#addRule').on('click', function(){
    var zTree = $.fn.zTree.getZTreeObj('authRule'),
        nodes = zTree.getSelectedNodes(),
        treeNode = nodes[0];
    var id = treeNode == undefined ? 0 : treeNode.id;
    var index = layer.open({
        title: '添加规则',
        type: 2,
        area: ['430px', '430px'],
        content: '<?php echo url("/auth/addRule"); ?>?id=' + id,
    });
});

$('#editRule').on('click', function(){
    var zTree = $.fn.zTree.getZTreeObj('authRule'),
        nodes = zTree.getSelectedNodes(),
        treeNode = nodes[0];
    if (nodes.length == 0) {
        layer.msg('请先选择一个节点');
        return false;
    } else {
        var id = treeNode.id;
        var index = layer.open({
            title: '修改规则',
            type: 2,
            area: ['430px', '430px'],
            content: '<?php echo url("/auth/editRule"); ?>?id=' + id
        });
    }
});

$('#delRule').on('click', function(){
    layer.confirm('确定删除？', {
        icon: 3,
        title: '提示'
    }, function(index) {
        var zTree = $.fn.zTree.getZTreeObj('authRule'),
            nodes = zTree.getSelectedNodes(),
            treeNode = nodes[0];
        if (nodes.length == 0) {
            layer.msg('请先选择一个节点');
            return false;
        } else {
            var id = treeNode.id;
            var index = layer.msg('删除中，请稍候', {
                icon: 16,
                time: false,
                shade: 0.3
            });
            $.ajax({
                url: '<?php echo url("/auth/delRule"); ?>?id=' + id,
                type: 'post',
                dataType: 'json',
                success: function(result) {
                    if (result.code === 1 && result.url != '') {
                        setTimeout(function() {
                            location.href = result.url;
                        }, 1000);
                    }
                    layer.close(index);
                    layer.msg(result.msg);
                },
                error: function (xhr, state, errorThrown) {
                    layer.close(index);
                    layer.msg(state + '：' + errorThrown);
                }
            });
        }
    });
    return false;
});
</script>


</body>
</html>