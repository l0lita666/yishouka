<?php
namespace app\common\model;
use think\Model;
use think\facade\Request;
use think\model\concern\SoftDelete;

class Apiorder extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;
    protected $autoWriteTimestamp = true;
	protected $dateFormat = 'Y/m/d H:i:s';
	protected $type = [
	        
    ];
	
	
    public function bsLei()
    {
        return $this->belongsTo(CardList::class,'class','type')->bind(['title','phoneRecycleIcon','tid'=>'id']);
    }
	
	public function setCardNoAttr($value,$data)
    {
		$res=Security::order("id desc")->find();
		if(!empty($res['datakey'])){
			$card=new Card($res['datakey']);
			$value=$card->encrypt($value);
		}
        return $value;
    }
	
	public function setCardKeyAttr($value,$data)
    {
        $res=Security::order("id desc")->find();
		if(!empty($res['datakey'])){
			$card=new Card($res['datakey']);
			$value=$card->encrypt($value);
		}
        return $value;
    }
	
	public function getCardNoAttr($value,$data)
    {
        $res=Security::order("id desc")->find();
		$auto=CardList::where(['type'=>$data['class']])->find();
		if(!empty($res['datakey']) && isset($auto['is_auto']) && $auto['is_auto']==0){
			$card=new Card($res['datakey']);
			$value=$card->decrypt($value);
			if(!$value)$value=$data['card_no'];
		}elseif(!empty($res['datakey']) && isset($auto['is_auto']) && $auto['is_auto']==1 && ($res['datatype']==0 || $data['state']>1)){
			$card=new Card($res['datakey']);
			$value=$card->decrypt($value);
			if(!$value)$value=$data['card_no'];
		}
        return $value;
    }
	
	
	
	public function getCardKeyAttr($value,$data)
    {
        $res=Security::order("id desc")->find();
		$auto=CardList::where(['type'=>$data['class']])->find();
		if(!empty($res['datakey']) && isset($auto['is_auto']) && $auto['is_auto']==0){
			$card=new Card($res['datakey']);
			$value=$card->decrypt($value);
			if(!$value)$value=$data['card_key'];
		}elseif(!empty($res['datakey']) && isset($auto['is_auto']) && $auto['is_auto']==1 && ($res['datatype']==0 || $data['state']>1)){
			$card=new Card($res['datakey']);
			$value=$card->decrypt($value);
			if(!$value)$value=$data['card_no'];
		}
        return $value;
    }
	
	public function getStateAttr($value){
		return 	orderType($value);
	}
	
	
	
}