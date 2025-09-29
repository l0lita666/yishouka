<?php
namespace app\common\model;
use think\facade\Db;
use think\Model;
use think\model\concern\SoftDelete;

class CardOperator extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;
    protected $type = [
	      'fields'=>'array',
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
	public static function onAfterInsert($data){
	    if($data['type']==0){
    		$result=CardList::select();
    		$map=[];
    		foreach($result as $k=>$v){
    			$ch=CardChannel::field("content")->where(['tid'=>$v['type']])->find();
    			$map[$k]['content']=$ch['content'];
    			$map[$k]['cid']=$data['id'];
    			$map[$k]['tid']=$v['type'];
    		}
    		(new CardChannel)->saveAll($map);
	    }
	}

}