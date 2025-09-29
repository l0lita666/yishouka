<?php
namespace app\home\validate;

use think\Validate;
use app\common\model\User;
use think\facade\Config;
use app\common\model\Userbank;

class Cash extends Validate
{
	
    protected $rule = [
	    'type'=>'require|status:type|token',
        'bank_id' => 'require|isName:bank_id',
        'moneyoff' => 'require|number|gt:1|betw:moneyoff|isuser:moneyoff',
        'paypass' => 'require|ispass:paypass',
    ];

    protected $message = [
        'type.require' => ['code'=>'#anjian','msg'=>'非法参数1'],
		'type.status' => ['code'=>'#anjian','msg'=>'当前提现通道状态异常'],
		'type.token' => ['code'=>'#anjian','msg'=>'超时操作请刷新'],
		
		'bank_id.require' => ['code'=>'#anjian','msg'=>'非法参数2'],
		'bank_id.isName' => ['code'=>'#username','msg'=>'参数非法'],
		
		'moneyoff.require' => ['code'=>'#moneyoff','msg'=>'请输入密码'],
		'moneyoff.number' => ['code'=>'#moneyoff','msg'=>'请输入正确的金额'],
		'moneyoff.gt' => ['code'=>'#moneyoff','msg'=>'请输入正确的金额'],

		'paypass.require'=>['code'=>'#paypass','msg'=>'请输入安全密码错误'],
		'paypass.ispass'=>['code'=>'#paypass','msg'=>'安全密码错误']
		
    ];
	
	protected function ispass($value){
		$user=User::find(session('user_auth.user_id'));
		if($user){
		    if(empty($user['tradepwd']))return false;
			if(md6($value,$user['tradepwd'])){
			   return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
        
    }
	
	protected function isName($value){
		if(Userbank::where(['id'=>$value,'uid'=>session('user_auth.user_id')])->find()){
			return true;
		}else{
			return false;
		}
        
    }
	
	protected function betw($value,$rule,$data){
		$res=Config::load('setting/cash','cash');
		$min=0;$max=0;
		switch($data['type']){
			case 'bank':
			 $min=$res['bank_min'];
			 $max=$res['bank_max'];
			break;
			case 'alipay':
			  $min=$res['ali_min'];
			  $max=$res['ali_max'];
			break;
			case 'weixin':
			  $min=$res['wx_min'];
			  $max=$res['wx_max'];
			break;
		}
		if($value<$min || $value>$max){
			return ['code'=>'#moneyoff','msg'=>"提现金额不能小于{$min},单笔最多提现{$max}"];
		}else{
			return true;
		}
        
    }
	
	protected function isuser($value){
		$user=User::find(session('user_auth.user_id'));
		if($user){
			if($value>$user['money']){
				return ['code'=>'#moneyoff','msg'=>'余额不足'];
			   
			}else{
				return true;
			}
		}else{
			return false;
		}
        
    }
	
	protected function status($value){
		$res=Config::load('setting/cash','cash');
		$op=0;
		switch($value){
			case 'bank':
			 $op=$res['banktype'];
			break;
			case 'alipay':
			  $op=$res['alitype'];
			break;
			case 'wxtype':
			  $op=$res['wxtype'];
			break;
		}
		if($op){
			return true;
		}else{
			return false;
		}
        
    }
	
	
	
}
