<?php
namespace app\api\model;
use think\Model;
use think\facade\Request;
use app\common\model\Apiorder;
use app\common\model\CardOperator;
use think\facade\Config;

class Apipay extends Model
{
    Protected $autoCheckFields = false;
	private $card;
	private $typea='';
	
	public function __construct($type) {
	   $this->typea=$type;
	   $class=CardOperator::where(['id'=>$type])->value('class');
	   $className=str_replace("/","","\api\/".$class);
	   if(class_exists($className)){
		   $this->card=$className;
	   }else{
		   $this->card='';
	   }
	   $pp=Config::load('admin/website','domain');
	   $this->domain=$pp['domain'];
    }
	
	public function blindSearch($order){//查询功能
		if(method_exists($this->card,'blindSearch')){
			$this->card=new $this->card($order);
			$res=$this->card->blindSearch();
			if($res['code']==1){
				succorder($res['orderno'],2,$res['amount'],$res['settle'],$red['mianzi'],$res['msg']);
			}elseif($res['code']==-1 && isset($res['orderno'])){
				succorder($res['orderno'],3,0,0,0,$res['msg']);
			}
			return $res;
		}else{
			return ['code'=>-1,'msg'=>'接口文件错误'];
		}
	}
	
	public function notify($data){//回掉功能
		if(method_exists($this->card,'tonotify')){
			$this->card=new $this->$this->card($data);
			$res=$this->card->tonotify('apiorder');
			if($res['code']==1){
				succorder($res['orderno'],2,$res['amount'],$res['settle'],$red['mianzi'],$res['msg']);
			}elseif($res['code']==-1){
				succorder($res['orderno'],3,0,0,0,$res['msg']);
			}
			 \think\facade\Queue::push("app\home\job\Jobone@sendPost",['id'=>$res['orderno']],'sendPostJobQueue');
			return 'success';
		}else{
			return ['code'=>-1,'msg'=>'接口文件错误'];
		}
	}
	
	public function sendData($data){//提交功能
		if(method_exists($this->card,'sendData')){
		    $url=$this->domain . "api/cardback/action/".$this->typea.".html";
			$ca=CardList::where(['type'=>$data['class']])->find();
			if($ca['is_auto']){
				$this->card=new $this->card($data);
				$res=$this->card->sendData($url);
			}else{
				$res=['code'=>1,'msg'=>'处理中'];
			}
			Apiorder::where(['orderno'=>$data['orderno']])->update(['state'=>1]);
			if($res['code']==1){
				succorder($data['orderno'],1,0,0,0,$res['msg']);
			}else{
			   succorder($data['orderno'],3,0,0,0,$res['msg']);
			}
			return $res;
		}else{
		    if(isset($data['orderno']))	Apiorder::where(['orderno'=>$data['orderno']])->update(['state'=>1,'remarks'=>'接口文件错误']);
			return ['code'=>-1,'msg'=>'接口文件错误'];
		}
	}
}