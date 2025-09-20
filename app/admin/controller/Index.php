<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\facade\View;
use think\facade\Request;
use think\facade\Db;
use think\facade\Cache;
use think\facade\Session;

use app\common\model\AuthGroupAccess;
use app\common\model\AuthRule;
use app\common\model\Admin;
use app\common\model\Apiorder;
use app\common\model\Order;
use app\common\model\Withdraw;
use app\common\model\UserAuth;
use app\common\model\User;

class Index extends AdminBase
{
    protected $noLogin = ['login', 'captcha','sendmsg'];
    protected $noAuth = ['index', 'uploadImage','home', 'getDa','icon','editPassword','guanbi', 'ssedistill','logout'];
    
    //后台首页
    public function index()
    {
        $userinfo = Session::get('admin_auth');
        return View::fetch('index',['userinfo'=>$userinfo]);
    }
    //默认首页
    public function home()
    {
        // 快捷导航
        $where = ['index' => 1, 'status' => 1];
        if (session('admin_auth.username') != config('administrator')) {
            $access      = AuthGroupAccess::with('authGroup')
                ->where('uid', session('admin_auth.admin_id'))->find();
            $where['id'] = ['in', $access['rules']];
        }
        $index = AuthRule::where($where)->order('pid asc,sort_order asc')->select();
        //统计信息
        $da['real']=UserAuth::where(['retype'=>3])->count();
		$da['cash']=Withdraw::where(['status'=>1])->count();
		$da['order']=Order::where(['state'=>1])->count();
		$da['api']=Apiorder::where(['state'=>1])->count();
        // 服务器信息
        $server = [
            'os'                  => PHP_OS, // 服务器操作系统
            'sapi'                => PHP_SAPI, // 服务器软件
            'version'             => PHP_VERSION, // PHP版本
            'mysql'               => '5.7', // mysql 版本
            'root'                => $_SERVER['DOCUMENT_ROOT'], // 当前运行脚本所在的文档根目录
            'max_execution_time'  => ini_get('max_execution_time') . 's', // 最大执行时间
            'upload_max_filesize' => ini_get('upload_max_filesize'), // 文件上传限制
            'memory_limit'        => ini_get('memory_limit'), // 允许内存大小
            'date'                => date('Y-m-d H:i:s', time()), // 服务器时间
        ];
		$num['user']=User::count();
		$num['d_user']=User::whereDay('create_time')->count();
		
		$num['card_count']=Order::count();
		$num['card_num']=Order::sum('money');
		
		$num['d_card_count']=Order::whereDay('create_time')->count();
		$num['d_card_num']=Order::whereDay('create_time')->sum('money');
		
		$num['secc_count']=Order::where(['state'=>2])->count();
		$num['secc_num']=Order::where(['state'=>2])->sum('money');
		
		$num['d_secc_count']=Order::where(['state'=>2])->whereDay('create_time')->count();
		$num['d_secc_num']=Order::where(['state'=>2])->whereDay('create_time')->sum('money');
		
		$num['err_count']=Order::where(['state'=>3])->count();
		$num['err_num']=Order::where(['state'=>3])->sum('money');
		
		$num['d_err_count']=Order::where(['state'=>3])->whereDay('create_time')->count();
		$num['d_err_num']=Order::where(['state'=>3])->whereDay('create_time')->sum('money');
		
		
		$num['profit']=Order::where(['state'=>2])->sum('profit');
		$num['d_profit']=Order::where(['state'=>2])->whereDay('create_time')->sum('profit');



		$numb['card_count']=Apiorder::count();
		$numb['card_num']=Apiorder::sum('money');
		
		$numb['d_card_count']=Apiorder::whereDay('create_time')->count();
		$numb['d_card_num']=Apiorder::whereDay('create_time')->sum('money');
		
		$numb['secc_count']=Apiorder::where(['state'=>2])->count();
		$numb['secc_num']=Apiorder::where(['state'=>2])->sum('money');
		
		$numb['d_secc_count']=Apiorder::where(['state'=>2])->whereDay('create_time')->count();
		$numb['d_secc_num']=Apiorder::where(['state'=>2])->whereDay('create_time')->sum('money');
		
		$numb['err_count']=Apiorder::where(['state'=>3])->count();
		$numb['err_num']=Apiorder::where(['state'=>3])->sum('money');
		
		$numb['d_err_count']=Apiorder::where(['state'=>3])->whereDay('create_time')->count();
		$numb['d_err_num']=Apiorder::where(['state'=>3])->whereDay('create_time')->sum('money');
		
		
		$numb['profit']=Apiorder::where(['state'=>2])->sum('profit');
		$numb['d_profit']=Apiorder::where(['state'=>2])->whereDay('create_time')->sum('profit');
        return View::fetch('home', ['index' => $index,'da'=>$da, 'server' => $server,'f'=>$num,'ff'=>$numb]);
    }
	public function guanbi(){
		$tab=input('tab');
		switch($tab){
			case 'Order':
			  (new Order)->where(['read'=>0])->update(['read'=>1]);
			break;
			case 'Apiorder':
			  (new Apiorder)->where(['read'=>0])->update(['read'=>1]);
			break;
			default:
			  (new Withdraw)->where(['read'=>0])->update(['read'=>1]);
		}
	}
	public function ssedistill(){
        $order=(new Order)->where(['read'=>0])->where('state','in',[0,1])->count();
		$num=(new Withdraw)->where(['read'=>0])->where('status','in',[0,1])->count();
		$api=(new Apiorder)->where(['read'=>0])->where('state','in',[0,1])->count();
		return json(['order'=>$order,"cash"=>$num,'api'=>$api]);
	}
	
	public function getDa(){
		$arr=[];
		for($i=31;$i>=0;$i--){
			$s=date('Y-m-d 00:00:00',strtotime('-'.$i.' day'));
			$e=date('Y-m-d 23:59:59',strtotime('-'.$i.' day'));
			$arr['t'][]=date('m/d',strtotime('-'.$i.' day'));
			$arr['pay'][]=(new Apiorder)->whereTime('create_time','between',[$s,$e])->sum('money');
			$arr['rech'][]=(new Order)->whereTime('create_time','between',[$s,$e])->sum('money');
			$arr['user'][]=(new Withdraw)->whereTime('create_time','between',[$s,$e])->sum('money');
			$apia=(new Apiorder)->whereTime('create_time','between',[$s,$e])->sum('profit');

			$ora=(new Order)->whereTime('create_time','between',[$s,$e])->sum('profit');

			$arr['lirun'][]=(float)sprintf("%.2f",$apia+$ora);
		}
		return json(['code'=>1,'data'=>$arr]);
	}
	
	
    //修改密码
    public function editPassword()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            // 验证条件
            empty($param['password']) && $this->error('请输入旧密码');
            empty($param['new_password']) && $this->error('请输入新密码');
            empty($param['rep_password']) && $this->error('请输入确认密码');
            !check_password($param['new_password'], 6, 16) && $this->error('请输入6-16位的密码');
            $param['new_password'] != $param['rep_password'] && $this->error('两次密码不一致');
            $admin = Admin::where('id', session('admin_auth.admin_id'))->find();
            $admin['password'] != md5($param['password']) && $this->error('旧密码错误');
            $data = ['id' => session('admin_auth.admin_id'), 'password' => $param['new_password']];
            $result = Admin::update($data);
            if ($result == true) {
                insert_admin_log('修改了登录密码');
                session('admin_auth', null);
                session('admin_auth_sign', null);
                $this->success('更新成功', url('/index/index'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        return $this->fetch('editPassword');
    }
    
}
