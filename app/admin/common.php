<?php
use think\facade\Session;
use think\facade\Config;
use think\facade\Db;
/**
 * 修改扩展配置文件
 * @param array  $arr  需要更新或添加的配置
 * @param string $file 配置文件名(不需要后辍)
 * @return bool
 */
function extraconfig($arr = [], $file = 'website')
{
    if (is_array($arr)) {
        $filename = $file .'.php';
        $filepath = config_path() . $filename;
        if (!file_exists($filepath)) {
            $conf = "<?php return [];";
            file_put_contents($filepath, $conf);
        }
        $conf = include $filepath;
        foreach ($arr as $key => $value) {
            $conf[$key] = $value;
        }
        $time = date('Y/m/d H:i:s');
        $str = "<?php\r\n/**\r\n * 修改时间\r\n * $time\r\n *\r\n * 一往无前QQ 314732607\r\n **/\r\nreturn [\r\n";
        foreach ($conf as $key => $value) {
            $str .= "\t'$key' => '$value',";
            $str .= "\r\n";
        }
        $str .= '];';
        file_put_contents($filepath, $str);
        
        return true;
    } else {
        return false;
    }
}

function apitype($v){
    $arr=['卡类接口','银行接口'];
    return isset($arr[$v])?$arr[$v]:"--";
}

function substrates($content=null){
	$str="";
	if($content){
		foreach($content as $kk=>$vv){
			if($vv['price']=='0'){
				$str.="[自定义 费率:{$vv['flv']}]";
			}else{
			  $str.="[面值:{$vv['price']} 费率:{$vv['flv']}]";
			}
		}
	}else{
	    $str="未设置通道";
	}
	return $str;
}
/*
*对比费率差异 返回
*$ac 以前数据
*$bc 更新数据
*/
function duibi($ac,$bc,$ok){
	$aca=shengc($ac);
	$bca=shengc($bc);
	$type=true;
	if(count($bca)>count($aca)){
		$type=false;
		$result=array_diff_uassoc($bca,$aca,"myfunction");
	}else{
	  $result=array_diff_uassoc($aca,$bca,"myfunction");
	  if(!$ok){
		foreach($result as $k=>$v){
			if(isset($bca[$k]))unset($result[$k]);
		}
	  }
	}
	return ['data'=>$result,'type'=>$type];
}

function myfunction($a,$b)
{
	if ($a===$b)
  {
     return 0;
  }
  return ($a>$b)?1:-1;
}

function shengc($arr=[]){
	$map=[];
	foreach($arr as $k=>$v){
		$map[$v['price']]=$v['flv'];
	}
	return $map;
}

function get_file_list($file_path){
	$file_list=[];
	if(is_dir($file_path)){
		$handler=opendir($file_path);
		while(($filename=readdir($handler))!==false){
			if($filename!="." && $filename!=".."){
				$file_list[]=$filename;
			}				
		}
		closedir($handler);
		return $file_list;
	}
}

/**
 * 检测管理员是否登录
 * @return integer 0/管理员ID
 */
function is_admin_login($safe)
{
     $admin=Db::name("admin")->where(['id'=>session("admin_auth.admin_id"),'token'=>session("admin_auth.token")])->whereTime('timeout','>',time())->find();
    if (!$admin || ($safe['isyan']!=0 && !session("?safecode"))) {
        return false;
    } else {
        $auth = [
                'admin_id' => $admin['id'],
                'username' => $admin['username'],
                'token'=>$admin['token']
            ];
        return session('admin_auth_sign') == data_auth_sign($auth) ? $admin['id'] : false;
    }
}


/**
 * 保存后台用户行为
 * @param string $remark 日志备注
 */
function insert_admin_log($remark)
{
    if (session('?admin_auth')) {
        \app\common\model\AdminLog::insert([
            'admin_id'    => Session::get('admin_auth.admin_id'),
            'username'    => Session::get('admin_auth.username'),
            'useragent'   => request()->server('HTTP_USER_AGENT'),
            'ip'          => request()->ip(),
            'url'         => request()->url(true),
            'method'      => request()->method(),
            'type'        => request()->type(),
            'param'       => json_encode(request()->param()),
            'remark'      => $remark,
            'create_time' => time(),
        ]);
    }
}


function Uid($shopid){
	return \app\common\model\User::where(['shopid'=>$shopid])->value('id');
}
/**
 * 参数字段配置
 * @param string $remark 日志备注
 */
function field_config()
{
    $field = Config::load('admin/field','field');
    return $field;
}