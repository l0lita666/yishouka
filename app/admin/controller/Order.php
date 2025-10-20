<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\facade\View;
use think\facade\Db;
use think\facade\Request;
use app\common\model\Order as Orders;
use app\common\model\Admin;
use app\common\model\CardChannel;
use app\common\model\CardList;
use app\common\model\User;
use app\common\model\CardOperator;
use app\common\model\Newapi;
use app\common\model\Card;
use app\common\model\Security;


class Order extends AdminBase
{
    protected function _initialize()
    {
        parent::_initialize();
    }

    public function index($limit=15)
    {
		if ($this->request->isAjax()){
			$da=input();
			$where[]=['id','>',0];
			
			$map=["2020-1-1 00:00:00", date('Y-m-d 23:59:59')];
			if(isset($da['st']) && isset($da['se']) && !empty($da['st']) && !empty($da['se'])){
				$map=[$da['st'], $da['se']];
			}
			if(!empty($da['name']) && !empty($da['kk'])){
				if($da['kk']=="card_no" || $da['kk']=="card_key"){
					$res=Security::order("id desc")->find();
					if(!empty($res['datakey'])){
						$card=new Card($res['datakey']);
						$value=$card->encrypt($da['name']);
						$where[]=[$da['kk'],'=',$value];
					}else{
						$where[]=[$da['kk'],'=',$da['name']];
					}
				}elseif($da['kk']=='shopid') {
				    $uid=User::where(['shopid'=>$da['name']])->find()['id'];
                    $where[]=['uid','=',$uid];
                }else{
                        $where[]=[$da['kk'],'=',$da['name']];
                    }
			}

			if(!empty($da['state'])){
			   $where[]=['state','=',$da['state']-1];
			}
			if(!empty($da['classa'])){
				$where[]=['class','=',$da['classa']];
			}
			$list=Orders::with('bsLei')->where($where)->whereTime('create_time', 'between',$map)->order('id desc,jiajiok desc')->paginate($limit,false,['query' => request()->param()]);
			foreach($list as $k=>$v){
			    if(session('admin_auth.admin_id')!=$v['qiang'] && session('admin_auth.admin_id')!=1){
			        $list[$k]['card_no']='********';
			        $list[$k]['card_key']='********';
			    }
				$list[$k]['remarks']=$v['remarks'];
				$name=Admin::find($v['qiang']);
				$list[$k]['qian']=($v['qiang']>0)?($v['qiang']==session('admin_auth.admin_id'))?'<button class="layui-btn layui-btn-danger" style="height:26px;line-height:26px">自己</button>':'<button class="layui-btn layui-btn-disabled" style="height:26px;line-height:26px">'.$name['username'].'</button>':'<button class="layui-btn ajax-action" style="height:26px;line-height:26px" href="'.url('/Order/qiang',['id'=>$v['id']]).'" >抢单</button>';
				$user=User::where(['shopid'=>$v['shopid']])->find();
				$list[$k]['uname']=!empty($user['username'])?$user['username']:$user['mobile'];
				$list[$k]['atime']=date("Y-m-d",strtotime($v['create_time']))."</br>".date("H:i:s",strtotime($v['create_time']));
				$list[$k]['oper']=CardOperator::find($v['type'])['name'];
			}
			$this->result($list);
		}
		$li=CardList::select();
        return $this->fetch('index',['id'=>session('admin_auth.admin_id'),'admin'=>Admin::where('id','>',1)->where(['status'=>1])->select(),'li'=>$li]);
    }
	
	public function qiang(){
		if ($this->request->isPost()) {
			$da=input("id");
			$ok=Orders::find()['qiang'];
			if($ok>0){
				$this->error('该单已经被抢，请重新选择');
			}else{
				(new Orders)->where(['id'=>$da])->update(['qiang'=>session('admin_auth.admin_id')]);
				$this->success('抢单成功，请操作',url('/Order/index'));
			}
		}
	}
	
	public function setStatus(){
		if ($this->request->isPost()) {
			$da=input();
			$order=Orders::find($da['id']);
			$state=$order->getData('state');
			if($order['qiang']==session('admin_auth.admin_id')){
                //暂时跳过验证，直接将卡等待验证状态改为处理中
                if ($state == 0){
                    (new Orders)->where(['id'=>$da])->update(['state'=>1]);
                    $state = 1;
                }
				switch($da['type']){
					case 'error':
					 if($state!=3 && $state!=0){
					     $ok=successful($da['id'],3);
					 }else{
						 return json(['code'=>-1,'msg'=>'当前状态已经失败或未验证']);
					 }
					break;
					case 'success':
					  if($state!=2 && $state!=0){
					    $ok=successful($da['id']);
					  }else{
						return json(['code'=>-1,'msg'=>'当前状态已经成功或未验证']);
					  }
					break;
					case 'peifuok':
					  try{
						  if($state!=2 && $state!=0){
							  $order->type=$da['op'];
							  $order->money=$da['amt'];
							  $isok=$order->save();
							  if($isok){
						        $ok=successful($da['id'],2,$da['xitmoney'],$da['mianzi'],$da['mianzi']);
							  }else{
								  return json(['code'=>-1,'msg'=>'更新数据失败']);
							  }
						  }else{
							return json(['code'=>-1,'msg'=>'当前状态已经成功或未验证']);
						  }
					  }catch (\Exception $e) {
						  $this->error($e->getMessage());
					  }
					break;
					case 'peifuerr':
					  try{
						  if($state!=3 && $state!=0){
							  $order->type=$da['op'];
							  $isok=$order->save();
							  if($isok){
						        $ok=successful($da['id'],3,0,0,0,$da['str']);
							  }else{
								  return json(['code'=>-1,'msg'=>'更新数据失败']);
							  }
						  }else{
							return json(['code'=>-1,'msg'=>'当前状态已经成功或未验证']);
						  }
					  }catch (\Exception $e) {
						  return json(['code'=>-1,'msg'=>$e->getMessage()]);
					  }
					break;
				}
				if($ok===true){
					$this->success('设置订单状态成功',url('/Order/index'));
				}else{
					return json(['code'=>-1,'msg'=>'操作失败,错误原因:'.$ok]);
				}
			}else{
				return json(['code'=>-1,'msg'=>'请先抢单,再操作']);
			}
		}
	}
	public function peifu(){
		$res=Orders::with('bsLei')->where(['id'=>input('id')])->find();
		$res['atype']=CardOperator::where(['id'=>$res['type']])->value('name');
		$res['classa']=CardList::where(['type'=>$res['class']])->value('title');
		if(session('admin_auth.admin_id')!=$res['qiang'] && session('admin_auth.admin_id')!=1){
		            $res['card_no']='********';
			        $res['card_key']='********';
			    }
		View::assign('res',$res);
		View::assign('op',CardOperator::select());
		return view();
	}
	public function findorder(){
		if ($this->request->isPost()) {
			$id=input('id');
			$order=Orders::find($id);
			$api=new Newapi($order['type']);
			$ok=$api->blindSearch($order);
			if($ok['code']==1){
				$this->success($ok['msg']);
			}else{
				$this->error($ok['msg']);
			}
		}
	}
    public function add()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $result = Banks::create($param);
            if ($result == true) {
                $this->success('添加成功',url('/Bank/index'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        return $this->fetch('save');
    }
	public function pic(){
		$id=input('id');
		return view('pic',['img'=>Orders::find($id)['card_no']]);
	}
	
	public function zhipai(){
		 if ($this->request->isPost()) {
			 $da=input();
			 $admin=Admin::find($da['uid']);
			 if($admin){
				 if($admin['status']==1){
					 $order=Orders::where([['id','in',$da['ids']],['qiang','=',0]])->select();
					 $map=[];
					 foreach($order as $k=>$v){
						 $map[$k]['id']=$v['id'];
						 $map[$k]['qiang']=$da['uid'];
					 }
					 (new Orders)->saveAll($map);
					 $this->success('指派成功');
				 }else{
					 $this->error("管理员状态异常");
				 }
			 }else{
				  $this->error("管理员不存在");
			 }
		 }
	}
	public function batchOrder(){
		 if ($this->request->isPost()) {
			 $da=input();
			 if($da['type']=='del'){
				 Db::name('order')->delete($da['ids']);
				 $this->success('删除成功');
			  }elseif($da['type']=="rest"){
				  $order=Orders::where([['id','in',$da['ids']],['state','in',[1,3]]])->select();
				  $count=count($da['ids']);
				  $ok=count($order);
				  foreach($order as $k=>$v){
				   \think\facade\Queue::push("app\home\job\Jobone@sendCard", $v,'sendCardJobQueue');
				  }
				  $this->success("本次共{$count}条订单，状态适合重试的订单{$ok}条，发布重试任务成功");
			  }elseif($da['type']=="success"){
			      $list=Orders::where('id','in',$da['ids'])->select();
			      $count=count($da['ids']);
			      $ok=0;
			      foreach($list as $k=>$v){
			           $state=$v->getData('state');
			           if($state!=2 && $state!=0){
					       successful($v['id']);
					       $ok++;
					  }
			      }
			      $this->success("本次共{$count}条订单，状态适合成功的订单{$ok}条，批量设置成功");
			  }elseif($da['type']=="chaxun"){
			      $list=Orders::where('id','in',$da['ids'])->select();
			      foreach($list as $v){
            			$api=new Newapi($v['type']);
            			$ok=$api->blindSearch($v);
			      }
			      $count=count($da['ids']);
			      $this->success("本次共查询{$count}条订单，批量查询成功");
			  }else{
				  $this->error("参数错误");
			  }
		 }
	}

    public function edit()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
			$id=$param['id'];
			unset($param['id']);
			unset($param['_verify']);
            $data = Banks::where(['id'=>$id])->update($param);
            if ($data == true) {
                $this->success('修改成功', url('/Bank/index'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $data = Banks::where(['id'=>input('id')])->find();
        return view('save', [
            'data' => $data]);
    }

    public function del()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            Orders::destroy(isset($param['id'])?$param['id']:$param['ids']);
            $this->success('删除成功');
        }
    }
	
	public function export()
    {
		$data=input();
		$map=["2020-1-1 00:00:00", date('Y-m-d 23:59:59')];
		if(isset($data['st']) && isset($data['se']) && !empty($data['st']) && !empty($data['se'])){
				$map=[$data['st'], $data['se']];
			}
		$where[]=['id','>',0];
		if(!empty($data['name']) && !empty($data['kk'])){
		   $where[]=[$data['kk'],'=',$data['name']];
		}
		if(!empty($data['state'])){
		   $where[]=['state','=',$data['state']-1];
		}
		if(!empty($data['classa'])){
			$where[]=['class','=',$data['classa']];
		}
		$list=Orders::with('bsLei')->where($where)->whereTime('create_time', 'between',$map)->order('id desc')->select();
		$map=[];
		foreach($list as $k=>$v){
		    if(isset($data['type'])){
		        $map[$k]['card_no']='&nbsp;'.$v['card_no'];
    			$map[$k]['card_key']='&nbsp;'.$v['card_key'];
		    }else{
    			$map[$k]['shopid']=$v['shopid'];
    			$map[$k]['uname']=User::where(['shopid'=>$v['shopid']])->value('username');
    			$map[$k]['orderno']='&nbsp;'.$v['orderno'];
    			$map[$k]['title']=$v['title'];
    			$map[$k]['card_no']='&nbsp;'.$v['card_no'];
    			$map[$k]['card_key']='&nbsp;'.$v['card_key'];
    			$map[$k]['money']=$v['money'];
    			$map[$k]['settle_amt']=$v['settle_amt'];
    			$map[$k]['amount']=$v['amount'];
    			$map[$k]['state']=$v['state'];
    			$map[$k]['ip']=$v['ip'];
    			$map[$k]['remarks']=$v['remarks']?$v['remarks']:'--';
    			$map[$k]['create_time']=$v['create_time'];
    			$map[$k]['update_time']=$v['update_time'];
		    }
		}
		if(isset($data['type'])){
		     $title=['卡号', '卡密'];
		}else{
            $title=['会员ID','用户名','系统订单号','卡类', '卡号', '卡密','提交金额','实际面值','结算金额','状态','提交IP','备注','提交时间','处理时间'];
		}
        export_excel($map, $title,"点卡数据".date('Y-m-d'));
    }	
    
}
