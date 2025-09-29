<?php
namespace app\common\model;

use think\Model;

class UserRate extends Model
{
	protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;
    protected $type = [
	        'content'=>'array'
    ];
	 
    public static function addRate($shopid=""){
		$list=(new CardList)->field('a.type,b.content')->alias('a')->join('CardChannel b','a.tid=b.cid and a.type=b.tid')->select()->toArray();
		$array['shopid']=$shopid;
		$map=[];
		foreach($list as $k=>$v){
			if(empty($v['content'])){
				$arr=(new CardChannel)->where(['tid'=>$v['type']])->where('content','not null')->find()['content'];
			}else{
				$arr=$v['content'];
			}
			$arrb=[];
			foreach($arr as $kk=>$vv){
				$arrb[$vv['price']]=$vv['flv'];
				$arrb['open']=isset($vv['open'])?$vv['open']:0;
			}
			$map[$v['type']]=$arrb;
		}
		$array['content']=$map;
		self::create($array);
	}
}