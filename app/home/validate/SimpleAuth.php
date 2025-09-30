<?php
namespace app\home\validate;

use think\Validate;
use app\common\model\UserAuth;

class SimpleAuth extends Validate
{
    protected $regex = [
        'un' => '/^[\x80-\xff]{2,10}$/',
        'card' => '/^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/',
        'mobile' => '/^1[3-9]\d{9}$/'
    ];
    
    protected $rule = [
        'username' => 'require|regex:un',
        'idcard' => 'require|regex:card',
        'mobile' => 'require|regex:mobile',
        // 'verify_code' => 'require|length:6',  // 暂时跳过验证码校验
        'signature' => 'require',
        'agree_terms' => 'require',
        'agree_step1' => 'require',
        'agree_final' => 'require'
    ];

    protected $message = [
        'username.require' => ['code'=>'#username','msg'=>'请输入真实姓名'],
        'username.regex' => ['code'=>'#username','msg'=>'请输入正确姓名'],
        'idcard.require' => ['code'=>'#idcard','msg'=>'请输入身份证号码'],
        'idcard.regex' => ['code'=>'#idcard','msg'=>'请输入正确的身份证号码'],
        'mobile.require' => ['code'=>'#mobile','msg'=>'请输入手机号码'],
        'mobile.regex' => ['code'=>'#mobile','msg'=>'请输入正确的手机号码'],
        'verify_code.require' => ['code'=>'#verify_code','msg'=>'请输入验证码'],
        'verify_code.length' => ['code'=>'#verify_code','msg'=>'验证码为6位数字'],
        'signature.require' => ['code'=>'#signature','msg'=>'请进行电子签名'],
        'agree_terms.require' => ['code'=>'#agree_terms','msg'=>'请同意承诺书内容'],
        'agree_step1.require' => ['code'=>'#agree_step1','msg'=>'请同意认证条款'],
        'agree_final.require' => ['code'=>'#agree_final','msg'=>'请同意最终协议']
    ];
    
    public function sceneCheck()
    {
        return $this->only(['username','idcard','mobile','signature','agree_terms','agree_step1','agree_final']);
    }
}
