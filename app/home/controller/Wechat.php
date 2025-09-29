<?php
declare (strict_types = 1);

namespace app\home\controller;
use app\common\controller\IndexBase;
use app\common\model\Wechat as wx;
use app\common\model\User;
use app\common\model\Userbank;
use app\common\model\UserAuth;
use think\facade\Config;
use think\Request;

class Wechat extends IndexBase
{
    private $wxapp;
    
    public function  __construct()
    {
        $this->wxapp = wx::weixin();
    }

    public function index()
    {
        $app = $this->wxapp;
        $app->server->push(function ($message) { 
            switch ($message['MsgType']) { 
                case 'event':
                    $returnInfo = $this->eventHandler($message); 
                    return $returnInfo; 
                    break; 
                case 'text': 
                    return '收到文字消息'; break; 
                case 'image': 
                    return '收到图片消息'; break; 
                case 'voice': 
                    return '收到语音消息'; break; 
                case 'video': 
                    return '收到视频消息'; break; 
                case 'location': 
                    return '收到坐标消息'; break; 
                case 'link': 
                    return '收到链接消息'; break; 
                default: 
                    $this->checkSignature();exit(); 
					break; 
            } 
        }); 
        $response = $app->server->serve();
        $response->send();
    }
    
    public function checkSignature()
		{
		    $da=input();
		    $weixin = Config::load('setting/wxpay','wxpay');
			$signature = $da["signature"];
			$timestamp = $da["timestamp"];
			$nonce = $da["nonce"];
			$token = $weixin['token'];
			$tmpArr = array($token, $timestamp, $nonce);
			sort($tmpArr, SORT_STRING);
			$tmpStr = implode( $tmpArr );
			$tmpStr = sha1( $tmpStr );
			if( $tmpStr == $signature ){
				echo $da['echostr'];
			}else{
				return false;
			}
		}
    //获取信息
    private function eventHandler($messageEvent) { 
        switch ($messageEvent['Event']) { 
            case 'subscribe': 
                //二维码事件
                $eventkey = substr($messageEvent['EventKey'], 0,8);
                if($eventkey == 'qrscene_'){
                    $msg=$this->qrscene($messageEvent['FromUserName'],substr($messageEvent['EventKey'],8));
                }else{
					$msg=$this->subscribe($messageEvent['FromUserName']);
				}
				return $msg;
                break;
            case 'unsubscribe': 
                $this->unsubscribe($messageEvent['FromUserName']);
                return '欢迎订阅'; 
                break;
        } 
    }
    //获取OPENID等
    //关注事件
    private function subscribe($openid) { 
        $app = $this->wxapp;
        //检查用户
        $admin = User::where(['wxopenid'=>$openid])->find();
		$user = $app->user->get($openid);
		$map['shopid'] = User::order('id desc')->value('shopid')+1;
		$map['username']=$user['nickname'];
		$map['password']=generate_password(4);
		$map['wxopenid']=$openid;
		(new User)->save($map);
        return "欢迎关注我们的微信公众账号.";
    }
    //取消关注事件
    private function unsubscribe($openid)
    { 
	    Userbank::where(['accounts'=>$openid])->delete();
        return ;
    }
    //二维码绑定
    private function qrscene($openid,$message)
    {
       $user=User::find($message);
	   $real=UserAuth::where(['shopid'=>$user['shopid']])->find();
	   if($user && $real){
		   $app = $this->wxapp;
		   $user = $app->user->get($openid);
		   $map['uid']=$message;
		   $map['bankname']=$user['nickname'];
		   $map['accounts']=$openid;
		   $map['user']=$real['clas']==1?$real['name']:$real['company_name'];
		   $map['bankid']=-2;
		   $map['create_time']=time();
		   Userbank::create($map);
		   return '欢迎关注我们的微信公众账号,关注后不要取消关注，以免接不到通知';
	   }
	   elseif(!$real){
		   return '该账户没有实名认证,请实名认证后再添加提现微信';
	   }
        
    }
    
}
