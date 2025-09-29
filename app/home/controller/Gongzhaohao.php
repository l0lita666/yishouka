<?php
namespace app\home\controller;

use app\common\controller\Base;
use think\facade\View;
use think\facade\Request;
use think\facade\Config;
use app\common\model\Wechat as wx;
use app\common\model\User;
use app\common\model\Sysconfig;

class Gongzhaohao extends Base
{

    public function index()//公众登陆
    {
        $app = wx::weixin();
        $oauth = $app->oauth;
        return $oauth->redirect();
    }
    
    public function oauthcallback(){
        $app = wx::weixin();
        $oauth = $app->oauth;
        $user=$oauth->user();
        $wx['openid']=$user['original']['openid'];
        $wx['name']=$user['name'];
        session('userwxauth',$wx);
        $openid=isset($user['original']['unionid'])?$user['original']['unionid']:$wx['openid'];
        $ok=$this->toLogin($openid);
	    if(!$ok){
	        $res=Sysconfig::select()->toArray();
            $list=[];
            foreach($res as $k=>$v){
                $list[$v['name']]=$v['value'];
            }
    		$wxapp = Config::load('setting/wxpay','wxpay');
	        View::assign("C",array_merge($list,$wxapp));
	        View::assign('title','绑定账号');
			return view('gongzhaohao/callback');
	    }else{
	         $this->redirect(url('home/Member/index'));
	    }
    }
    
    public function wxtologin(){
		if (request()->isPost()){
			if(session("?userwxauth")){
				$this->wxuser(session("userwxauth"));
				$ms=["content"=>"登录处理中，请稍等......","confirm"=>["name"=>"登录成功","prompt"=>"success","width"=>350,"time"=>1,"callback"=>"","url"=>"/user_index.html"]];
                return json($ms);
			}else{
				return json(["tip"=>"#qqlogin","content"=>"非法提交重新登陆！"]);
			}
		}
	}
    
	private function wxuser($user){
	    $openid=isset($user['unionid'])?$user['unionid']:$user['openid'];
	    $us = User::where(['wxopenid' => $openid])->find();
	    if(!$us){
	        $map['shopid'] = User::order('id desc')->value('shopid')+1;
    		$map['username']=filterEmoji($user['name']);
    		$map['password']=isset($user['unionid'])?$user['unionid']:$user['openid'];
    		$map['wxopenid']=isset($user['unionid'])?$user['unionid']:$user['openid'];
    		$map['assets']=cookie('referee');
    		(new User)->save($map);
	    }
    		$this->toLogin($map['wxopenid']);
    		
	}
	
	private function toLogin($openid){
	    if(!empty($openid)){
    		$user = User::where(['wxopenid' => $openid])->find();
    		if ($user){
    		    if($user['status']!=1){
    			    insert_user_log(3,'登录失败该账号被冻结');
    				$this->redirect(url("home/Index/loginErr"));
    			}
    			$token=makeToken();
    			$user->token=$token;
    			$user->timeout=strtotime("+1 days");
    			$user->last_login_ip=request()->ip();
    			$auth = [
    				'user_id' => $user['id'],
    				'shop_id' => $user['shopid'],
    				'mobile' => $user['mobile'],
    				'token'=>$token
    			];
    			$user->save();
    			session('user_auth', $auth);
    			session('user_auth_sign', data_auth_sign($auth));
    			insert_user_log(1,'登录成功');
    			return true;
    		}else{
    			return false;
    		}
	    }else{
	        return false;
	    }
	}
}
