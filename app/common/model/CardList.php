<?php
namespace app\common\model;
use think\facade\Db;
use think\Model;
use think\model\concern\SoftDelete;

class CardList extends Model
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
	public static function onAfterInsert($data)
    {
    	$res=CardOperator::select();
		$map=[];
		$re=$data->toArray();
		foreach($res as $k=>$v){
			$map[$k]['cid']=$v['id'];
			$map[$k]['tid']=$re['type'];
			$map[$k]['content']=$data['content'];
		}
		(new CardChannel)->saveAll($map);
		$res=UserRate::select();
		$map=[];
		foreach($res as $k=>$v){
			$map[$k]['id']=$v['id'];
			$ar=$v['content'];
			$dr=[];
			foreach($data['content'] as $kk=>$vv){
				$dr[$vv['price']]=$vv['flv'];
			}
			$dr['open']=1;
			$ar[$re['type']]=$dr;
			$map[$k]['content']=$ar;
		}
		(new UserRate)->saveAll($map);
    }
	
	public static function onBeforeUpdate($data){
		if(isset($data['type'])){
			$type=self::where(['id'=>$data['id']])->value('type');
			if($type!=$data['type']){
				CardChannel::update(['tid'=>$data['type']],['tid'=>$type]);
				$res=UserRate::select();
				$map=[];
				foreach($res as $k=>$v){
					$map[$k]['id']=$v['id'];
					$str=$v['content'][$type];
					$ar=$v['content'];
					$ar[$data['type']]=$str;
					unset($ar[$type]);
					$map[$k]['content']=$ar;
				}
				(new UserRate)->saveAll($map);
			}
		}
	}
	
    protected function base($query)
    {
        //不显示回收站
        if(request()->controller() != 'Recovery'){
            $query->where('delete_time','0');
        }
    }
	
	public function fenlei()
    {
        return $this->hasOne(CardModel::class, 'id', 'cid')->bind(['name'=>'title']);
    } 
	
	 public function models()
    {
        return $this->belongsTo(CardOperator::class, 'tid', 'id')->bind(['name'=>'name']);
    }    	
}