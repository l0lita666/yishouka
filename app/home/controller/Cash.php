<?php
declare (strict_types = 1);

namespace app\home\controller;

use think\Request;
use think\facade\View;
use think\facade\Db;
use think\facade\Config as Con;
use app\common\controller\UserBase;
use app\common\model\Withdraw;
use app\common\model\User;
use app\common\model\Userbank;

class Cash extends UserBase
{
	private $pei;
	
	public function initialize()
     {
        parent::initialize();
		$this->pei=Con::load('setting/cash','cash');
		View::assign("pei",$this->pei);
	 }
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        if($this->pei['alitype']!=1)$this->redirect(url('home/Cash/bank'));
		View::assign("list",Userbank::where(['bankid'=>-1])->where(['uid'=>$this->user['id']])->select());
		View::assign("ok",Userbank::where(['bankid'=>-1])->where(['uid'=>$this->user['id']])->count());
		if(request()->isMobile()){
			return view('cash/wap/index',['title'=>'提现中心']);
		}else{
          return view();
		}
    }
	
	public function bank()
    {
		View::assign("list",Userbank::with('img')->where('bankid','>',0)->where(['uid'=>$this->user['id']])->select());
		View::assign("ok",Userbank::where('bankid','>',0)->where(['uid'=>$this->user['id']])->count());
        if(request()->isMobile()){
			return view('cash/wap/bank',['title'=>'提现中心']);
		}else{
          return view();
		}
    }
	
	public function weixin()
    {
        if($this->pei['wxtype']!=1)$this->redirect(url('home/Cash/bank'));
		View::assign("list",Userbank::where('bankid','=',-2)->where(['uid'=>$this->user['id']])->select());
		View::assign("ok",Userbank::where('bankid','=',-2)->where(['uid'=>$this->user['id']])->count());
        if(request()->isMobile()){
			return view('cash/wap/weixin',['title'=>'提现中心']);
		}else{
          return view();
		}
    }
	
	public function withdraw(){
		if ($this->request->isAjax()){
			$data=input();
			try{
//				$this->validate($data, 'cash');
            }catch (\Exception $e){
				$str=$e->getMessage();
				$res=getArr($str);
				return json(["tip"=>$res[0],"content"=>$res[1],'token'=>token()]);
            }
            
			$orderid=build_order_no();
			$map['order']=$orderid;
			$map['shopid']=session('user_auth.shop_id');
			$map['money']=$data['moneyoff'];
			$map['cid']=$data['bank_id'];
			$map['type']=$data['type']=='bank'?'banktype':($data['type']=='alipay'?'alitype':'wxtype');
			$map['price']=charges($data['moneyoff'],$data['type']);
			$map['umoney']=$this->user['money']-$data['moneyoff'];
			$map['status']=0;
			$okk=withdraw::where([['shopid','=',$map['shopid']],['status','in','0,1']])->find();
			if($okk){
//			    return ['code'=>'#moneyoff','msg'=>'你还有一笔提现正在处理'];
                return json(['confirm'=>['name'=> "提现申请失败！", 'width'=>400, 'prompt'=> "warning",'time'=>2,'url'=>'/act_cash.html'],'content'=>'你还有一笔提现正在处理...']);
			}else{
			    $yuer=User::where(['id'=>session('user_auth.user_id')])->value('money');
//			    if($yuer<(int)$data['moneyoff'])return ['code'=>'#moneyoff','msg'=>'余额不足'];
			    if($yuer<(int)$data['moneyoff'])return json(['confirm'=>['name'=> "提现申请失败！", 'width'=>400, 'prompt'=> "warning",'time'=>2,'url'=>'/act_cash.html'],'content'=>'账户余额不足']);
    			$ok=(new Withdraw)->save($map);
    			User::where(['id'=>session('user_auth.user_id')])->dec('money',(int)$data['moneyoff'])->update();
    			if($ok){
        				$cha=(int)$data['moneyoff']-(int)$map['price'];
        				addlog(session('user_auth.user_id'),-(int)$data['moneyoff'],1,$orderid,"[商户结算]{$cha}");
        			if($data['type']=='alitype' && $this->pei['alish']==0){
        				   \think\facade\Queue::push("app\home\job\Jobone@tixian", ['orderid'=>$orderid],'Jobtixian');
        				}elseif($map['type']=='wxtype' && $this->pei['wxsh']==0){
        					\think\facade\Queue::push("app\home\job\Jobone@tixian", ['orderid'=>$orderid],'Jobtixian');
        				}elseif(isset($this->pei['banksh']) && $map['type']=="banktype" && $this->pei['banksh']==0){
        				    \think\facade\Queue::push("app\home\job\Jobone@tixian", ['orderid'=>$orderid],'Jobtixian');
        				}else{
        					(new Withdraw)->where(['order'=>$orderid])->update(['status'=>1]);
        				}

                        // 飞书提醒管理员有新的销卡待审记录
                        $webhook = 'https://open.feishu.cn/open-apis/bot/v2/hook/eb778920-23e4-4c16-b4a1-56f6edbe49cc';
                        $fs_con = "【订单提醒】\n刚刚有1个新的提现订单提交，请前往处理\n时间：" . date('Y-m-d H:i:s');
                        $message = [
                            'msg_type' => 'text',
                            'content' => [
                                'text' => $fs_con
                            ]
                        ];
                        $result = sendFeiShuRobot($webhook, $message);
                        $code_log=[
                            'type'=>2,
                            'content'=>$fs_con,
                            'create_time'=>time(),
                            'edit_time'=>time()+300,
                            'status'=>$result['code'] == 0 ? 1 : 2
                        ];
                        Db::name('fs_msg_log')->insert($code_log);

        				return json(['confirm'=>['name'=> "提现申请成功！", 'width'=>400, 'prompt'=> "success",'time'=>1,'url'=>'/act_cashrecords.html'],'content'=>'操作成功....']);
        			}else{
        				return json(["tip"=>"#anjian","content"=>"",'token'=>token()]);
        			}
    		}
			
		}
	}
	   
	public function cashrecords(){
		$da=input();
		$map=["2020-1-1 00:00:00", date('Y-m-d 23:59:59')];
		if(isset($da['starttime']) && isset($da['endtime']) && !empty($da['starttime']) && !empty($da['endtime'])){
			$map=[$da['starttime']." 00:00:00", $da['endtime']." 23:59:59"];
		}elseif(isset($da['day']) && !empty($da['day'])){
			$starttime=date('Y-m-d',strtotime("-".$da['day']."day"));
			$map=[$starttime." 00:00:00", date('Y-m-d 23:59:59')];
		}
		$list=Withdraw::with('preone')->where(['shopid'=>session('user_auth.shop_id')])->whereTime('create_time', 'between',$map)->order('id desc')->paginate(10,false,['query' => request()->param()]);
		$money=0;
		foreach($list as $k=>$v){
			$list[$k]['type']=$v['type']=='alitype'?"支付宝提现":($v['type']=='wxtype'?"微信提现":"银行卡提现");
			$money+=$v['money'];
			$list[$k]['status']=txType($v['status']);
		}
		View::assign("money",$money);
		View::assign("list",$list);
		View::assign("day",isset($da['day'])?$da['day']:0);
		View::assign("starttime",isset($da['starttime'])?$da['starttime']:'');
		View::assign("endtime",isset($da['endtime'])?$da['endtime']:'');
		if(request()->isMobile()){
			View::assign("empty",'<div class="messager messager-empty"><div class="messager-icon"><i class="iconfont iconfont-empty"></i></div><div class="messager-text"><h2 class="messager-title">暂无提现记录</h2></div></div>');
			return view('cash/wap/cashrecords',['title'=>'提现记录']);
		}else{
		  return view();
		}
	}

    
}
