<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\facade\Config as Con;
use think\facade\View;
use think\facade\Request;
use think\facade\Db;
use think\facade\Cache;
use think\facade\Session;
use app\common\model\Sysconfig;
use app\common\model\System;
use app\common\model\CardOperator;

class Config extends AdminBase
{
    protected function _initialize()
    {
        parent::_initialize();
    }
    
    public function setting()
    {
        if ($this->request->isPost()) {
            $da=input("post.");
			unset($da['file']);
			$type=$da['type'];
			unset($da['type']);
			$da['state']=isset($da['state'])?'on':'off';
			foreach($da as $k=>$v){
				$id=Sysconfig::where(['name'=>$k,'type'=>$type])->value("id");
				if($id){
				   Sysconfig::where(['id'=>$id])->update(['value' => $v]);
				}else{
					(new Sysconfig)->save(['name'=>$k,'value' => $v,'type'=>$type]);
				}
			}
			$this->success('保存成功');
        }
		$res=Sysconfig::where(['type'=>'website'])->select()->toArray();
		$list=[];
		if($res){
			foreach($res as $k=>$v){
				$list[$v['name']]=$v['value'];
			}
		}else{
           $list = Con::load('admin/website','website');
		}
        return View::fetch('setting', ['list' => $list]);
    }
    
    public function param()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            if(isset($param['type']) && $param['type']=='on'){
                $param['type'] = '1';
			}else{
				$param['type'] = '0';
			}
			if($param['model']=='qq'){
				if(isset($param['qqlogin']) && $param['qqlogin']=='on'){
					   $param['qqlogin'] = '1';
					}else{
						$param['qqlogin'] = '0';
					}
			}
			if($param['model']=='wxpay'){
				if(isset($param['wxlogin']) && $param['wxlogin']=='on'){
					   $param['wxlogin'] = '1';
					}else{
						$param['wxlogin'] = '0';
					}
			}
			if($param['model']=='cash'){
				if(isset($param['banktype']) && $param['banktype']=='on'){
					   $param['banktype'] = '1';
					}else{
						$param['banktype'] = '0';
					}
				if(isset($param['banksh']) && $param['banksh']=='on'){
					   $param['banksh'] = '1';
					}else{
						$param['banksh'] = '0';
					}
				if(isset($param['alitype']) && $param['alitype']=='on'){
					   $param['alitype'] = '1';
					}else{
						$param['alitype'] = '0';
					}
				if(isset($param['alish']) && $param['alish']=='on'){
					   $param['alish'] = '1';
					}else{
						$param['alish'] = '0';
					}
				
				if(isset($param['wxtype']) && $param['wxtype']=='on'){
					   $param['wxtype'] = '1';
					}else{
						$param['wxtype'] = '0';
				}
				if(isset($param['wxsh']) && $param['wxsh']=='on'){
					   $param['wxsh'] = '1';
					}else{
						$param['wxsh'] = '0';
				}
			
			}
			
			if($param['model']=='aly'){
			    if(isset($param['iska']) && $param['iska']=='on'){
					   $param['iska'] = '1';
					}else{
						$param['iska'] = '0';
					}
				if(isset($param['istx']) && $param['istx']=='on'){
					   $param['istx'] = '1';
					}else{
						$param['istx'] = '0';
					}
				if(isset($param['isapi']) && $param['isapi']=='on'){
					   $param['isapi'] = '1';
					}else{
						$param['isapi'] = '0';
					}
			}
			if($param['model']=='email'){
				$da=$this->request->param(false);
				$param['smgtpl']=$da['smgtpl'];
				$param['login']=$da['login'];
			}
			
            extraconfig($param, 'setting/'.$param['model']);
            $this->success('设置成功');
        }
        $model = input('model')?:'qiniu';
        $list = Con::load('setting/'.$model,'$model');
		if(is_https()){
		   $url="https://". $_SERVER['SERVER_NAME'];
		}else{
			$url="http://". $_SERVER['SERVER_NAME'];
		}
        $domain = $url;
        return $this->fetch('param_'.$model, ['list' => $list,'banks'=>CardOperator::where(['type'=>1,'status'=>1])->select(),'callback'=>$domain.'/apiback/type/qq.html','wxcallback'=>$domain.'/apiback/type/wx.html']);
    }

    public function upload()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            extraconfig($param, 'admin/upload_setting');
            insert_admin_log('修改了上传设置');
            $this->success('保存成功');
        }
        $data = Con::load('admin/website','upload_setting');
        return $this->fetch('upload', ['data' => $data]);
    }
	public function accetsset(){
		if($this->request->isPost()){
			$da=$this->request->param(false);
			unset($da['file']);
			$type=$da['type'];
			unset($da['type']);
			$da['yaostate']=isset($da['yaostate'])?'on':'off';
			foreach($da as $k=>$v){
				$id=Sysconfig::where(['name'=>$k,'type'=>$type])->value("id");
				if($id){
				   Sysconfig::where(['id'=>$id])->update(['value' => $v]);
				}else{
					(new Sysconfig)->save(['name'=>$k,'value' => $v,'type'=>$type]);
				}
			}
			$this->success('保存成功');
		}
		$res=Sysconfig::where(['type'=>'assets'])->select()->toArray();
		$list=[];
		foreach($res as $k=>$v){
			$list[$v['name']]=$v['value'];
		}
		View::assign("list",$list);
		return view();
	}
	

}
