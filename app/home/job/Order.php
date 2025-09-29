<?php
namespace app\home\job;

use think\facade\Config;
use app\common\model\Apiorder as Orders;
use app\common\model\Card;
use app\common\model\User;

class Order{
	protected $order;
	protected $card;
	protected $key;
	
	
	
	public function getOrder($orderid){
		$order=Orders::where(['id|orderno'=>$orderid])->find();
		if($order){
			$user=User::where(['shopid'=>$order['shopid']])->find();
			$this->key=$user['apikey'];
			$this->card=New Card(base64_encode($user['apides']));
			$this->order=$order;
			return $this->send();
		}else{
			return true;
		}
	}
	
	private function send(){
		$map['customerId']=$this->order['shopid'];
		$map['orderId']=$this->order['tmporder'];
		$map['systemOrderId']=$this->order['orderno'];
		$map['status']=$this->order['state'];
		$map['cardNumber']=$this->card->encrypt($this->order['card_no']);
		$map['cardPassword']=$this->card->encrypt($this->order['card_key']);
		$map['amount']=$this->order['money'];
		$map['successAmount']=$this->order['settle_amt'];
		$map['actualAmount']=$this->order['amount'];
		$map['successTime']=date("Y/m/d H:i:s");
		$map['message']=$this->order['remarks'];
		$map['extendParams']=$this->order['custom'];
		$map['realPrice']=$this->order['xitmoney'];
		$sign=md5Verify($map,$this->key);
		$map['sign']=$sign;;
		if(!empty($this->order['notify'])){
		  $ok=vpost($this->order['notify'],$map);
		  (new Orders)->where(['id'=>$this->order['id']])->update(['tongzhi'=>$ok]);
		  if($ok!='SUCCESS'){
			  return false;
		  }else{
			  return true;
		  }
		}else{
			(new Orders)->where(['id'=>$this->order['id']])->update(['tongzhi'=>'回掉路径为空']);
			return true;
		}
	}
    
   
}
