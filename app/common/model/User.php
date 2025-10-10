<?php
namespace app\common\model;
use think\Model;
use think\model\concern\SoftDelete;

class User extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;
    protected $autoWriteTimestamp = true;
	protected $dateFormat = 'Y/m/d H:i:s';
	protected $type = [
	        'last_login_time'=>'timestamp'
    ];
    
    public static function onAfterInsert($user){
		UserRate::addRate($user['shopid']);
	}
	
	public static function onBeforeUpdate($user){
		$u=self::find($user['id']);
		if(isset($user['money']) && $u['money']!=$user['money']){
			$m=$user['money']-$u['money'];
			addlog($user['id'],$m,5,"",$m>0?"管理员增加金额{$m}":"管理员扣除金额{$m}");
		}
	}
	
	
    public function setPasswordAttr($value)
    {
        return md6($value);
    }
	public function setTradepwdAttr($value){
		
		return md6($value);
	}

    public function userRate()
    {
        return $this->belongsTo('userRate', 'shopid','shopid')->bind('content');
    }
	
    public function userReal()
    {
        return $this->belongsTo("userAuth", 'shopid','shopid');
    }
    
    /**
     * 获取脱敏手机号
     */
    public function getMobileMaskedAttr($value, $data)
    {
        if (empty($data['mobile'])) {
            return '';
        }
        $mobile = $data['mobile'];
        if (strlen($mobile) == 11) {
            return substr($mobile, 0, 3) . '****' . substr($mobile, 7);
        }
        return $mobile;
    }
    
}