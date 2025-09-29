<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\facade\View;
use think\facade\Db;
use think\facade\Request;
use app\common\model\User;
use app\common\model\Withdraw;
use app\common\model\Wechat;
use app\common\model\Userbank;


class Cash extends AdminBase
{
    protected $noAuth = ['index'];
    protected function _initialize()
    {
        parent::_initialize();
    }

    public function index($limit=15)
    {
		if ($this->request->isAjax()) {
			$shop_id = input('shop_id');
			if($shop_id){
				$list = Withdraw::with('preone')->where(['shopid'=> $shop_id])->order('id desc')->paginate($limit);
			}else{
			   $list = Withdraw::with('preone')->order('id desc')->paginate($limit);
			}
			foreach($list as $k=>$v){
				$list[$k]['username']=User::where(['shopid'=>$v['shopid']])->value('username');
				$list[$k]['type']=$v['type']=='alitype'?"支付宝提现":($v['type']=='wxtype'?"微信提现":"银行卡提现");
				$list[$k]['status']=txType($v['status']);
			}
			$this->result($list);
		}
        return $this->fetch('index');
    }

    

    public function edit()
    {
        if ($this->request->isPost()){
            $param = $this->request->param();
            if(isset($param['type']) && isset($param['id'])){
				$result=Withdraw::find($param['id']);
				switch($param['type']){
					case "shou":
					 if($result['status']==1){
					    $ok=Withdraw::where(['id'=>$param['id']])->update(['status'=>2,'content'=>'手动转账']);
					    if($ok && $result['type']=='wxtype'){
					        	$ubank=Userbank::where(['id'=>$result['cid']])->find();
					        	if($ubank){
					        	   $cha=(float)$result['money']-(float)$result['price'];
 $str=$result['shopid']."[".$ubank['user']." ".$ubank['bankname']."]金额:".$result['money']."元,手续费:".$result['price']."元,共合计:".$cha."元";
					        	  $ms=(new Wechat)->wxCash($ubank['accounts'],$str,$cha);
					        	  if($ms['errcode']!='0'){
					        	       $this->error("订单操作成功,微信通知：".$ms['errmsg']);
					        	  }
					        	}
					    }
					 }else{
						 $this->error("该订单当前状态不可操作");
					 }
					break;
					case "auto":
					  if($result['status']==1){
						  Withdraw::where(['id'=>$param['id']])->update(['status'=>0]);
						 $ok=\think\facade\Queue::push("app\home\job\Jobone@tixian", ['orderid'=>$result['order']],'Jobtixian');
					  }else{
						  $this->error("该订单当前状态不可操作");
					  }
					break;
					default:
					 if($result['status']==1){
						 Db::startTrans();
						 try {
							 $str=isset($data['content'])?$data['content']:"[失败退回]";
					         Db::name('withdraw')->where(['id'=>$param['id']])->update(['status'=>3,'content'=>$str]);
							 Db::name('user')->where(['shopid'=>$result['shopid']])->inc('money',$result['money'])->update();
							 addlog(Uid($result['shopid']),$result['money'],3,$result['order'],"[提现退票]{$result['money']}");
							 Db::commit();
							 $ok=true;
						}catch (\Exception $e) {
							Db::rollback();
							$this->error($e->getMessage());
						};
						
					 }else{
						 $this->error("该订单当前状态不可操作");
					 }
				}
				if ($ok == true) {
					$this->success('操作成功','','all');
				} else {
					$this->error($this->errorMsg);
				}
			}
            
        }
        $data = Withdraw::with('preone')->where('id', input('id'))->find();
        return $this->fetch('save', [
            'data' => $data]);
    }

    public function del()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            Withdraw::destroy($param['id'],true);
            insert_admin_log('删除了用户');
            $this->success('删除成功');
        }
    }

   
}
