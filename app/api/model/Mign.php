<?php
namespace app\api\model;

use think\facadeRequest;
use think\Model;
use app\common\model\User;
use app\common\model\Card;
use app\common\model\CardList;
use app\common\model\UserRate;
use app\common\model\Apiorder;

class Mign extends Model{
	Protected $autoCheckFields = false;
	
	private static $data;
	private static $keyy;
	private static $user;
	private static $cardno="";
	private static $cardkey="";
	private static $shopidis=false;
	
	public function __construct($data)
    {
        self::$data = $data;
		self::setUser();
    }
	
	public function index($order=null){
		
		if(!self::$data){return 'EMPTY ERR:参数不能为空！';exit;}
		if(!self::$shopidis){return '商户不存在！';exit;}
		return self::fieldIsIn();
	}
	
	private static function setUser(){
		$shopid=isset(self::$data['customerId'])?self::$data['customerId']:"";
		$user=User::where(['shopid'=>$shopid])->find()->toArray();
		if($user){
			self::$shopidis=true;
		    self::$user=$user;
		}else{
			self::$shopidis=false;
		}
	}
	
	private static function getUser($field){
		
		return isset(self::$user[$field])?self::$user[$field]:false;
	}
	
	//解密回传卡密数据
	private static function macData(){
		$dekey=self::getUser('apides');
		$Card=New Card(base64_encode($dekey));
        $datano=$Card->decrypt(self::$data['cardNumber']);
		$datakey=$Card->decrypt(self::$data['cardPassword']);
		if($datano && $datakey){
			self::$cardno=$datano;
			self::$cardkey=$datakey;
			return self::inspect();
		}else{
			return '卡号卡密解密失败';
		}
	}
	
	public static function signChick(){
		$ok=md5Verify(self::$data,self::getUser('apikey'),self::$data['sign']);
		if($ok){
		   return self::payok();
		}else{
			return 'SIGN ERROR:sign错误';
		}
	}
	
	private static function userIsok(){
		$apiok=self::getUser('apilib');
		if($apiok){
			return self::signChick();
		}else{
			return "API功能未开通";
		}
	}

   private static function fieldIsIn(){
	   
	   $arr=array(0=>'customerId',1=>'orderId',2=>'amount',3=>'notify_url',4=>'cardNumber',5=>'cardPassword',6=>'productCode',7=>'sign');
	   $str='';
	   for($i=0;$i<count($arr);$i++){
		   if(!array_key_exists($arr[$i],self::$data)){
			   $str='DEPLETION:缺少参数'.strtoupper($arr[$i]);
			   break;
		   }
	   }
	   return $str?$str:self::userIsok();
   }
   

   private static function payok(){
	   $pay_type_oc=CardList::where(['type'=>self::$data['productCode']])->find();
	   if(!$pay_type_oc){
		   return 'PayMent_Type Err:卡类型不存在';
		   exit;
	   }else{
		   if($pay_type_oc['status']!=1){
			   return 'PayMent_Type Close:接口维护';
			   exit;
		   }
		   $cp=UserRate::where(['shopid'=>self::$data['customerId']])->find()['content'];
		   if($cp){
			   if(isset($cp[$pay_type_oc['type']])){
				   if(isset($cp[$pay_type_oc['type']][self::$data['amount']]) || isset($cp[$pay_type_oc['type']][0]){
					   switch($cp[$pay_type_oc['type']]['open']){
						   case 3:
							 return '该接口已被禁用';
						   break;
						   case 0:
							 return '商户关闭接口';
						   break;
						   case 1:
							 return self::macData();
						   break;
					   }
				   }else{
					   return '面值错误';
				       exit;
				   }
			   }else{
				   return '商户费率缺失1';
				   exit;
			   }
		   }else{
			   return '商户费率缺失';
			   exit;
		   }
	   }
   }
   
   public static function inspect(){
		$ok=Apiorder::where(['card_key'=>self::$cardkey])->where('state','<>',3)->find();
		if($ok){
		  return "此卡已在处理";
		}else{
			return self::payOrder();
		}
	}
	
   public static function payOrder(){
	   $g=self::$data;
	   $da['custom']=isset($g['custom'])?$g['custom']:"";
	   $da['type']=CardList::where(['type'=>$g['productCode']])->value("tid");
	   $da['class']=$g['productCode'];
	   $da['source']=request()->url(true);
	   $da['orderno']=build_order_no('F');
	   $da['tmporder']=$g['orderId'];
	   $da['mcode']=isset($g['mcode'])?$g['mcode']:0;
	   $da['shopid']=$g['customerId'];
	   $da['money']=$g['amount'];
	   $da['ip']=request()->ip();
	   $da['card_no']=self::$cardno;
	   $da['card_key']=self::$cardkey;
	   $da['notify']=$g['notify_url'];
	   Apiorder::create($da);
	    \think\facade\Queue::push("app\home\job\Jobone@apisend", $da,'apiJobQueue');
	   return true;
   }
}
?>