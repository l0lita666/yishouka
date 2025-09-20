<?php
declare (strict_types = 1);

namespace app\home\controller;
use app\common\controller\IndexBase;
use app\common\model\CardModel;
use app\common\model\CardList;
use app\common\model\CardChannel;
use app\common\model\Order;
use think\facade\View;
use think\Request;
use app\common\model\Uploads as UploadsModel;

class Card extends IndexBase
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
		if(request()->isMobile()){
			return view('card/wap/index');
		}else{
			return view();
		}
    }
	
	public function mach(){
		$da=input('post.');
		$preg=CardList::where(['type'=>$da['type']])->find();
		if($preg && !empty($preg['regularity'])){
			$str=$da['card'];
			$str=preg_replace("/([\x{4e00}-\x{9fa5}])/u",",",$str);
			$pattern="/[\\space|\\:：.,\\/\\\_]/";
			$spr=preg_split($pattern,$str);
			$regarr=explode(',',$preg['regularity']);
			$rega="/".$regarr[0]."/";
			$regb=count($regarr)==2?"/".$regarr[1]."/":"";
			$regc=count($regarr)==3?"/".$regarr[2]."/":"";
			$regdan="/".$preg['regularity']."/";
			$nt=[];
			$ok=0;
			for($i=0;$i<count($spr);$i++){
				if($preg['iskami']==0 && !empty($regb)){
					if($preg['isyzm']>0){
						if(preg_match($rega,$spr[$i]) && preg_match($regb,$spr[$i+1]) && preg_match($regc,$spr[$i+2])){
							$nt[]=$spr[$i]." ".$spr[$i+1]." ".$spr[$i+2];
							$i++;
							$ok++;
						}
					}else{
						if(preg_match($rega,$spr[$i]) && preg_match($regb,$spr[$i+1])){
							$nt[]=$spr[$i]." ".$spr[$i+1];
							$i++;
							$ok++;
						}
					}
				}else{
					if(preg_match($regdan,$spr[$i])){
						$nt[]=$spr[$i];
						$ok++;
					}
				}
			}
		    return json(['result'=>1,'msg'=>$nt,'ok'=>$ok]);
		}else{
			return json(['result'=>1,'msg'=>$da['card'],'ok'=>0]);
		}
	}
	
	public function tocard(){
	    $da=input();
		if(0 == is_user_login()){
		    return json(['run'=> "login"]);exit;
		}
		if($this->user['userReal']['retype']!=1 && $this->user['userReal']['retype']!=2 && isset($this->real['iska']) && $this->real['iska']==1){
			return json(['confirm'=>['width'=>'350', 'prompt'=> "warning"],'content'=>"请先实名认证",'list'=> [],'type'=>"2"]);exit;
		}
		try{
			$order=build_order_no('D');
			$card=CardList::where(['type'=>$da['cardtype']])->find();
			$type=$card['tid'];
			if($da['urgent']){
			    if(($da['feilv']>$card['pricemax'] || $da['feilv']<$card['pricemin']) && $da['feilv']>0){
			        return json(['confirm'=>['width'=>'350', 'prompt'=> "warning"],'content'=>"自定义费率区间{$card['pricemin']}-{$card['pricemax']}",'list'=> [],'type'=>"2"]);exit;
			    }
			}
			$ip=request()->ip();
			switch($da['type']){
				case 0://单张提交
				     $ok=$this->yanka($da['cardtype'],$da['cardno'][0]." ".$da['cardpsw'][0]." ".(isset($da['cardcode'][0])?$da['cardcode'][0]:""));
					 if(is_array($ok)){
						 $map['shopid']=$this->user['shopid'];
						 $map['type']=$type;
						 $map['class']=$da['cardtype'];
						 $map['mcode']=$da['mcode'];
						 $map['orderno']=build_order_no();
						 $map['batchno']=$map['orderno'];
						 $map['money']=$da['cardprice'];
						 $map['card_no']=$da['cardno'][0];
						 $map['card_key']=$da['cardpsw'][0];
						 $map['seccode']=$da['cardcode'][0];
						 $map['ip']=$ip;
						 $map['jiajiok']=$da['urgent'];
						 $map['feilv']=isset($da['feilv'])?$da['feilv']:0;
						 (new Order)->save($map);
						 if($da['urgent']==1){
							 \think\facade\Queue::push("app\home\job\Jobone@sendCardUrgent", $map,'sendCardUrgentJobQueue');
						 }else{
						    \think\facade\Queue::push("app\home\job\Jobone@sendCard", $map,'sendCardJobQueue');
						 }
						 return json(["state"=>1,"type"=>"0","content"=>"共有 1 张卡成功提交,请在卖卡明细中查看进度！","list"=>[],"confirm"=>["name"=>"提交成功","prompt"=>"success","width"=>400,"time"=>5,"url"=>"reload"]]);
					 }else{
						 return json(['confirm'=>['width'=>'350', 'prompt'=> "warning"],'content'=>$ok,'list'=> [],'type'=> "2"]);
					 }
				break;
				case 1://批量提交
				    $data=str_replace("\r\n",',',$da['cardlist']);
					$data=str_replace("\n",',',$data);
					$data=str_replace("\r",',',$data);
					$list=explode(',',$data);
					$err=[];
					$errnum=0;
					$map=[];
					foreach($list as $k=>$v){
						    $ok=$this->yanka($da['cardtype'],$v);
						 if(is_array($ok)){
							 $map[$k]['shopid']=$this->user['shopid'];
							 $map[$k]['type']=$type;
							 $map[$k]['class']=$da['cardtype'];
							 $map[$k]['mcode']=$da['mcode'];
							 $map[$k]['orderno']=build_order_no();
							 $map[$k]['batchno']=$order;
							 $map[$k]['money']=$da['cardprice'];
							 $map[$k]['card_no']=$ok[0];
							 $map[$k]['card_key']=$ok[1];
							 $map[$k]['seccode']=isset($ok[2])?$ok[2]:"";
							 $map[$k]['ip']=$ip;
							 $map[$k]['jiajiok']=$da['urgent'];
							 $map[$k]['feilv']=isset($da['feilv'])?$da['feilv']:0;
						 }else{
							 $err[$k]=$ok;
							 $errnum++;
						 }
					}
					$count=count($list);
					 if($errnum>0 && input('submit')==0){
						 $msg=['confirm'=> ['width'=>400, 'prompt'=> "info"],'num'=>$count,'content'=>"共提交{$count}张卡卷,有{$errnum}张卡劵提交失败",'list'=>$err,'state'=>2,'type'=>1];
					 }else{
					     if(count($map)==0){
					          $msg=['confirm'=>['width'=>'350', 'prompt'=> "warning"],'content'=>"提交失败，提交成功了0张卡卷",'list'=> [],'type'=>"2"];
					     }else{
    						 (new Order)->saveAll($map);
    						 foreach($map as $k=>$v){
    							 if($v['jiajiok']==1){
    							   \think\facade\Queue::push("app\home\job\Jobone@sendCardUrgent", $v,'sendCardUrgentJobQueue');
    							 }else{
    							   \think\facade\Queue::push("app\home\job\Jobone@sendCard", $v,'sendCardJobQueue');
    							 }
    						 }
    						 $msg=["state"=>1,"type"=>2,'num'=>$count,"content"=>"共有{$count} 张卡成功提交,请在卖卡明细中查看进度！","list"=>$err,"confirm"=>["name"=>"提交成功","prompt"=>"success","width"=>400,"time"=>5,"url"=>"reload"]];
					     }
					 }
					 return json($msg);
				break;
				case 2://图片提交
					$data=str_replace("\r\n",',',$da['cardlist']);
					$data=str_replace("\n",',',$data);
					$data=str_replace("\r",',',$data);
					$list=explode(',',$data);
					$n=0;
					foreach($list as $k=>$v){
						if(empty($v))continue;
						 $map[$k]['shopid']=$this->user['shopid'];
						 $map[$k]['type']=$type;
						 $map[$k]['class']=$da['cardtype'];
						 $map[$k]['mcode']=$da['mcode'];
						 $map[$k]['orderno']=build_order_no();
						 $map[$k]['batchno']=$order;
						 $map[$k]['money']=$da['cardprice'];
						 $map[$k]['card_no']=$v;
						 $map[$k]['card_key']=$k;
						 $map[$k]['ip']=$ip;
						 $map[$k]['jiajiok']=$da['urgent'];
						 $map[$k]['feilv']=isset($da['feilv'])?$da['feilv']:0;
						 $map[$k]['state']=1;
						 $n++;
					}
					(new Order)->saveAll($map);
					$msg=["state"=>1,"type"=>"0",'num'=>$n,"content"=>"共有{$n} 张卡成功提交,请在卖卡明细中查看进度！","list"=>[],"confirm"=>["name"=>"提交成功","prompt"=>"success","width"=>400,"time"=>5,"url"=>"reload"]];
					return json($msg);
				break;
				default:
				 return json(['code'=>-1,'msg'=>'参数错误']);
			}
		}catch (\Exception $e){
			return json(['code'=>-1,'msg'=>$e->getMessage()]);
		}
	}
	
	public function yanka($type,$card){
		$preg=CardList::where(['type'=>$type])->find();
		if($preg && $preg['regularity']){
			$regarr=explode(',',$preg['regularity']);
			$rega="/{$regarr[0]}/";
			$regb=count($regarr)==2?"/{$regarr[1]}/":"";
			$regc=count($regarr)==3?"/{$regarr[2]}/":"";
			$nt=[];
			$ok=0;
			if($preg['iskami']==0 && !empty($regb)){
				$card=explode(" ",$card);
				if(preg_match($rega,$card[0]) && preg_match($regb,$card[1])){
				    $value=Order::enCardno($card[0]);
					if(Order::where(['card_no'=>$value])->where('state','in',[0,1,2])->find()){
						$msg='卡已有成功记录或正在处理';
					}else{
					  $msg=[$card[0],$card[1],isset($card[2])?$card[2]:""];}
				}else{
					$msg='卡不符合规则';
				}
				if(!empty($regc) && !preg_match($rega,$card[2])){
					$msg='卡不符合规则';
				}
			}else{
				if(preg_match($rega,$card)){
					$msg=[1,$card];
				}else{
					$msg='卡不符合规则';
				}
			}
		    return $msg;
		}else{
			return explode(" ",$card);
		}
	}
	
	public function cardType(){
		$list=CardModel::field("id,title,route")->with('comments')->where(['status'=>1])->select()->toArray();
		$map=[];
		foreach($list as $k=>$v){
			foreach($v['comments'] as $kk=>$vv){
				$res=CardChannel::where(['cid'=>$vv['tid'],'tid'=>$vv['type']])->find();
				$vv['list']=!empty($res['content'])?array_reverse($res['content']):[];
				$vv['canal']=sendType($vv['batch'],$vv['single'],$vv['iscode']);//3qq 4|5上传图片 4可以连卡密上传  5只能图片
				$rt=showFeilv($res['content'],$vv['mode']);
				$vv['discount']=$rt?sprintf("%.2f",$rt):"";
				$vv['mark']=$vv['iscode']==1?1:0;//0实体卡1二维码
				$vv['mode']=$vv['mode'];//2显示回收价
				$vv['nocode']=$vv['iskami'];//1无需卡号只填卡密  id=2  可以加急处理
				$vv['repair']=$this->repair($vv['status'],$vv['isqiye']);//维护管理
				$vv['shide']="";
				$vv['type']=$vv['type'];
				$vv['warning']=$vv['ismoney'];//1提醒确认面值
				$v[$vv['id']]=$vv;
			}
			$map[$v['id']]=$v;
			unset($map[$v['id']]['comments']);
		}
		$this->result($map);
	}
	
	public function repair($status=0,$qiye){
		$as=$status==0?1:0;
		if($as==0 && session("?user_auth") && $qiye==1){
			if(!isset($this->user['userReal']['retype']) || $this->user['userReal']['retype']==1){
				$as=2;
			}
		}
		return $as;
	}
	
	public function gapiData(){
		$res=CardModel::field("id")->where(['status'=>1])->select();
		$map=[];
		foreach($res as $k=>$v){
			$list=(new CardList)->field("a.id,b.content,a.type")->alias('a')->join('cardChannel b','b.cid=a.tid and b.tid=a.type')->where(['a.cid'=>$v['id']])->select()->toArray();
			foreach($list as $kk=>$vv){
				$feilv=empty($vv['content'])?[]:array_reverse($vv['content']);
				if(session("?user_auth") && count($feilv)>0){
					foreach($feilv as $ka=>$va){
						$feilv[$ka]['flv']=getUserFeilv(session("user_auth.shop_id"),$vv['type'],$va['price']);
					}
				}
				$list[$kk]['list']=$feilv;
				unset($list[$kk]['content']);
			}
			$map[$v['id']]=$list;
		}
		$this->result($map);
	}
	
    
}
