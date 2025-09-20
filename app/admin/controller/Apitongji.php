<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\facade\View;
use think\facade\Request;
use app\common\model\Apiorder;
use app\common\model\User;
use app\common\model\CardList;
use app\common\model\CardOperator;
use app\common\model\Withdraw;

class Apitongji extends AdminBase
{
    

    public function index($limit=15)
    {
		if ($this->request->isAjax()){
			$da=input();
			$list=array();
			$da['STime']=isset($da['STime'])?(!empty($da['STime'])?$da['STime']:"2010-01-12 00:00:00"):"2010-01-12 00:00:00";
			$da['ETime']=isset($da['ETime'])?(!empty($da['ETime'])?$da['ETime']:date("Y-m-d 23:59:59")):date("Y-m-d 23:59:59");
			$map[]=['id','>',0];
			if(isset($da['Uid']) && !empty($da['Uid'])){
				$map[]=['shopid','=',$da['Uid']];
			}
			if(isset($da['Name']) && !empty($da['Name'])){
				$shopid=User::where(['username|mobile'=>$da['Name']])->find();
				$map[]=['shopid','=',$shopid['shopid']];
			}
			$list=(new Apiorder)->field("class,count(id) as cid,sum(money) as money, GROUP_CONCAT(id) as fg")->where($map)->whereTime('create_time', 'between',[$da['STime'],$da['ETime']])->group("class")->order('id desc')->paginate($limit,false,['query' => request()->param()]);
			foreach($list as $k=>$v){
			    	$list[$k]['amt']=Apiorder::where(['class'=>$v['class'],'state'=>2])->whereTime('create_time', 'between',[$da['STime'],$da['ETime']])->sum('money');
				$list[$k]['su']=Apiorder::where(['class'=>$v['class'],'state'=>2])->whereTime('create_time', 'between',[$da['STime'],$da['ETime']])->sum('amount');
				$list[$k]['supr']=Apiorder::where(['class'=>$v['class'],'state'=>2])->whereTime('create_time', 'between',[$da['STime'],$da['ETime']])->sum('xitmoney');
				$list[$k]['spr']= sprintf("%.2f",$list[$k]['supr']-$list[$k]['su']);
					$list[$k]['class']=CardList::where(['type'=>$v['class']])->value('title');
			}
			$this->result($list);
		}
        return $this->fetch('index');
    }
	
	public function user($limit=15)
    {
		if ($this->request->isAjax()){
			$da=input();
			$list=array();
			$da['STime']=isset($da['STime'])?(!empty($da['STime'])?$da['STime']:"2010-01-12 00:00:00"):"2010-01-12 00:00:00";
			$da['ETime']=isset($da['ETime'])?(!empty($da['ETime'])?$da['ETime']:date("Y-m-d 23:59:59")):date("Y-m-d 23:59:59");
			$map[]=['id','>',0];
			if(isset($da['Uid']) && !empty($da['Uid'])){
				$map[]=['shopid','=',$da['Uid']];
			}
			if(isset($da['Name']) && !empty($da['Name'])){
				$shopid=User::where(['username|mobile'=>$da['Name']])->find();
				$map[]=['shopid','=',$shopid['shopid']];
			}
			$list=(new Apiorder)->field("shopid,count(id) as cid,sum(money) as money, GROUP_CONCAT(id) as fg")->where($map)->whereTime('create_time', 'between',[$da['STime'],$da['ETime']])->group("shopid")->order('id desc')->paginate($limit,false,['query' => request()->param()]);
			foreach($list as $k=>$v){
			    	$list[$k]['amt']=Apiorder::where([['shopid','=',$v['shopid']],['state','=',2]])->whereTime('create_time', 'between',[$da['STime'],$da['ETime']])->sum('money');
				$list[$k]['su']=Apiorder::where([['shopid','=',$v['shopid']],['state','=',2]])->whereTime('create_time', 'between',[$da['STime'],$da['ETime']])->sum('amount');
				$list[$k]['supr']=Apiorder::where([['shopid','=',$v['shopid']],['state','=',2]])->whereTime('create_time', 'between',[$da['STime'],$da['ETime']])->sum('xitmoney');
				$list[$k]['spr']= sprintf("%.2f",$list[$k]['supr']-$list[$k]['su']);
					$name=User::where(['shopid'=>$v['shopid']])->find();
				$list[$k]['shopid']=empty($name['username'])?$name['mobile']:$name['username'];
			}
			$this->result($list);
		}
        return view();
    }
	
	public function todata($limit=15)
    {
		if ($this->request->isAjax()){
			$da=input();
			$list=array();
			$da['STime']=isset($da['STime'])?(!empty($da['STime'])?$da['STime']:"2010-01-12 00:00:00"):"2010-01-12 00:00:00";
			$da['ETime']=isset($da['ETime'])?(!empty($da['ETime'])?$da['ETime']:date("Y-m-d 23:59:59")):date("Y-m-d 23:59:59");
			$map[]=['id','>',0];
			if(isset($da['Uid']) && !empty($da['Uid'])){
				$map[]=['shopid','=',$da['Uid']];
			}
			if(isset($da['Name']) && !empty($da['Name'])){
				$shopid=User::where(['username|mobile'=>$da['Name']])->find();
				$map[]=['shopid','=',$shopid['shopid']];
			}
			$list=(new Apiorder)->field("FROM_UNIXTIME(create_time, '%Y-%m-%d') as day,count(id) as cid,sum(money) as money, GROUP_CONCAT(id) as fg")->where($map)->whereTime('create_time', 'between',[$da['STime'],$da['ETime']])->group('FROM_UNIXTIME(create_time,"%Y-%m-%d")')->order('id desc')->paginate($limit,false,['query' => request()->param()]);
			foreach($list as $k=>$v){
			    $list[$k]['amt']=Apiorder::where('state','=',2)->whereDay('create_time',$v['day'])->sum('money');
				$list[$k]['su']=Apiorder::where('state','=',2)->whereDay('create_time',$v['day'])->sum('amount');
				$list[$k]['supr']=Apiorder::where('state','=',2)->whereDay('create_time',$v['day'])->sum('xitmoney');
				$list[$k]['spr']= sprintf("%.2f",$list[$k]['supr']-$list[$k]['su']);
			}
			$this->result($list);
		}
        return view();
    }
	
	public function chanel($limit=15){
		if ($this->request->isAjax()){
			$da=input();
			$list=array();
			$da['STime']=isset($da['STime'])?(!empty($da['STime'])?$da['STime']:"2010-01-12 00:00:00"):"2010-01-12 00:00:00";
			$da['ETime']=isset($da['ETime'])?(!empty($da['ETime'])?$da['ETime']:date("Y-m-d 23:59:59")):date("Y-m-d 23:59:59");
			$map[]=['id','>',0];
			if(isset($da['Uid']) && !empty($da['Uid'])){
				$map[]=['shopid','=',$da['Uid']];
			}
			if(isset($da['Name']) && !empty($da['Name'])){
				$shopid=User::where(['username|mobile'=>$da['Name']])->find();
				$map[]=['shopid','=',$shopid['shopid']];
			}
			$list=(new Apiorder)->field("type,count(id) as cid,sum(money) as money, GROUP_CONCAT(id) as fg")->where($map)->whereTime('create_time', 'between',[$da['STime'],$da['ETime']])->group('type')->order('id desc')->paginate($limit,false,['query' => request()->param()]);
			foreach($list as $k=>$v){
			   $list[$k]['name']=CardOperator::where(['id'=>$v['type']])->value('name');
				$list[$k]['amt']=Apiorder::where([['type','=',$v['type']],['state','=',2]])->whereTime('create_time', 'between',[$da['STime'],$da['ETime']])->sum('money');
				$list[$k]['su']=Apiorder::where([['type','=',$v['type']],['state','=',2]])->whereTime('create_time', 'between',[$da['STime'],$da['ETime']])->sum('amount');
				$list[$k]['supr']=Apiorder::where([['type','=',$v['type']],['state','=',2]])->whereTime('create_time', 'between',[$da['STime'],$da['ETime']])->sum('xitmoney');
				$list[$k]['spr']= sprintf("%.2f",$list[$k]['supr']-$list[$k]['su']);
			    
			}
			$this->result($list);
		}
        return view();
	}
    
}
