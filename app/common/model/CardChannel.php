<?php
namespace app\common\model;
use think\facade\Db;
use think\Model;
use think\model\concern\SoftDelete;

class CardChannel extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;
    protected $type = [
	        'content'=>'array'
    ];
    protected function _initialize()
    {
        parent::_initialize();
        
    }
    protected function base($query)
    {
        //不显示回收站
        if(request()->controller() != 'Recovery'){
            $query->where('delete_time','0');
        }
    }
	
	public static function onUpdate($data){
		$res=self::where(['id'=>$data['id']])->find();
		if(CardList::where(['tid'=>$res['cid'],'type'=>$res['tid']])->find()){
			$ra=duibi($data['content'],$res['content'],$data['geng']);
			if(count($ra['data'])>0){
				$list=UserRate::select();
				$map=[];
				foreach($list as $k=>$v){
					$ss=$ra['data'];
					$map[$k]['id']=$v['id'];
					$ar=$v['content'];
					$str=$ar[$res['tid']];
					foreach($str as $kk=>$vv){
						if(count($ss)<=0)break;
							foreach($ss as $a=>$b){
								if($ra['type']){
									   if($kk==$a){
										   $str[$kk]=$b;
										   unset($ss[$a]);
									   }
								   }else{
									   unset($str[$a]);
									   unset($ss[$a]);
								   }
							}
							
							if(count($ss)>0){
								foreach($ss as $x=>$y){
									$str[$x]=$y;
								}
							}
					}
					$ar[$res['tid']]=$str;					
					$map[$k]['content']=$ar;
				}
				(new UserRate)->saveAll($map);
			}
		}
	}
	
	public function singupdata($id){
		$result=CardChannel::find($id);
		$data=$result['content'];
		$tid=$result['tid'];
		$arrb=[];
		foreach($data as $kk=>$vv){
			$arrb[$vv['price']]=$vv['flv'];
		}
		$arrb['open']=1;
		$ulist=UserRate::select()->toArray();
		foreach($ulist as $k=>$v){
			$arr=$v['content'];
			$arr[$tid]=$arrb;
			$ulist[$k]['content']=$arr;
		}
		(new UserRate)->saveAll($ulist);
	}
	
	 public function protle()
    {
        return $this->hasOne(CardOperator::class, 'id', 'cid')->bind(['name']);
    }  
	
	/* public function allmian(){取消不用
		$list=(new CardList)->field("b.content")->alias('a')->join('cardChannel b','b.cid=a.tid and b.tid=a.type')->select()->toArray();
		$map=[];
		foreach($list as $k=>$v){
			foreach($v['content'] as $kk=>$vv){
			   $map[]=$vv['price']=='0'?'自定义':$vv['price'];
			}
		}
		$arr=array_unique($map);
		asort($arr);
	    reset($arr);
		return $arr;
	} */
	
   
}