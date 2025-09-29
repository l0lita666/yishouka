<?php /*a:2:{s:57:"/www/wwwroot/www.ssyd.fun/app/admin/view/admin/save.phtml";i:1600139160;s:51:"/www/wwwroot/www.ssyd.fun/app/admin/view/base.phtml";i:1602325784;}*/ ?>
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
                <label class="layui-form-label">用户组</label>
                <div class="layui-input-inline">
                    <select name="group_id">
                        <option value="">请选择用户组</option>
                        <?php if(is_array($authGroup) || $authGroup instanceof \think\Collection || $authGroup instanceof \think\Paginator): if( count($authGroup)==0 ) : echo "" ;else: foreach($authGroup as $key=>$v): ?>
                        <option value="<?php echo htmlentities($v['id']); ?>" <?php if(isset($data) and $data['group_id'] == $v['id']): ?>selected="selected"<?php endif; ?>><?php echo htmlentities($v['name']); ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">* 用户名</label>
                <div class="layui-input-inline">
                    <input type="text" name="username" value="<?php echo htmlentities((isset($data['username']) && ($data['username'] !== '')?$data['username']:'')); ?>" autocomplete="off" placeholder="请输入用户名" lay-verify="required|username" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">密码</label>
				<?php if(empty($id) || (($id instanceof \think\Collection || $id instanceof \think\Paginator ) && $id->isEmpty())): ?>
				<div class="layui-input-inline">
                    <input type="password" name="password" value="" autocomplete="off" placeholder="请输入密码" class="layui-input" lay-verify="required">
                </div>
					<?php else: ?>
                <div class="layui-input-inline">
                    <input type="password" name="password" value="" autocomplete="off" placeholder="请输入密码" class="layui-input">
                </div>
				<div class="layui-form-mid layui-word-aux" style="color:#d40808!important">留空不修改</div>
				<?php endif; ?>
            </div>
			<div class="layui-form-item">
                <label class="layui-form-label">手机号</label>
                <div class="layui-input-inline">
                    <input type="text" name="mobile" value="<?php echo htmlentities((isset($data['mobile']) && ($data['mobile'] !== '')?$data['mobile']:'')); ?>" autocomplete="off" placeholder="请输入手机" class="layui-input" lay-verify="required|phone">
                </div>
            </div>
			<div class="layui-form-item">
                <label class="layui-form-label">邮箱</label>
                <div class="layui-input-inline">
                    <input type="text" name="email" value="<?php echo htmlentities((isset($data['email']) && ($data['email'] !== '')?$data['email']:'')); ?>" autocomplete="off" placeholder="请输入邮箱" class="layui-input" lay-verify="required|email">
                </div>
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