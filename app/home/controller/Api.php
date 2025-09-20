<?php
declare (strict_types = 1);
namespace app\home\controller;

use think\Request;
use think\facade\Validate;
use app\common\model\User;
use app\common\controller\Base;
use app\common\model\Newapi;
use app\commom\model\CardOperator;

class Api extends Base
{
    public function sendMsg(){
        	$data=input();
        if(cache('isan')){
            return json(['tip'=>"#{$data['tip']}", 'content'=>"请不用频繁操作"]);
        }else{
            cache('isan',1,1);
        }
		if ($this->request->isPost()) {
			$can='api.'.$data['scene'];
			if(!validate(\app\home\validate\Api::class)->hasScene($data['scene'])){
				return json(['tip'=>"#{$data['tip']}", 'content'=>"参数错误"]);exit;
			}
			switch($data['scene']){
				case 'tradepwd':
				  $data['phoneno']=User::where(['id'=>session('user_auth.user_id')])->value('mobile');
				break;
			}
			try{
				$this->validate($data, $can);
            }catch (\Exception $e){
				if(isJsonBool($e->getMessage(),true)!==false){
				   return json(isJsonBool($e->getMessage()));exit;
				}else{
					$str=$e->getMessage();
					$arr=getArr($str);
					if(count($arr)>1){
						return json(['tip'=>$arr[0], 'content'=>$arr[1]]);
					}else{
					  return json(["eval"=>"","tip"=>"#mcode","type"=>2,"content"=>$e->getMessage()]);
					}
				}
            }
			$code=mt_rand(100000,999999);
			$da=['code'=>$code,'time'=>time()+300];
			session($data['scene'].$data['phoneno'],$da);
			cookie($data['scene']."time",time()+60);
			$msgtype="tMsg";
			switch($data['scene']){
				case "Regcode":
				  $msgtype="regMsg";
				break;
				case "Tradepwd":
				  $msgtype="tMsg";
				break; 
			}
			$res=sendMsg($data['phoneno'],$msgtype,$code);
			if($res['code']==1){
				return json(["eval"=>"codetime(60)","tip"=>"#mcode","type"=>1,"content"=>"发送成功，请等待！"]);
			}else{
				return json(["eval"=>"","tip"=>"#mcode","type"=>2,"content"=>$res['msg'].$code]);
			}
		}
	}
	public function sendEmail(){
		if ($this->request->isPost()) {
			$data=input();
			$can='api.'.$data['scene'];
			if(!validate(\app\home\validate\Api::class)->hasScene($data['scene'])){
				return json(['tip'=>"#{$data['tip']}", 'content'=>"参数错误"]);exit;
			}
			switch($data['scene']){
				case 'upemail':
				  $data['emailno']=User::where(['id'=>session('user_auth.user_id')])->value('email');
				break;
			}
			try{
				$this->validate($data, $can);
            }catch (\Exception $e){
				if(isJsonBool($e->getMessage(),true)!==false){
				   return json(isJsonBool($e->getMessage()));exit;
				}else{
					return json(["eval"=>"","tip"=>"#emcode","type"=>2,"content"=>$e->getMessage()]);
				}
            }
				$code=generate_password(4);
				$da=['code'=>$code,'time'=>time()+300];
				session($data['scene'].$data['emailno'],$da);
				cookie($data['scene']."time",time()+60);
				$res=sendEmail($data['emailno'],$code);
			if($res['code']==1){
				return json(["eval"=>"codetime(60,1)","tip"=>"#emcode","type"=>1,"content"=>"发送成功，请等待！"]);
			}else{
				return json(["eval"=>"","tip"=>"#ecodeno","type"=>2,"content"=>$res['msg']]);
			}
		}
	}
	
	public function callback(){
		$da=input();
	//	logt(json_encode($da));
		if(isset($da['action'])){
			$api=new Newapi($da['action']);
			$code=$api->notify($da);
			exit($code['msg']);
		}else{
			exit('fail');
		}
	}
	
	
}
