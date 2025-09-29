<?php
namespace app\api\model;

use think\facadeRequest;
use think\Model;
use app\common\model\User;


class BlindSearch extends Model{
	Protected $autoCheckFields = false;
	
	private static $data;
	private static $user;
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
		$user=User::where(['shopid'=>$shopid])->find();
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
	
	public static function signChick(){
		$ok=md5Verify(self::$data,self::$data['sign'],self::getUser('apikey'));
		if($ok){
		   return true;
		}else{
			return 'SIGN ERROR:sign错误';
		}
	}
	
   private static function fieldIsIn(){
	   
	   $arr=array(0=>'customerId',1=>'orderId',3=>'sign');
	   $str='';
	   for($i=0;$i<count($arr);$i++){
		   if(!array_key_exists($arr[$i],self::$data)){
			   $str='DEPLETION:缺少参数'.strtoupper($arr[$i]);
			   break;
		   }
	   }
	   return $str?$str:self::signChick();
   }
}
?>