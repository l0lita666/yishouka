<?php
namespace app\common\controller;
use think\facade\View;
use think\facade\Config as Con;
use app\common\model\Article;
use app\common\model\CardModel;
use app\common\model\CardList;
use app\common\model\User;
use app\common\model\Sysconfig;
use think\facade\Request;

class IndexBase extends Base
{
   public $user;
	
   public function initialize()
    {
        parent::initialize();
		$res=Sysconfig::select()->toArray();
		$list=[];
		foreach($res as $k=>$v){
			$list[$v['name']]=$v['value'];
		}
		$wx = Con::load('setting/wxapp','wxapp');
		$wxapp = Con::load('setting/wxpay','wxpay');
		$aly = Con::load('setting/aly','aly');
		$this->real=$aly;
		$news=Article::where(['status'=>1,'is_top'=>1])->select();
		$cardModel=CardModel::with('comments')->order("sort_order desc,id desc")->select()->toArray();
		$rem=[];
		foreach($cardModel as $k=>$v){
			if($v['istype']==1){
				$rem=CardList::where(['is_hot'=>1])->select()->toArray();
				$cardModel[$k]['comments']=$rem;
				
			}
		}

		if($id=is_user_login()){
			$this->user=User::with('userReal')->where(['id'=>$id,'token'=>session("user_auth.token")])->whereTime('timeout','>',time())->find();
			if(!$this->user){
				session('user_auth', null);
                session('user_auth_sign', null);
			}
			
		}
		$isqq=con::load('setting/qq','qq');
		View::assign('isqq',$isqq['qqlogin']);
		View::assign('iswx',isset($wxapp['wxlogin'])?$wxapp['wxlogin']:'');
		View::assign("contr",Request::controller());
        View::assign("action",Request::action());
		View::assign("remen",$rem);
		View::assign("C",array_merge($list,$wxapp));
		View::assign("wx",$wx);
		View::assign("thisli",$news);
		View::assign("cardModel",$cardModel);
    }
}
