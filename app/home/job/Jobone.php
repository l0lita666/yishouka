<?php
namespace app\home\job;

use think\queue\Job;
use app\common\model\UserLog;
use app\home\job\Withdrawals;
use app\common\model\Newapi;
use app\home\job\Order;
use app\api\model\Apipay;

class Jobone{
    
    public function sendCard(Job $job, $data){
   
          if(empty($data) || !is_array($data)){
             $job->delete();
           }
		   $api=new Newapi(isset($data['type'])?$data['type']:0);
		   $ok=$api->sendData($data);
		   $job->delete();
		   
		  if ($job->attempts() > 3) {
			    successful($data['id'],1,0,0,0,"任务重试3次失败,请检测接口");
				$job->delete();
		   }
    }
	
	public function apisend(Job $job, $data){
   
          if(empty($data) || !is_array($data)){
             $job->delete();
           }
		   $api=new Apipay(isset($data['type'])?$data['type']:0);
		   $ok=$api->sendData($data);
				$job->delete();
		   
		  if ($job->attempts() > 3) {
			    successful($data['id'],1,0,0,0,"任务重试3次失败,请检测接口");
				$job->delete();
		   }
    }
	public function sendCardUrgent(Job $job, $data){
   
          if(empty($data) || !is_array($data)){
             $job->delete();
           }
		   $api=new Newapi(isset($data['type'])?$data['type']:0);
		   $ok=$api->sendData($data);
	
				$job->delete();
		   
		  if ($job->attempts() > 3) {
			    successful($data['id'],1,0,0,0,"任务重试3次失败,请检测接口");
				$job->delete();
		   }
    }
	
	public function sendPost(Job $job, $data){//回掉发送队列
          if(empty($data) || !is_array($data)){
             $job->delete();
           }
		   echo "回掉订单".$data['id'];
		   $api=new Order();
		   $ok=$api->getOrder($data['id']);
		   if($ok || $job->attempts()>4){
				$job->delete();
		   }else{
			    $num=$job->attempts();
				$num=$num<=0?1:$num;
			    $job->release($num*10);//任务失败3秒后重试
		   }
		   
    }
    
    public function tixian(Job $job, $data){//提现任务
		if(empty($data) || !is_array($data)){
             $job->delete();
           }
		   echo "执行任务".$data['orderid'];
			$with=new Withdrawals();
			$ok=$with->getOrder(isset($data['orderid'])?$data['orderid']:0); 
		    $job->delete();
		   
    }
	
	public function getAdress(Job $job, $data){//登陆ip获取任务
		if(empty($data) || !is_array($data)){
             $job->delete();
           }
		   echo "执行任务".$data['id'];
		 $ok=$this->ProcessIp(isset($data['id'])?$data['id']:0); 
         if($ok){
			    $job->delete();
		   }else{
			   $job->release(3);//任务失败3秒后重试
		   }
	}
	
	public function ProcessIp($id){
			$res=UserLog::where(['id'=>$id])->where('area','null')->find();
			if($res){
				$res=$res->toArray();
				$adress=UserLog::where(['ip'=>$res['ip']])->whereNotNull('area')->value('area');
				if(empty($adress)){
					$adress=sendToAddress($res['ip']);
				}
				UserLog::where(['id'=>$id])->update(['area'=>$adress]);
			}
			return true;
	}

}
