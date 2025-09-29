<?php
declare (strict_types = 1);

namespace app\api\controller;
use app\api\model\Mign;
use app\api\model\BlindSearch;
use app\common\model\Apiorder;
use app\api\model\Apipay;

class Index
{
    public function index()
    {
        $api=New Mign(input());
		$res=$api->index();
		if($res===true){
			return json(['code'=>1,'message'=>'接收成功']);
		}else{
			return json(['code'=>2,'message'=>$res]);
		}
    }
	
	public function blindSearch(){
		$data=input();
		$api=New BlindSearch($data);
		$res=$api->index();
		if($res===true){
			$res=Apiorder::where(['tmporder'=>$data['orderId']])->find();
			if($res){
				    $map['customerId']=$res['shopid'];
					$map['orderId']=$res['tmporder'];
					$map['systemOrderId']=$res['orderno'];
				switch($res['state']){
					case 0:
					  $map['code']=3;
					  $map['message']='等待验证';
					  $map['status']=0;
					break;
					case 1:
					  $map['code']=3;
					  $map['message']='正在处理';
					  $map['status']=1;
					break;
					case 2:
					  $map['code']=1;
					  $map['status']=2;
					  $map['amount']=$res['money'];
					  $map['successAmount']=$res['settle_amt'];
					  $map['actualAmount']=$res['amount'];
					  $map['successTime']=date("Y/m/d H:i:s");
					  $map['message']=$res['remarks'];
					  $map['extendParams']=$res['custom'];
					  $map['realPrice']=$res['xitmoney'];
					break;
					case 3:
					  $map['code']=3;
					  $map['message']=$res['remarks'];
					  $map['status']=3;
					break;
				}
				return xml($map);
			}else{
				return xml(['code'=>2,'message'=>$res],201);
			}
		}else{
			return xml(['code'=>2,'message'=>$res],201);
		}
	}
	
	public function miss(){
		echo "fail";
	}
	
	public function callback(){
		$da=input();
		logt(json_encode($da));
		if(isset($da['action'])){
			$api=new Apipay($da['action']);
			$code=$api->notify($da);
			exit($code['msg']);
		}else{
			exit('fail');
		}
	}
}
