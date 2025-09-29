<?php
namespace app\admin\Controller;

use app\common\controller\AdminBase;
use think\facade\Db;
use think\facade\Request;
use app\common\model\User;



class Zhuan {
	public $db;
	
	public function addusersa(){
	    $data=input();
		ini_set('max_execution_time', '0');
		ob_start();
		$con = mysqli_connect("{$data['host']}:{$data['port']}",$data['user'],$data['pass']);
		if (!$con)
		  {
		      return json(['code'=>1,'msg'=> 'Could not connect: ' . mysqli_error($con)]);exit;
		  }
		 mysqli_query($con,"set names 'utf8'");//编码转化
		 $select_db = mysqli_select_db($con,$data['sql']);
		 if (!$select_db) {
				die("could not connect to the db:\n" .  mysqli_error());
			}
		$this->db=$con;
		$sql = "select * from mq_user";
		$res = mysqli_query($this->db,$sql);
		if (!$res) {
			return json(['code'=>1,'msg'=> 'Could not connect: ' . mysqli_error($con)]);exit;
		}
		$arr=[];
		$i=0;
		$shopid=User::order('id desc')->value('shopid');
		if(!$shopid)$shopid=100001;
		while($v = mysqli_fetch_assoc($res)){
			$arr[$i]['shopid']=$shopid+$i;
			$arr[$i]['username']=$v['user'];
			$arr[$i]['apikey']=$v['key'];
			$arr[$i]['mobile']=$v['photo'];
			$arr[$i]['email']=$v['email'];
			$arr[$i]['qq']=$v['qq'];
			$arr[$i]['money']=$v['money'];
			$arr[$i]['password']=$v['password'];
			$arr[$i]['tradepwd']=$v['jiaoyimima'];
			$arr[$i]['create_time']=$v['addtime']?$v['addtime']:time();
			$arr[$i]['state']=$v['state'];
			$i++;
		}
		(new user)->saveAll($arr);
		$this->cclose();
	    return json(['code'=>1,'msg'=> "用户数据导入完成"]);
	}
	public  function cclose(){
		ob_flush();
		 mysqli_close($this->db);
	}
}
?>