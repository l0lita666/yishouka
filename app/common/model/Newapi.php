<?php
namespace app\common\model;
use think\Model;
use think\facade\Request;
use app\common\model\Order;
use think\facade\Config;
use think\facade\Db;
use app\common\model\CardList;

class Newapi extends Model
{
    Protected $autoCheckFields = false;
	private $superNew;
	private $typea='';
	
	public function __construct($type) {
	    $this->typea=$type;
	   $class=CardOperator::where(['id'=>$type])->value('class');
	   $className=str_replace("/","","\api\/".$class);
	   if(class_exists($className)){
		   $this->superNew=$className;
	   }else{
		   $this->superNew='';
	   }

	   $this->domain=Db::name("sysconfig")->where(['name'=>'domain'])->value("value");
    }
	
	public function blindSearch($order){//查询功能
		if(method_exists($this->superNew,'blindSearch')){
			$this->superNew=new $this->superNew($order);
			$res=$this->superNew->blindSearch();
			if($res['code']==1){
				successful($order['orderno'],2,$res['amount'],$res['settle'],$res['mianzi'],$res['msg']);
			}elseif($res['code']==-1){
				successful($order['orderno'],3,0,0,0,$res['msg']);
			}
			return $res;
		}else{
			return ['code'=>-1,'msg'=>'接口文件错误'];
		}
	}
	
	public function notify($data){//回掉功能
		if(method_exists($this->superNew,'tonotify')){
			$this->superNew=new $this->superNew($data);
			$res=$this->superNew->tonotify('order');
			if($res['code']==1){
				successful($res['orderno'],2,$res['amount'],$res['settle'],$res['mianzi'],$res['msg']);
			}elseif($res['code']==-1){
				successful($res['orderno'],3,0,0,0,$res['msg']);
			}
			return ['code'=>1,'msg'=>'success'];
		}else{
			return ['code'=>-1,'msg'=>'接口文件错误'];
		}
	}
	
	public function sendData($data){//提交功能
		if(method_exists($this->superNew,'sendData')){
		    $url=$this->domain . "/cardback/action/".$this->typea.".html";
		    $ca=CardList::where(['type'=>$data['class']])->find();
		    if($ca['is_auto']){
    			$this->superNew=new $this->superNew($data);
    			$res=$this->superNew->sendData($url);
		    }else{
		        $res=['code'=>1,'msg'=>'手动处理'];
		    }
			Order::where(['orderno'=>$data['orderno']])->update(['state'=>1]);
			if($res['code']==1){
				successful($data['orderno'],1,0,0,0,$res['msg']);
			}else{
			    successful($data['orderno'],3,0,0,0,$res['msg']);
			}
			return $res;
		}else{
		    if(isset($data['orderno'])) Order::where(['orderno'=>$data['orderno']])->update(['state'=>1,'remarks'=>'接口文件错误']);
			return ['code'=>-1,'msg'=>'接口文件错误'];
		}
	}
}