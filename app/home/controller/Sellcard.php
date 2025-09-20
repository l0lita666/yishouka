<?php
declare (strict_types = 1);

namespace app\home\controller;


use app\common\controller\UserBase;
use app\common\model\CardModel;
use app\common\model\CardList;
use app\common\model\CardChannel;
use app\common\model\Order;
use app\common\model\UserRate;
use think\facade\View;
use think\Request;
use app\common\model\Card;
use app\common\model\Security;

class Sellcard extends UserBase
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
		$da=input();
		$cid=isset($da['cid'])?$da['cid']:32;
		$id=0;
		if(isset($da['id'])){
			$cid=CardList::where(['id'=>$da['id']])->value('cid');
		}
		$res=CardModel::where(['id'=>$cid])->find();
		View::assign("cid",$cid);
		View::assign("tid",isset($da['id'])?$da['id']:$id);
		View::assign("ress",$res);
        return view('usercard');
    }
	
	public function order(){//点卡订单
	    $da=input();
		$map=["2020-1-1 00:00:00", date('Y-m-d 23:59:59')];
		if(isset($da['starttime']) && isset($da['endtime']) && !empty($da['starttime']) && !empty($da['endtime'])){
			$map=[$da['starttime']." 00:00:00", $da['endtime']." 23:59:59"];
		}elseif(isset($da['day']) && !empty($da['day'])){
			$starttime=date('Y-m-d',strtotime("-{$da['day']}day"));
			$map=[$starttime." 23:59:59", date('Y-m-d 23:59:59')];
		}
		$where['shopid']=session('user_auth.shop_id');
		if(isset($da['rekey']) && !empty($da['rekey'])){
		    if($da['setype']=='card_no' || $da['setype']=='card_key'){
                $res=Security::order("id desc")->find();
                if(!empty($res['datakey'])){
                    $card=new Card($res['datakey']);
                    $value=$card->encrypt($da['rekey']);
                    $da['rekey']=$value;
                }
            }
			$where[$da['setype']]=$da['rekey'];
		}
		if(isset($da['cardype']) && !empty($da['cardype'])){
			$where['class']=$da['cardype'];
		}
		if(isset($da['status']) && !empty($da['status'])){
			$where['state']=$da['status']-1;
		}
		$list=Order::with('bsLei')->field('id,class,batchno,sum(money) as money,sum(amount) as amount,group_concat(state) as state,create_time,group_concat(remarks) as remarks')->where($where)->whereTime('create_time', 'between',$map)->order('id desc')->group('batchno')->paginate(15,false,['query' => request()->param()]);
		foreach($list as $k=>$v){
			$list[$k]['state']=batchno($v->getData('state'));
			$list[$k]['remarks']=batchRemaks($v['remarks']);
		}
		View::assign('setype',input('setype'));
		View::assign('cardype',input('cardype'));
		View::assign('status',input('status'));
		View::assign('clist',CardList::select());
		View::assign("list",$list);
		View::assign("day",isset($da['day'])?$da['day']:0);
		View::assign("starttime",isset($da['starttime'])?$da['starttime']:'');
		View::assign("endtime",isset($da['endtime'])?$da['endtime']:'');
		if(request()->isMobile()){
		    View::assign("empty",'<div class="messager messager-empty"><div class="messager-icon"><i class="iconfont iconfont-empty"></i></div><div class="messager-text"><h2 class="messager-title">暂无记录</h2></div></div>');
			return view('sellcard/wap/order',['title'=>'点卡订单']);
		}else{
		  return view();
		}
	}
	
	public function selldetailinfo(){//订单详情
	    $id=input('id');
		$res=Order::find($id);
	    $result=Order::with('bsLei')->where(['batchno'=>$res['batchno'],'shopid'=>session('user_auth.shop_id')])->order('id desc')->paginate(15,false,['query' => request()->param()]);
		$test=Order::where(['batchno'=>$res['batchno'],'shopid'=>session('user_auth.shop_id')])->select();
		$da=['state'=>'','num'=>0,'ok'=>0,'money'=>0,'err'=>0];
		foreach($test as $k=>$v){
		    $da['state'].=$v['state'].",";
		    $da['num']++;
			if($v->getData('state')==3)$da['err']++;
			if($v->getData('state')==2)$da['ok']++;
			$da['money']+=$v['amount'];
		}
		if($res['update_time']){
			$res['time']=$res['update_time'];
		}elseif($res['chulitime']){
			$res['time']=$res['chulitime'];
		}else{
			$res['time']=$res['create_time'];
		}
		
		View::assign('da',$da);
		View::assign('res',$res);
		View::assign('data',$result);
		if(request()->isMobile()){
			return view('sellcard/wap/selldetailinfo',['title'=>'订单详情']);
		}else{
		  return view();
		}
	}
	
    public function reissued(){
        if($this->request->isPost()){
            $order=input('batchno');
            $list=Order::where([['batchno','=',$order],['uid','=',session('user_auth.user_id')],['state','=',3],['reissed','<',3],['remarks','like','%可再次%']])->select();
            $resnum=0;
            $arr=[];
            foreach($list as $k=>$v){
                $arr[$k]['id']=$v['id'];
                $arr[$k]['reissed']=$v['reissed']+1;
                \think\facade\Queue::push("app\home\job\Jobone@sendCardUrgent", $v,'sendCardUrgentJobQueue');
                $resnum++;
            }
            (new Order)->saveAll($arr);
            if($resnum>0){
                return json(['confirm'=>['width'=>'350', 'prompt'=> "success"],'content'=>"重发{$resnum}条订单",'list'=> [],'type'=>"1"]);
            }else{
                return json(['confirm'=>['width'=>'350', 'prompt'=> "warning"],'content'=>"重发失败，无失败订单",'list'=> [],'type'=>"1"]);
            }

        }
    }
	
	
	public function statistics(){
		$da=input();
		$map=["2020-1-1 00:00:00", date('Y-m-d 23:59:59')];
		if(isset($da['starttime']) && isset($da['endtime']) && !empty($da['starttime']) && !empty($da['endtime'])){
			$map=[$da['starttime']." 00:00:00", $da['endtime']." 23:59:59"];
		}elseif(isset($da['day']) && !empty($da['day'])){
			$starttime=date('Y-m-d',strtotime("-{$da['day']}day"));
			$map=[$starttime." 23:59:59", date('Y-m-d 23:59:59')];
		}
		$where['shopid']=session('user_auth.shop_id');
		$list=Order::field("FROM_UNIXTIME(create_time, '%Y-%m-%d') as datetime,group_concat(id) as ids")->where($where)->whereTime('create_time','between',$map)->group('FROM_UNIXTIME(create_time,"%Y-%m-%d")')->order("id desc")->paginate(15,false,['query' => request()->param()]);
		foreach($list as $k=>$v){
		
		    $list[$k]['id']=Order::where('shopid','=',session('user_auth.shop_id'))->whereDay('create_time',$v['datetime'])->count();
		    $list[$k]['summoney']=Order::where('shopid','=',session('user_auth.shop_id'))->whereDay('create_time',$v['datetime'])->sum("money");
			$list[$k]['okcount']=Order::where([['state','=','2'],['shopid','=',session('user_auth.shop_id')]])->whereDay('create_time',$v['datetime'])->count();
			$list[$k]['okmian']=Order::where([['state','=','2'],['shopid','=',session('user_auth.shop_id')]])->whereDay('create_time',$v['datetime'])->sum("money");
			$list[$k]['okmoney']=Order::where([['state','=','2'],['shopid','=',session('user_auth.shop_id')]])->whereDay('create_time',$v['datetime'])->sum("amount");
			$list[$k]['failcount']=Order::where([['state','=','3'],['shopid','=',session('user_auth.shop_id')]])->whereDay('create_time',$v['datetime'])->count();
			$list[$k]['failmian']=Order::where([['state','=','3'],['shopid','=',session('user_auth.shop_id')]])->whereDay('create_time',$v['datetime'])->sum("money");
			$list[$k]['loadcount']=Order::where([['state','in','0,1'],['shopid','=',session('user_auth.shop_id')]])->whereDay('create_time',$v['datetime'])->count();
			$list[$k]['loadmian']=Order::where([['state','in','0,1'],['shopid','=',session('user_auth.shop_id')]])->whereDay('create_time',$v['datetime'])->sum("money");
		}
		View::assign("list",$list);
		View::assign("day",isset($da['day'])?$da['day']:0);
		View::assign("starttime",isset($da['starttime'])?$da['starttime']:'');
		View::assign("endtime",isset($da['endtime'])?$da['endtime']:'');
		if(request()->isMobile()){
		    View::assign("empty",'<div class="messager messager-empty"><div class="messager-icon"><i class="iconfont iconfont-empty"></i></div><div class="messager-text"><h2 class="messager-title">暂无记录</h2></div></div>');
			return view('sellcard/wap/statistics',['title'=>'订单统计']);
		}else{
		  return view();
		}
	}
	
	 public function export()
    {
		$da=input();
		$map=["2020-1-1 00:00:00", date('Y-m-d 23:59:59')];
		if(isset($da['starttime']) && isset($da['endtime']) && !empty($da['starttime']) && !empty($da['endtime'])){
			$map=[$da['starttime']." 00:00:00", $da['endtime']." 23:59:59"];
		}elseif(isset($da['day']) && !empty($da['day'])){
			$starttime=date('Y-m-d',strtotime("-{$da['day']}day"));
			$map=[$starttime." 23:59:59", date('Y-m-d 23:59:59')];
		}
		$where['shopid']=session('user_auth.shop_id');
		if(isset($da['rekey']) && !empty($da['rekey'])){
			$where[$da['setype']]=$da['rekey'];
		}
		if(isset($da['cardype']) && !empty($da['cardype'])){
			$where['class']=$da['cardype'];
		}
		if(isset($da['status']) && !empty($da['status'])){
			$where['state']=$da['status']-1;
		}
		$list=Order::with('bsLei')->field('id,class,batchno,card_no,card_key,money,settle_amt,amount,state,remarks,create_time,update_time')->where($where)->whereTime('create_time', 'between',$map)->order('id desc')->select();
		$map=[];
		foreach($list as $k=>$v){
			$map[$k]['id']=$v['id'];
			$map[$k]['batchno']='&nbsp;'.$v['batchno'];
			$map[$k]['title']=$v['title'];
			$map[$k]['card_no']='&nbsp;'.$v['card_no'];
			$map[$k]['card_key']='&nbsp;'.$v['card_key'];
			$map[$k]['money']=$v['money'];
			$map[$k]['settle_amt']=$v['settle_amt'];
			$map[$k]['amount']=$v['amount'];
			$map[$k]['state']=$v['state'];
			$map[$k]['remarks']=batchRemaks($v['remarks']);
			$map[$k]['create_time']=$v['create_time'];
			$map[$k]['update_time']=$v['update_time'];
		}
        $title=['ID','订单号','卡类', '卡号', '卡密','提交金额','实际面值','结算金额','状态','备注','提交时间','处理时间'];
        export_excel($map, $title,"导出卡".date('YmdHis'));
    }	
    
}
