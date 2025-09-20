<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\facade\View;
use think\facade\Request;
use app\common\model\User as Yonghu;
use app\common\model\UserAuth;
use app\common\model\UserRate;
use app\common\model\UserLog;
use app\common\model\MoneyLog;
use app\common\model\CardList;
use app\common\model\Userbank;


class User extends AdminBase
{
    protected $noAuth = ['getFeilv','log'];
    
    protected function _initialize()
    {
        parent::_initialize();
    }

    public function index($limit=15)
    {
		if ($this->request->isAjax()) {
			$shop_id = input('shop_id');
			if($shop_id){
				$list = Yonghu::with('userReal')->where(['shopid|mobile|username'=> $shop_id])->order('id desc')->paginate($limit);
			}else{
			   $list = Yonghu::with('userReal')->order('id desc')->paginate($limit);
			}
			foreach($list as $k=>$v){
				$list[$k]['retype']=realType($v['userReal']['clas']);
				$list[$k]['assets']=Yonghu::where(['assets'=>$v['id']])->count();
			}
			$this->result($list);
		}
		View::assign("money",Yonghu::sum("money"));
        return $this->fetch('index');
    }

    public function add()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $param['shopid'] = Yonghu::order('id desc')->value('shopid')+1;
            empty($param['password']) && $this->error('密码不能为空');
            //验证规则
            $verify = input('_verify', true);
            if($verify!='0'){
                try{
                    $this->validate($param, 'user');
                }catch (\Exception $e){
                    $this->error($e->getMessage());
                }
            }
			if (empty($param['tradepwd'])) {
				unset($param['tradepwd']);
			}
            $result = Yonghu::create($param);
            if ($result == true) {
                insert_admin_log('添加了用户');
                $this->success('添加成功',url('/user/index'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        return $this->fetch('save', ['userAuthGroup' => []]);
    }
	
	public function txlog(){
		if ($this->request->isPost()) {
            $param = $this->request->param();
            $data = Userbank::update($param);
            if ($data == true) {
                insert_admin_log('修改了用户');
                $this->success('修改成功', url('/user/index'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $data = Userbank::withTrashed()->where(['uid'=>input('id')])->order('create_time desc')->paginate(['list_rows' => 13,'query' => request()->param()]);
		foreach($data as $k=>$v){
			$data[$k]['bankid']=$v['bankid']==-1?"支付宝":($v['bankid']==-2?"微信":"银行卡");
			$data[$k]['state']=$v['delete_time']==0?"正常":"已删除";
			$data[$k]['delete_time']=$v['delete_time']==0?"--":$v['delete_time'];
		}
        return $this->fetch('txlog', [
            'list' => $data]);
	}

    public function edit()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            if (empty($param['password'])) {
                unset($param['password']);
            }
			if (empty($param['tradepwd'])) {
				unset($param['tradepwd']);
			}
            //验证规则
            $verify = input('_verify', true);
            if($verify!='0'){
                try{
                    $this->validate($param, 'user');
                }catch (\Exception $e){
                    $this->error($e->getMessage());
                }
            }
            $data = Yonghu::update($param);
            if ($data == true) {
                insert_admin_log('修改了用户');
                $this->success('修改成功', url('/user/index'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $data = Yonghu::with('userReal')->where('id', input('id'))->find();
        return $this->fetch('save', [
            'data' => $data]);
    }

    public function del()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
			$shopid=Yonghu::find($param['id'])['shopid'];
            Yonghu::destroy($param['id']);
			UserRate::where(['shopid'=>$shopid])->delete();
            insert_admin_log('删除了用户');
            $this->success('删除成功');
        }
    }

    public function export()
    {
        $data = collection(Yonghu::field('id,shopid,username,mobile,money')->order('id desc')->select())->toArray();
        $title=['用户ID','商户号', '用户名', '手机号','账户余额'];
        insert_admin_log('导出了用户');
        export_excel($data,$title, date('YmdHis'));
    }
	
	public function moneylog(){
		if ($this->request->isPost()) {
			MoneyLog::where(['uid'=>input('id')])->delete();
            $this->success('操作成功');
		}
		$list=MoneyLog::where(['uid'=>input('id')])->order('addtime desc')->paginate(['list_rows' => 13,'query' => request()->param()]);
		View::assign('list',$list);
		View::assign('id',input('id'));
		return view();
	}
	
	public function feilv(){
		$id=input('id');
		$cid=input('cid');
		$state=input('state');
		$res=UserRate::where(['shopid'=>$id])->find()['content'];
		if ($this->request->isAjax()) {
			$map=$res;
		   if(isset($map[$cid]['open'])){
			   if($map[$cid]['open']!=3){
				   $map[$cid]['open']=3;
			   }else{
				   $map[$cid]['open']=1;
			   }
			   $ress=UserRate::where(['shopid'=>$id])->find();
			   $ress->content=$map;
			   $ress->save();
			   return json(['code'=>1,'msg'=>'操作成功']);
		   }else{
			   $map[$cid]['open']=3;
			   $ress=UserRate::where(['shopid'=>$id])->find();
			   $ress->content=$map;
			   $ress->save();
			   return json(['code'=>1,'msg'=>'操作成功']);
		   }
		}
		foreach($res as $k=>$v){
			 $map[$k]['title']=CardList::where(['type'=>$k])->value('title');
			 $map[$k]['daima']=$k;
			 $map[$k]['open']=isset($v['open'])?$v['open']:0;
			 $ar=[];
			 $i=0;
			 if(isset($v['class']))unset($v['class']);
			 if(isset($v['open']))unset($v['open']);
			 foreach($v as $kk=>$vv){
				 $ar[$i]['mian']= ($kk=='0')?"自定义":$kk;
				 $ar[$i]['feilv']=$vv;
				 $i++;
			 }
			 $map[$k]['feilv']=$ar;
		 }
		return view('userfeilv',['list'=>$map,'uid'=>$id]);
	}
	public function editfeilv(){
		if ($this->request->isAjax()) {
			$da=input();
			$res=UserRate::where(['shopid'=>$da['id']])->find();
			$map=$res['content'];
			if($da['field']=="自定义")$da['field']=0;
			if(isset($map[$da['cid']][$da['field']])){
			   $map[$da['cid']][$da['field']]=$da['value'];
			   $res->content=$map;
			   $ok=$res->save();
			   if($ok){
				   return json(['code'=>1,'msg'=>'修改成功']);
			   }else{
				   return json(['code'=>-1,'msg'=>'更新失败']);
			   }
			}else{
				return json(['code'=>-1,'msg'=>'参数错误']);
			}
		}
	}
	public function getFeilv(){
		 if ($this->request->isAjax()) {
			 $da=input();
			 $res=UserRate::where(['shopid'=>$da['id']])->find()['content'];
			 $map['title']=CardList::where(['type'=>$da['cid']])->value('title');
			 $map['daima']=$da['cid'];
			 $map['open']=isset($res[$da['cid']]['open'])?$res[$da['cid']]['open']:0;
			 $xarr=$res[$da['cid']];
			 unset($xarr['class']);
			if(isset($xarr['open']))unset($xarr['open']);
			$i=0;
			$ar=[];
			foreach($xarr as $k=>$v){
				 $ar[$i]['mian']=($k=='0')?"自定义":$k;
				 $ar[$i]['feilv']=$v;
				 $ar[$i]['id']=$da['cid'];
				 $ar[$i]['shopid']=$da['id'];
				 $i++;
			 }
			 $map['data']['data']=array_merge($ar);
			 $map['code']=0;
			 $map['msg']='';
			 $map['url']=url('/User/feilv',['id'=>$da['id'],'cid'=>$da['cid']]);
			 $map['data']['count']=count($ar);
			 return $map;
		 }
	}

    public function log()
    {
        $list=\app\common\model\UserLog::with('shop')->where(['shopid'=>input('id')])->order('create_time desc')->paginate(['list_rows' => 13,'query' => request()->param()]);
        return view('log', ['list' => $list]);
    }

    public function truncate()
    {
        if ($this->request->isPost()) {
            UserLog::where('id','>',0)->delete();
            $this->success('操作成功');
        }
    }

    
}
