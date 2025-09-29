<?php /*a:2:{s:56:"/www/wwwroot/ka1.y9fu.com/app/admin/view/user/save.phtml";i:1600139160;s:51:"/www/wwwroot/ka1.y9fu.com/app/admin/view/base.phtml";i:1602325784;}*/ ?>
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
    <div class="layui-card-body">
        <form action="<?php echo request()->url(); ?>" class="layui-form" method="post">
            <div class="layui-form-item">
                <label class="layui-form-label">手机号</label>
                <div class="layui-input-block">
                    <input type="text" name="mobile" value="<?php echo htmlentities((isset($data['mobile']) && ($data['mobile'] !== '')?$data['mobile']:'')); ?>" autocomplete="off" placeholder="请输入手机号" lay-verify="required|phone|number" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">账户金额</label>
                <div class="layui-input-block">
                    <input type="number" name="money" value="<?php echo htmlentities((isset($data['money']) && ($data['money'] !== '')?$data['money']:'')); ?>" autocomplete="off" placeholder="请输入金额"  class="layui-input">
                </div>
            </div>
			<div class="layui-form-item">
                <label class="layui-form-label">联系QQ</label>
                <div class="layui-input-block">
                    <input type="number" name="qq" value="<?php echo htmlentities((isset($data['qq']) && ($data['qq'] !== '')?$data['qq']:'')); ?>" autocomplete="off" placeholder="请输入qq"  class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">登陆密码</label>
                <div class="layui-input-inline">
                    <input type="password" name="password" value="" autocomplete="off" placeholder="请输入密码" class="layui-input">
                </div>
				<?php if(!(empty($data['password']) || (($data['password'] instanceof \think\Collection || $data['password'] instanceof \think\Paginator ) && $data['password']->isEmpty()))): ?>
				<div class="layui-form-mid layui-word-aux">不修改留空</div><?php endif; ?>
            </div>
			<div class="layui-form-item">
                <label class="layui-form-label">安全密码</label>
                <div class="layui-input-inline">
                    <input type="password" name="tradepwd" value="" autocomplete="off" placeholder="请输入密码" class="layui-input">
                </div>
				<?php if(!(empty($data['tradepwd']) || (($data['tradepwd'] instanceof \think\Collection || $data['tradepwd'] instanceof \think\Paginator ) && $data['tradepwd']->isEmpty()))): ?>
				<div class="layui-form-mid layui-word-aux ">不修改留空</div><?php endif; ?>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-filter="i" lay-submit="">保存</button>
                    <button class="layui-btn layui-btn-primary" type="reset">重置</button>
                </div>
            </div>
        </form>
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



</body>
</html>