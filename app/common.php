<?php
use think\facade\Session;
use think\facade\Db;
use app\common\model\CardChannel;
use app\common\model\UserRate;
use app\common\model\User;
// 应用公共文件
/**
*前台显示费率**/
function hasTone($cid,$tid,$ok=true){
	$feilv=CardChannel::where(['cid'=>$cid,'tid'=>$tid])->find();
	if(!$feilv)$feilv=CardChannel::where(['tid'=>$tid])->find();
	    $feilv=$feilv->toArray();
    	$rate="";
    	if($feilv){
    		if(session('?user_auth')){
    		    $count=UserRate::where(['shopid'=>session('user_auth.shop_id')])->find()['content'];
    		    if(isset($count[$tid])){
        		    $xcount=$count[$tid];
        		    unset($xcount['open']);
        		    unset($xcount['class']);
    		    }else{
    		        $xcount=$feilv['content'];
    		    }
    		    $result=end($xcount);
				$result=is_numeric($result)?$result:0;
				if($ok){
    		      $rate=(int)$result>0?"高价回收":$result*100 ."折回收";
				}else{
					$rate=(int)$result>0?"高价回收":$result*100 ."%";
				}
    		}else{
    		    $result=end($feilv['content']);
        		if(isset($result['flv'])){
					if($ok){
        			  $rate=(int)$result['flv']>0?"高价回收":$result['flv']*100 ."折回收";
					}else{
						$rate=(int)$result['flv']>0?"高价回收":$result['flv']*100 ."%";
					}
        		}
    		}
    	}
	return $rate;
}
function filterEmoji($str)
{
  $str = preg_replace_callback(
    '/./u',
    function (array $match) {
      return strlen($match[0]) >= 4 ? '' : $match[0];
    },
    $str);

  return $str;
}

function yaolevel($uid,$pei){
	$fop=Db::name("user")->where(['assets'=>$uid])->select();
	$r=0;
	$num=0;
	$money=0;
	foreach($fop as $v){
		$api=Db::name("apiorder")->where(['shopid'=>$v['shopid'],'state'=>2])->sum('money');
		$or=Db::name('Order')->where(['shopid'=>$v['shopid'],'state'=>2])->sum('money');
		if($api+$or>$pei['xiaok']){
			$r++;
		}
		$money+=$api+$or;
		$num++;
	}
	$map['r']=$r;
	$map['num']=$num;
	if($r<$pei['threenum'] || $money<$pei['threeok']){
		$map['level']=2;
		$map['you']=$pei['threenum']-$r;
		$map['money']=$pei['threeok']-$money;
		$map['xia']=3;
	}
	if($r<$pei['twonum'] || $money<$pei['twook']){
		$map['level']=1;
		$map['you']=$pei['twonum']-$r;
		$map['money']=$pei['twook']-$money;
		$map['xia']=2;
	}
	if($r>=$pei['threenum'] && $money>=$pei['threeok']){
		$map['level']=3;
		$map['you']=0;
		$map['money']=0;
		$map['xia']=4;
	}
	if($r<$pei['onenum'] || $money<$pei['oneok']){
		$map['level']=0;
		$map['you']=$pei['onenum']-$r;
		$map['money']=$pei['oneok']-$money;
		$map['xia']=1;
	}
	return $map;
}


//判断安卓和ios
 function testagent(){
       if(strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone')||strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')){
           return 'IOS';
       }else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Android')){
           return  'Android';
       }else{
           return false;
       }
   }
function get_link($id,$order='desc')
{
    $list = \app\common\model\Link::where(['category'=>$id,'status'=>'1'])->order('sort_order $order')->select();
    return $list;
}
function fanyong($uid,$order,$money,$lirun){
	$res=Db::name('sysconfig')->select();
	$list=[];
	foreach($res as $k=>$v){
		$list[$v['name']]=$v['value'];
	}
	$tou=Db::name("user")->where(['assets'=>$uid])->value('id');
	if($list['yaostate']=="on" && $tou){
	   $lvl=yaolevel($tou,$list);
	   if($lvl['level']>0){
		   $str="";
		   $price=0;
		   switch($lvl['level']){
			   case 1:
			    $str="[V1级佣金][金额{$money}-利润{$lirun}]";
				$price=$lirun*$list['onerate']/100;
			   break;
			   case 2:
			    $str="[V2级佣金][金额{$money}-利润{$lirun}]";
				$price=$lirun*$list['tworate']/100;
			   break;
			   case 3:
			    $str="[V3级佣金][金额{$money}-利润{$lirun}]";
				$price=$lirun*$list['threerate']/100;
			   break;
		   }
		   Db::name('user')->where(['id'=>$tou])->inc('money',(float)$price)->update();
		   addlog($tou,$price,6,$order,$str);
		   return $price;
	   }
	}
	return 0;
}
function tips($msg,$css="danger"){
	$html='<div class="modal-prompt"><div class="prompt prompt-'.$css.'"><div class="prompt-icon"><i class="iconimg"></i></div><div class="prompt-cont"><h4>'.$msg.'</h4><div class="action"><a class="btn btn-sm btn-default btn-cancel" href="###" data-dismiss="modal">确定</a></div></div></div></div>';
	return $html;
}
/*Api调用
*$amount 结算金额
*successAmount结算面值出现卡损和真实面值不一致
*realPrice 真实面值 不管是不是出现卡损都不变
*
*/
function succorder($id,$state=2,$amount=0,$successAmount=0,$realPrice=0,$remarks=""){
	Db::startTrans();
	try {
	   $or=Db::name('Apiorder')->where(['id|orderno'=>$id])->find();
	   $id=$or['id'];
	   if($or){
		   $uid=Db::name('user')->where(['shopid'=>$or['shopid']])->value('id');
		   $money=$realPrice==0?$or['money']:$realPrice;
		   $sysrate=Db::name("card_list")->where(['type'=>$or['class']])->value("sysrate");
		   $sysrate=$sysrate==0?1:$sysrate;
		   $feilv=getUserFeilv($or['shopid'],$or['class'],is_numeric($or['money'])?$money:$or['money']);
		   if($feilv!==false){
			   $amount= $amount==0?(is_numeric($or['money'])?$or['money']:$feilv+$sysrate):$amount;
			   $successAmount= $successAmount==0?(is_numeric($or['money'])?$or['money']:$feilv+$sysrate):$successAmount;
			   $realPrice= $realPrice==0?(is_numeric($or['money'])?$or['money']:$feilv+$sysrate):$realPrice;
			   
			   $ufeilv=$feilv>1 ? sprintf("%.4f",floatval($feilv)) : sprintf("%.4f",floatval($successAmount)*floatval($feilv));
			   if($state==2 && ($or['state']==1 || $or['state']==3)){
				   $map['settle_amt']=$successAmount;
				   $map['amount']= $ufeilv;
				   if($feilv>1){
				       $map['xitmoney']= $amount;
				   }else{
    				   $map['xitmoney']= $amount==$realPrice?sprintf("%.4f",$realPrice*$sysrate):$amount;
				   }
				   $map['profit']=sprintf("%.4f",$map['xitmoney']-$ufeilv); 
				   $map['state']=2;
				   $map['chulitime']=time();
				   $map['remarks']= (float)$successAmount!=(float)$realPrice?"[商户充值][出现卡损实际面值".$realPrice."]":"[商户充值][销卡成功]";
				   $yong=fanyong($uid,$or['orderno'],$amount,$map['profit']);
				   $map['yong']=$yong;
				   Db::name('apiorder')->where(['id'=>$id])->update($map);
				   Db::name('user')->where(['id'=>$uid])->inc('money',(float)$ufeilv)->update();
				   addlog($uid,$ufeilv,2,$or['orderno'],$map['remarks']);
			   }elseif($state==3 && ($or['state']==1 || $or['state']==2)){
				   if($or['state']==2){
					   $map['settle_amt']=0;
					   $map['amount']= 0;
					   $map['state']=3;
					   $map['xitmoney']=0;
					   $map['chulitime']=time();
					   $map['profit']=0;
					   $map['remarks']= $remarks?$remarks:"[订单重设][销卡失败]";
					   Db::name('apiorder')->where(['id'=>$id])->update($map);
					   Db::name('user')->where(['id'=>$uid])->dec('money',(float)$ufeilv)->update();
					   addlog($uid,-$ufeilv,4,$or['orderno'],$map['remarks']);
				   }else{
					   Db::name('apiorder')->where(['id'=>$id])->update(['state'=>3,'remarks'=>$remarks?$remarks:"失败",'chulitime'=>time()]);
				   }
			   }else{
				   return "状态错误";
			   }
		   }else{
			   return "费率错误";
		   }
	   }else{
		   return "订单不存在";
	   }
	   Db::commit();
	   return true;
	}catch (\Exception $e) {
		Db::rollback();
		return $e->getMessage();
	}
}

function is_https() {
    if ( !empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
        return true;
    } elseif ( isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) {
        return true;
    } elseif ( !empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
        return true;
    }
    return false;
}
/*
*$amount 结算金额
*successAmount结算面值出现卡损和真实面值不一致
*realPrice 真实面值 不管是不是出现卡损都不变
*
*/
function successful($id,$state=2,$amount=0,$successAmount=0,$realPrice=0,$remarks=""){
	Db::startTrans();
	try {
	   $or=Db::name('order')->where(['id|orderno'=>$id])->find();
	   $id=$or['id'];
	   if($or){
		   $uid=Db::name('user')->where(['shopid'=>$or['shopid']])->value('id');
		   if($or['feilv']!=0){
		       $feilv=$or['feilv'];
		   }else{
    		   $money=$realPrice==0?$or['money']:$realPrice;
    		   $feilv=getUserFeilv($or['shopid'],$or['class'],is_numeric($or['money'])?$money:$or['money']);
		   }
		   
		   $sysrate=Db::name("card_list")->where(['type'=>$or['class']])->value("sysrate");
		   $sysrate=$sysrate==0?1:$sysrate;
		   if($feilv!==false){
			   $amount= $amount==0?(is_numeric($or['money'])?$or['money']:$feilv+$sysrate):$amount;
			   $successAmount= $successAmount==0?(is_numeric($or['money'])?$or['money']:$feilv+$sysrate):$successAmount;
			   $realPrice= $realPrice==0?(is_numeric($or['money'])?$or['money']:$feilv+$sysrate):$realPrice;
			  
			   $ufeilv=$feilv>1 ? sprintf("%.4f",floatval($feilv)) : sprintf("%.4f",floatval($successAmount)*floatval($feilv));
			   if($state==2 && ($or['state']==1 || $or['state']==3)){
				   $map['settle_amt']=$successAmount;
				   $map['amount']= $ufeilv;
				    if($feilv>1){
				       $map['xitmoney']= $amount;
				   }else{
    				   $map['xitmoney']= $amount==$realPrice?sprintf("%.4f",$realPrice*$sysrate):$amount;
				   }
				   $map['profit']=sprintf("%.4f",$map['xitmoney']-$ufeilv); 
				   $map['state']=2;
				   $map['chulitime']=time();
				   $map['remarks']=(float)$successAmount!=(float)$realPrice?"[商户充值][出现卡损实际面值".$realPrice."]":"[商户充值][销卡成功]";
				   $yong=fanyong($uid,$or['orderno'],$amount,$map['profit']);
				   $map['yong']=$yong;
				   Db::name('order')->where(['id'=>$id])->update($map);
				   Db::name('user')->where(['id'=>$uid])->inc('money',(float)$ufeilv)->update();
				   addlog($uid,$ufeilv,2,$or['orderno'],$map['remarks']);
			   }elseif($state==3 && ($or['state']==1 || $or['state']==2)){
				   if($or['state']==2){
					   $map['settle_amt']=0;
					   $map['amount']= 0;
					   $map['state']=3;
					   $map['xitmoney']=0;
					   $map['chulitime']=time();
					   $map['profit']=0;
					   $map['remarks']= $remarks?$remarks:"[订单重设][销卡失败]";
					   Db::name('order')->where(['id'=>$id])->update($map);
					   Db::name('user')->where(['id'=>$uid])->dec('money',(float)$ufeilv)->update();
					   addlog($uid,-$ufeilv,4,$or['orderno'],$map['remarks']);
				   }else{
					   Db::name('order')->where(['id'=>$id])->update(['state'=>3,'remarks'=>$remarks?$remarks:"失败",'chulitime'=>time()]);
				   }
			   }else{
				   return "状态错误";
			   }
		   }else{
			   return "费率错误";
		   }
	   }else{
		   return "订单不存在";
	   }
	   Db::commit();
	   return true;
	}catch (\Exception $e) {
		Db::rollback();
		return $e->getMessage();
	}
}

function request_by_other($remote_server, $post_string)
{
    $context = array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'content' => http_build_query($post_string))
        );
    $stream_context = stream_context_create($context);
    $data = file_get_contents($remote_server, false, $stream_context);

    return $data;
} 
function getUserFeilv($uid,$tid,$money,$ok=true){
	$urate=Db::name('user_rate')->where(['shopid'=>$uid])->find()['content'];
	$urate=json_decode($urate,true);
	if(!$ok){
		return isset($urate[$tid]['open'])?$urate[$tid]['open']:0;
	}else{
		if(isset($urate[$tid])){
			if(is_numeric($money)){
			  $money=intval($money);
			}
			if(isset($urate[$tid][$money])){
				return $urate[$tid][$money];
			}else{
				return isset($urate[$tid][0])?$urate[$tid][0]:false;
			}
		}else{
			return false;
		}
	}
}
function orderType($state){
	$arr=['<span class="text-primary">等待受理</span>','<span class="text-danger">处理中</span>','<span class="text-success">处理成功</span>','<span class="text-warning">处理失败</span>'];
	return isset($arr[$state])?$arr[$state]:"--";
}
function sendEmail($email,$code,$stra="",$strb="",$type=""){
	$con=new think\facade\Config;
	$pei=$con::load('setting/email','email');
	$se=Db::name('Sysconfig')->where(['name'=>'sitename'])->value("value");
	if(isset($pei['type']) && $pei['type']==1){
		$dk='ssl';
	}else{
		$dk="";
	}
	$mail = new PHPMailer\PHPMailer\PHPMailer();
 
	$mail->isSMTP();// 使用SMTP服务
	$mail->CharSet = "utf8";// 编码格式为utf8，不设置编码的话，中文会出现乱码
	$mail->Host = $pei['stmp'];// 发送方的SMTP服务器地址
	$mail->SMTPAuth = true;// 是否使用身份验证
	$mail->Username = $pei['user'];// 发送方的163邮箱用户名，就是你申请163的SMTP服务使用的163邮箱</span><span style="color:#333333;">
	$mail->Password = $pei['pass'];// 发送方的邮箱密码，注意用163邮箱这里填写的是“客户端授权密码”而不是邮箱的登录密码！</span><span style="color:#333333;">
	$mail->SMTPSecure = $dk;// 使用ssl协议方式</span><span style="color:#333333;">
	$mail->Port = $pei['duankou'];// 163邮箱的ssl协议方式端口号是465/994
	$mail->setFrom($pei['user'],$se);// 设置发件人信息，如邮件格式说明中的发件人，这里会显示为Mailer(xxxx@163.com），Mailer是当做名字显示
	$mail->addAddress($email,'Wang');// 设置收件人信息，如邮件格式说明中的收件人，这里会显示为Liang(yyyy@163.com)
	//$mail->addReplyTo("xxx","Reply");// 设置回复人信息，指的是收件人收到邮件后，如果要回复，回复邮件将发送到的邮箱地址
	//$mail->addCC("xxx@163.com");// 设置邮件抄送人，可以只写地址，上述的设置也可以只写地址(这个人也能收到邮件)
	//$mail->addBCC("xxx@163.com");// 设置秘密抄送人(这个人也能收到邮件)
	//$mail->addAttachment("bug0.jpg");// 添加附件
	$mail->IsHTML(true);
	$mail->Subject = $se."-验证码邮件";// 邮件标题
	$cont=$pei['smgtpl'];
	$cont=str_replace("{code}",$code,$cont);
	if(!empty($stra)){
		$cont=str_replace($stra,$strb,$cont);
	}
	if($type=="login"){
		$str=$pei['login'];
		$str=str_replace("{title}",$se,$str);
		$str=str_replace("{url}",$_SERVER['SERVER_NAME'],$str);
		$str=str_replace("{code}",$code,$str);
		$str=str_replace("{dt}",date("Y/m/d"),$str);
		$str=str_replace("{dh}",date("H:i:s"),$str);
		$cont=str_replace("{ip}","[".request()->ip()."]",$str);
	}
	$mail->Body = str_replace("{code}",$code,$cont);// 邮件正文
	//$mail->AltBody = "This is the plain text纯文本";// 这个是设置纯文本方式显示的正文内容，如果不支持Html方式，就会用到这个，基本无用

	if(!$mail->send()){// 发送邮件
		return ['code'=>-1,'msg'=>$mail->ErrorInfo];
	}else{
		return ['code'=>1,'msg'=>'发送成功'];
	}

}
  function createLinkstring($para) {
		$arg  = "";
	while (list ($key, $val) = each ($para)) {
		$arg.=$key."=".$val."&";
	}
	//去掉最后一个&字符
	$arg = substr($arg,0,count($arg)-2);
	
	//如果存在转义字符，那么去掉转义
	if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}
	
	return $arg;
	}
    /*去掉字符空值*/
	function paraFilter($para){
		$para_filter = array();
		while (list ($key, $val) = each ($para)){
			if($key == "sign" || $key=="Sign" || $val === "" || $key=="s")continue;
			else
				$para_filter[$key] = $para[$key];
			}
			return $para_filter;
			}
   /*数组排序*/
   function argSort($para){
	   ksort($para);
	   reset($para);
	   return $para;
	   }
   function md5Verify($prestr,$key,$sign=null) {
	   $para=paraFilter($prestr);
	   $parm=argSort($para);
	   $prestr=createLinkstring($parm);
	   $prestr = $prestr."&Key=".$key;
	   $mysgin = md5($prestr);
	   if($sign==null){
		   return $mysgin;
	   }else{
	   if($mysgin == $sign || strtoupper($mysgin)==$sign) {
		   return true;
		   }else{
			   return false;
			}
	   }
	}
 function logt($word='') {
	$fp = fopen("log.txt","a");
	flock($fp, LOCK_EX) ;
	if(is_array($word)){
		foreach($word as $k=>$v){
			fwrite($fp,$k.">>>>".$v."\n");
		}
	}else{
	fwrite($fp,"执行日期：".strftime("%Y%m%d%H%M%S",time())."\n".$word."\n");
	}
	flock($fp, LOCK_UN);
	fclose($fp);
}
function adminlog($word='') {
	$fp = fopen("adminlog.txt","a");
	flock($fp, LOCK_EX) ;
	if(is_array($word)){
		foreach($word as $k=>$v){
			fwrite($fp,$k.">>>>".$v."\n");
		}
	}else{
	   fwrite($fp,"执行日期：".strftime("%Y%m%d%H%M%S",time())."\n".$word."\n");
	}
	flock($fp, LOCK_UN);
	fclose($fp);
}
 function arraytoxml($data){
		$str='<xml>';
		foreach($data as $k=>$v) {
			$str.='<'.$k.'>'.$v.'</'.$k.'>';
		}
		$str.='</xml>';
		return $str;
	}
 function xmltoarray($xml) { 
		//禁止引用外部xml实体 
		libxml_disable_entity_loader(true); 
		$xmlstring = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA); 
		$val = json_decode(json_encode($xmlstring),true); 
		return $val;
	}
/**
*提交类型**/
function sendType($batch,$single,$iscode){
	if($iscode>0){
		if($batch==1 || $single==1){
			return 4;
		}else{
			return 5;
		}
	}else{
		return 0;
	}
}

function realName($id,$user){
        $con=new think\facade\Config;
    	$pei=$con::load('setting/aly','aly');
		$host = "https://idcert.market.alicloudapi.com/idcard";
		$method = "GET";
		$appcode = $pei['appkey'];
		$headers = array();
		$headers = array();
		array_push($headers, "Authorization:APPCODE " . $appcode);
		$querys = "idCard={$id}&name=".UrlEncode($user);
    	$bodys = "";
        $url = $host ."?" . $querys;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        
        if (1 == strpos("$" . $host, "https://")) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $out_put = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		//curl_setopt($curl, CURLOPT_HEADER, true);   如不输出json, 请打开这行代码，打印调试头部状态码。
		//状态码: 200 正常；400 URL无效；401 appCode错误； 403 次数用完； 500 API网管错误

		list($header, $body) = explode("\r\n\r\n", $out_put, 2);
		
		if ($httpCode == 200) {
		    return json_decode($body,true);
        } else {
            $msg=['status'=>-1,'msg'=>"错误"]; 
            if ($httpCode == 400 && strpos($header, "Invalid Param Location") !== false) {
                $msg=['status'=>-1,'msg'=>"参数错误"];
            } elseif ($httpCode == 400 && strpos($header, "Invalid AppCode") !== false) {
                $msg=['status'=>-1,'msg'=>"AppCode错误"];
            } elseif ($httpCode == 400 && strpos($header, "Invalid Url") !== false) {
                $msg=['status'=>-1,'msg'=>"请求的 Method、Path 或者环境错误"];
            } elseif ($httpCode == 403 && strpos($header, "Unauthorized") !== false) {
                 $msg=['status'=>-1,'msg'=>"服务未被授权（或URL和Path不正确）"];
            } elseif ($httpCode == 403 && strpos($header, "Quota Exhausted") !== false) {
                $msg=['status'=>-1,'msg'=>"套餐包次数用完"];
            } elseif ($httpCode == 500) {
                 $msg=['status'=>-1,'msg'=>"API网关错误"];
            } elseif ($httpCode == 0) {
                $msg=['status'=>-1,'msg'=>"URL错误"]; 
            } else {
                $msg=['status'=>-1,'msg'=>"参数名错误 或 其他错误"]; 
            }
            	return $msg;
        }
	
	}
function isJsonBool($da = '', $assoc = false)
{
    $data = json_decode($da, $assoc);
    if (($data && is_object($data)) || (is_array($data) && !empty($data))) {
        return $data;
    }else{
       return false;
	}
}
function sendToAddress($ip){
	$con=new think\facade\Config;
	$pei=$con::load('setting/baiduapp','baiduapp');
	if($pei['type']==1){
		$url="http://api.map.baidu.com/location/ip?ip=%s&ak=%s&sn=%s";
		$uri="/location/ip";
		$querystring_arrays = array ('ip' => $ip,'ak' => $pei['ak']);
		$sn = caculateAKSN($pei['sk'],$uri,$querystring_arrays);
		$target = sprintf($url, $ip, $pei['ak'], $sn);
		$querystring_arrays['sn']=$sn;
		$html=vpost("http://api.map.baidu.com/location/ip",$querystring_arrays);
		$arr=json_decode($html,true);
		if((int)$arr['status']>0){
			return "未知地址";
		}else{
			return  $arr['content']['address'];
		}
	}else{
		return "数据关闭";
	}
}
function caculateAKSN($sk,$url,$querystring_arrays, $method = 'POST')
{  
    if ($method === 'POST'){  
        ksort($querystring_arrays);  
    }  
    $querystring = http_build_query($querystring_arrays);  
    return md5(urlencode($url.'?'.$querystring.$sk));  
}

function vpost($url, $data = array(),$ssl=false,$arr=[]) {// 模拟提交数据函数
    $curl = curl_init();
    // 启动一个CURL会话
    curl_setopt($curl, CURLOPT_URL, $url);
    // 要访问的地址
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    // 对认证证书来源的检查
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    // 从证书中检查SSL加密算法是否存在
    //curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    // 模拟用户使用的浏览器
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    // 使用自动跳转
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
    // 自动设置Referer
    curl_setopt($curl, CURLOPT_POST, 1);
    // 发送一个常规的Post请求
    @curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    // Post提交的数据包
    curl_setopt($curl, CURLOPT_TIMEOUT, 8);
	if($ssl){
		curl_setopt($curl, CURLOPT_SSLCERTTYPE, 'PEM');//证书类型
        curl_setopt($curl, CURLOPT_SSLCERT, root_path('config') . $arr['wxcert']);//证书位置 cert
        curl_setopt($curl, CURLOPT_SSLKEYTYPE, 'PEM');//CURLOPT_SSLKEY中规定的私钥的加密类型
        curl_setopt($curl, CURLOPT_SSLKEY, root_path('config') . $arr['wxfkey']);//证书位置key
	}
    // 设置超时限制防止死循环
    curl_setopt($curl, CURLOPT_HEADER, 0);
    // 显示返回的Header区域内容
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    // 获取的信息以文件流的形式返回
    $tmpInfo = curl_exec($curl);

    // 执行操作
    if (curl_errno($curl)) {
        return 'Errno' . curl_error($curl);
        //捕抓异常
    }else{
		curl_close($curl);
		// 关闭CURL会话
		return $tmpInfo;
	}
    // 返回数据
}

function sendMsg($photo,$cont,$code){
	$con=new think\facade\Config;
	$pei=$con::load('setting/qcloudsms','qcloudsms');
	switch($pei['atype']){
		case 1:
		  return sendmobile($photo,$cont,$code,$pei);
		break;
		case 2:
		  return yunpian($photo,$cont,$code,$pei);
		break;
		default:
		 return duanxin($photo,$cont,$code,$pei);
	}
		
}
function duanxin($photo,$cont,$code,$pei){
	try{
		$statusStr = array(
		"0" => "短信发送成功",
		"-1" => "参数不全",
		"-2" => "服务器空间不支持,请确认支持curl或者fsocket，联系您的空间商解决或者更换空间！",
		"30" => "密码错误",
		"40" => "账号不存在",
		"41" => "余额不足",
		"42" => "帐户已过期",
		"43" => "IP地址限制",
		"50" => "内容含有敏感词"
		);
		$smsapi = "http://api.smsbao.com/";
		$user = $pei['appid']; //短信平台帐号
		$pass = md5($pei['appkey']); //短信平台密码
		$content=$pei[$cont];//要发送的短信内容
		$content=str_replace("{code}",$code,$content);
		$phone = $photo;//要发送短信的手机号码
		$sendurl = $smsapi."sms?u=".$user."&p=".$pass."&m=".$phone."&c=".urlencode($content);
		$result =file_get_contents($sendurl) ;
		return ['code'=>$result==0?1:-1,'msg'=>$statusStr[$result]];
	}catch (\Exception $e){
		return ['code'=>-1,'msg'=>$e->getMessage()];
	}
}
function yunpian($mobile,$cont,$code,$pei){
	try{
		$content=$pei[$cont];//要发送的短信内容
		$text=str_replace("{code}",$code,$content);
	    header("Content-Type:text/html;charset=utf-8");
		$apikey = $pei['appkey']; //修改为您的apikey(https://www.yunpian.com)登录官网后获取
		$ch = curl_init();
		/* 设置验证方式 */
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:text/plain;charset=utf-8',
			'Content-Type:application/x-www-form-urlencoded', 'charset=utf-8'));
		/* 设置返回结果为流 */
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		/* 设置超时时间*/
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		/* 设置通信方式 */
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$data=array('text'=>$text,'apikey'=>$apikey,'mobile'=>$mobile);
		$json_data = psend($ch,$data);
		$array = json_decode($json_data,true);
		return ['code'=>$array['code']==0?1:-1,'msg'=>$array['msg']];
	}catch (\Exception $e){
		return ['code'=>-1,'msg'=>$e->getMessage()];
	}
 }

function psend($ch,$data){
    curl_setopt ($ch, CURLOPT_URL, 'https://sms.yunpian.com/v2/sms/single_send.json');
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    $result = curl_exec($ch);
    $error = curl_error($ch);
    return $result;
}

function sendmobile($phone,$cont,$code,$pei){
	try{
		$smsapi = "http://api.jisuapi.com/sms/send";
		$pass = $pei['appkey']; //短信平台密码
		$content=$pei[$cont];//要发送的短信内容
		$content=str_replace("{code}",$code,$content);
		$sendurl = $smsapi."?mobile=".$phone."&appkey=".$pass."&content=".$content;
		$result =file_get_contents($sendurl);
		$result=json_decode($result,true);
		var_dump($result);
		if($result['status']>0){
			return ['code'=>-1,'msg'=>$result['msg']];
		}else{
			return ['code'=>1,'msg'=>$result['msg']];
		}
	}catch (\Exception $e){
		return ['code'=>-1,'msg'=>$e->getMessage()];
	}
}

/*认证类型*/
function realType($value){
		switch($value){
			case 1:
			  $str="<span class='lay-span' style='background: #1e9fff;'>个人认证</span>";
			break;
			case 2:
			  $str="<span class='lay-span' style='background:#f46565;'>企业认证</span>";
			break;
			default:
			  $str="<span class='lay-span' style='background:#c2c2c2;'>未认证</span>";
		}
	return $str;
}
/*提现状态*/
function txType($value){
		switch($value){
			case 0:
			  $str="<span class='lay-span' style='background: #1e9fff;'>等待验证</span>";
			break;
			case 1:
			  $str="<span class='lay-span' style='background: #ff5a27;'>正在审核</span>";
			break;
			case 2:
			  $str="<span class='lay-span' style='background:#46be8a;'>审核成功</span>";
			break;
			case 4:
			  $str="<span class='lay-span' style='background:red;'>等待返回</span>";
			break;
			default:
			  $str="<span class='lay-span' style='background:#c2c2c2;'>失败退回</span>";
		}
	return $str;
}

//资金变动类型
 function moneyType($num){
	   $ty=array('','商户结算','商户充值','提现退票','订单重设','管理员修改',"佣金");
	   if(isset($ty[$num])){
		   return $ty[$num];
	   }else{
		   return '未知状态';
	   }
 }
 
function addlog($uid,$money,$type,$order="",$str=""){
		$map['uid']=$uid;
		$map['type']=$type;
		$map['price']=$money;
		$map['money']=Db::name('user')->where(['id'=>$uid])->value('money');
		$map['orderno']=$order;
		$map['data']=$str;
		$map['addtime']=time();
		return Db::name('money_log')->save($map);
	}
 
function security($user){
	$a=1;
	if(!empty($user['mobile']))$a++;
	if(!empty($user['tradepwd']))$a++;
	if(!empty($user['email']))$a++;
	return $a;
}
//生成密码和验证

function md6($str,$code=null){
	if($code==null){
		return password_hash($str, PASSWORD_DEFAULT);
	}else{
		return password_verify($str, $code);
	}
}
/*
*计算输出费率*/
function showFeilv($c,$mode){
	$arr=[];
	if(!is_array($c) || $mode==1)return "";
	foreach($c as $k=>$v){
		$arr[$k]=$v['flv'];
	}
	return max($arr)*100;
}
/**
 * 数组转xls格式的excel文件
 * @param $data
 * @param $title
 * 示例数据
 * @throws PHPExcel_Exception
 * @throws PHPExcel_Reader_Exception
 * @throws PHPExcel_Writer_Exception
 */
function export_excel($data=array(),$title=array(),$filename='报表')
{
        //处理中文文件名
        ob_end_clean();
        Header('content-Type:application/vnd.ms-excel;charset=utf-8');
        header("Content-Disposition:attachment;filename=export_data.xls");
        //处理中文文件名
        $ua = $_SERVER["HTTP_USER_AGENT"];
        $encoded_filename = urlencode($filename);
        $encoded_filename = str_replace("+", "%20", $encoded_filename);
        if (preg_match("/MSIE/", $ua) || preg_match("/LCTE/", $ua) || $ua == 'Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko') {
            header('Content-Disposition: attachment; filename="' . $encoded_filename . '.xls"');
        }else {
            header('Content-Disposition: attachment; filename="' . $filename . '.xls"');
        }
        header ( "Content-type:application/vnd.ms-excel" );
        $html = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";
		$html.="<html xmlns='http://www.w3.org/1999/xhtml'>";
		$html.="<meta http-equiv='Content-type' content='text/html;charset=UTF-8' /><head><title>".$filename."</title>";
		$html.="<style>td{text-align:center;font-size:12px;font-family:Arial, Helvetica, sans-serif;border:#1C7A80 1px solid;color:#152122;";
		$html.="width:auto;}table,tr{border-style:none;}.title{background:#C60;color:#FFFFFF;font-weight:bold;}</style>";
		$html.="</head><body><table width='100%' border='1'><tr>";
        foreach($title as $k=>$v){
            $html .= " <td class='title' style='text-align:center;'>".$v."</td>";
        }   
        $html .= "</tr>";    
        foreach ($data as $key =>$value) {
            $html .= "<tr>";
            foreach($value as $aa){
                $html .= "<td>".$aa."</td>";
            }
			$html .= "</tr>";
			}
        $html .= "</table></body></html>";
        echo $html;
        exit;
}

/**
 * http请求
 * @param string $url 请求的地址
 * @param array $data 发送的参数
 */
function https_request($url, $data = null)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    if (!empty($data)) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}

/**
 * 格式化字节大小
 * @param  number $size      字节数
 * @param  string $delimiter 数字和单位分隔符
 * @return string            格式化后的带单位的大小
 */
function format_bytes($size, $delimiter = '') {
    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
    for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
    return round($size, 2) . $delimiter . $units[$i];
}

/**
 * 把json字符串转数组
 * @param json $p
 * @return array
 */
function json_to_array($p)
{
    if (mb_detect_encoding($p, array('ASCII', 'UTF-8', 'GB2312', 'GBK')) != 'UTF-8') {
        $p = iconv('GBK', 'UTF-8', $p);
    }
    return json_decode($p, true);
}

// 生成唯一订单号
function build_order_no($dingdanzhui="")
{
    return $dingdanzhui.time().substr(microtime(),2,6).rand(0,3);
}
//计算提现手续费

function charges($money,$type){
	$con=new think\facade\Config;
	$res=$con::load('setting/cash','cash');
	$fei=0;
	switch($type){
		case 'bank':
		 $fei=$res['bankfeilv'];
		break;
		case 'alipay':
		  $fei=$res['alifeilv'];
		break;
		case 'weixin':
		  $fei=$res['wxfeilv'];
		break;
	}
	if($fei>=1){
		return $fei;
	}elseif($fei<1 && $fei>0){
		return sprintf("%.2f",$money*$fei);
	}else{
		return 0;
	}
}

/**
 * 获取随机位数数字
 * @param  integer $len 长度
 * @return string
 */
function rand_number($len = 6)
{
    return substr(str_shuffle(str_repeat('0123456789', 10)), 0, $len);
}
/**
 * 验证密码长度
 * @param string $password 需要验证的密码
 * @param int $min 最小长度
 * @param int $max 最大长度
 */
function check_password($password, $min, $max)
{
    if (strlen($password) < $min || strlen($password) > $max) {
        return false;
    }
    return true;
}
/**
 * 验证固定电话格式
 * @param string $tel 固定电话
 * @return boolean
 */
function check_tel($tel) {
    $chars = "/^([0-9]{3,4}-)?[0-9]{7,8}$/";
    if (preg_match($chars, $tel)) {
        return true;
    } else {
        return false;
    }
}

/**
 * 验证QQ号码是否正确
 * @param number $mobile
 */
function check_qq($qq)
{
    if (!is_numeric($qq)) {
        return false;
    }
    return true;
}

/**
 * 是否在微信中
 */
function in_wechat()
{
    $con=new think\facade\Config;
	$pei=$con::load('setting/wxpay','wxpay');
	if(isset($pei['faappid']) && isset($pei['fasecretID']) && !empty($pei['faappid']) && !empty($pei['fasecretID'])){
         return strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false;
	}else{
		return false;
	}
}


/**
 * 配置值解析成数组
 * @param string $value 配置值
 * @return array|string
 */
function parse_attr($value)
{
    if (is_array($value)) {
        return $value;
    }
    $array = preg_split('/[,;\r\n]+/', trim($value, ",;\r\n"));
    if (strpos($value, ':')) {
        $value = array();
        foreach ($array as $val) {
            list($k, $v) = explode(':', $val);
            $value[$k] = $v;
        }
    } else {
        $value = $array;
    }
    return $value;
}

/**
 * 数组层级缩进转换
 * @param array $array 源数组
 * @param int $pid
 * @param int $level
 * @return array
 */
function list_to_level($array, $pid = 0, $level = 1)
{
    static $list = [];
    foreach ($array as $k => $v) {
        if ($v['pid'] == $pid) {
            $v['level'] = $level;
            $list[]     = $v;
            unset($array[$k]);
            list_to_level($array, $v['id'], $level + 1);
        }
    }
    return $list;
}

/**
 * 把返回的数据集转换成Tree
 * @param array $list 要转换的数据集
 * @param string $pid parent标记字段
 * @param string $level level标记字段
 * @return array
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = 'children', $root = 0)
{
    // 创建Tree
    $tree = array();
    if (is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] = &$list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId = $data[$pid];
            if ($root == $parentId) {
                $tree[] = &$list[$key];
            } else {
                if (isset($refer[$parentId])) {
                    $parent           = &$refer[$parentId];
                    $parent[$child][] = &$list[$key];
                }
            }
        }
    }
    return $tree;
}

/**
 * 将list_to_tree的树还原成列表
 * @param  array $tree 原来的树
 * @param  string $child 孩子节点的键
 * @param  string $order 排序显示的键，一般是主键 升序排列
 * @param  array $list 过渡用的中间数组，
 * @return array        返回排过序的列表数组
 * @author yangweijie <yangweijiester@gmail.com>
 */
function tree_to_list($tree, $child = 'children', $order = 'id', &$list = array())
{
    if (is_array($tree)) {
        $refer = array();
        foreach ($tree as $key => $value) {
            $reffer = $value;
            if (isset($reffer[$child])) {
                unset($reffer[$child]);
                tree_to_list($value[$child], $child, $order, $list);
            }
            $list[] = $reffer;
        }
        $list = list_sort_by($list, $order, $sortby = 'asc');
    }
    return $list;
}
function get_template($template)
{
    return str_replace('.phtml','',$template);
}
/**
 * 对查询结果集进行排序
 * @access public
 * @param array $list 查询结果
 * @param string $field 排序的字段名
 * @param array $sortby 排序类型
 * asc正向排序 desc逆向排序 nat自然排序
 * @return array
 */
function list_sort_by($list, $field, $sortby = 'asc')
{
    if (is_array($list)) {
        $refer = $resultSet = array();
        foreach ($list as $i => $data) {
            $refer[$i] = &$data[$field];
        }

        switch ($sortby) {
            case 'asc': // 正向排序
                asort($refer);
                break;
            case 'desc': // 逆向排序
                arsort($refer);
                break;
            case 'nat': // 自然排序
                natcasesort($refer);
                break;
        }
        foreach ($refer as $key => $val) {
            $resultSet[] = &$list[$key];
        }

        return $resultSet;
    }
    return false;
}

// 驼峰命名法转下划线风格
function to_under_score($str)
{
    return strtolower($str);
}

/**
 * 自动生成新尺寸的图片
 * @param string $filename 文件名
 * @param int $width 新图片宽度
 * @param int $height 新图片高度(如果没有填写高度，把高度等比例缩小)
 * @param int $type 缩略图裁剪类型
 *                    1 => 等比例缩放类型
 *                    2 => 缩放后填充类型
 *                    3 => 居中裁剪类型
 *                    4 => 左上角裁剪类型
 *                    5 => 右下角裁剪类型
 *                    6 => 固定尺寸缩放类型
 * @return string     生成缩略图的路径
 */
function thumb($src = '', $width = 500, $height = 500, $type = 1, $replace = false)
{
    //判断URL
    if(strstr($src, request()->domain())){
        $src = './' .str_replace(request()->domain(),'',$src);
    }else{
        $src = './' . $src;
    }
    if (is_file($src) && file_exists($src)) {
        // 如果没有填写高度，把高度等比例缩小
        if ($height == null) {
            $info = getimagesize(root_path() . $filename);
            if ($width > $info[0]) {
                // 如果缩小后宽度尺寸大于原图尺寸，使用原图尺寸
                $width  = $info[0];
                $height = $info[1];
            } elseif ($width < $info[0]) {
                $height = floor($info[1] * ($width / $info[0]));
            } elseif ($width == $info[0]) {
                return $filename;
            }
        }
        $ext = pathinfo($src, PATHINFO_EXTENSION);
        $name = basename($src, '.' . $ext);
        $dir = dirname($src);
        if (in_array($ext, array('gif', 'jpg', 'jpeg', 'bmp', 'png'))) {
            $name = $name . '_thumb_' . $width . '_' . $height . '.' . $ext;
            $file = $dir . '/' . $name;
            if (!file_exists($file) || $replace == true) {
                $image = \think\Image::open($src);
                $image->thumb($width, $height, $type);
                $image->save($file);
            }
            $file = str_replace("\\", "/", $file);
            $file = '/' . trim($file, './');
            return $file;
        }
    }
    $src = str_replace("\\", "/", $src);
    $src = '/' . trim($src, './');
    return $src;
}

/**
 * 保存前台用户行为
 * @param string $remark 日志备注
 */
function insert_wechat_log($remark)
{
    session_id(input('sessionid'));
    db('userLog')->insert([
        'sid'     => Session::get('api_auth.shop_id'),
        'is_m'     => '2',
        'user_id'     => Session::get('api_auth.user_id'),
        'ip'          => request()->ip(),
        'url'         => request()->url(true),
        'method'      => request()->method(),
        'type'        => request()->type(),
        'param'       => json_encode(request()->param()),
        'remark'      => $remark,
        'create_time' => time(),
    ]);
}



/**
 * 检测是否微信用户登录
 * @return integer 0/管理员ID
 */
function is_wechat_login()
{
    $user = input('sessionid');
    if (empty($user)) {
        return 0;
    } else {
        return true;
    }
}

/**
 * 数据签名认证
 * @param  array $data 被认证的数据
 * @return string       签名
 */
function data_auth_sign($data)
{
    // 数据类型检测
    if (!is_array($data)) {
        $data = (array)$data;
    }
    ksort($data); // 排序
    $code = http_build_query($data); // url编码并生成query字符串
    $sign = sha1($code); // 生成签名
    return $sign;
}

/**
 * 清除系统缓存
 */
function clear_cache($directory = null)
{
    $directory = empty($directory) ? root_path() . 'runtime/cache/' : $directory;
    if (is_dir($directory) == false) {
        return false;
    }
    $handle = opendir($directory);
    while (($file = readdir($handle)) !== false) {
        if ($file != "." && $file != "..") {
            is_dir($directory . '/' . $file) ? clear_cache($directory . '/' . $file) : unlink($directory . '/' . $file);
        }
    }
    if (readdir($handle) == false) {
        closedir($handle);
        rmdir($directory);
    }
}
function check_email($email)
{
 $result = trim($email);
 if (filter_var($result, FILTER_VALIDATE_EMAIL))
 {
  return true;
 }
 else
 {
  return false;
 }
}
/**
 * 获取API用户ID
 * @param string $remark 日志备注
 */
function UserId()
{
    $info = session('user_auth.user_id');
    return $info;
}

// 将 select data 的值，转换成文字。
function get_select($selectName, $value, $join='，') {
    $arr = config('select_data.'.$selectName);
    if (is_array($value)) {
        $ret = [];
        foreach ($value as $v) {
            $ret[$v] = $arr[$v];
        }
        return implode($join, $ret);
    }else{
        return $arr[$value];
    }
}
// 将 select data 的值，转换成文字。
function list_select($optname,$value) {
    $arr = config('select_data.'.$optname);
    $ret = '';
    foreach ($arr as $k=>$v) {
        if($k==$value){
            $ret .= "<option value=\"$k\" selected>$v</option>";
        }else{
            $ret .= "<option value=\"$k\" >$v</option>";
        }
    }
    return $ret;
}
// 将 radio data 的值，转换成文字。
function list_radio($optname,$value,$name) {
    $arr = config('select_data.'.$optname);
    $ret = '';
    foreach ($arr as $k=>$v) {
        if($k==$value){
            $ret .= "<input type=\"radio\" name=\"$name\" value=\"$k\" title=\"$v\" checked>";
        }else{
            $ret .= "<input type=\"radio\" name=\"$name\" value=\"$k\" title=\"$v\">";
        }
    }
    return $ret;
}

/**
 * 获取时间参数
 * @return integer 0/管理员ID
 */
function time_trans($the_time)
{
    $now_time = time();
    $show_time = strtotime($the_time);
    $dur = $now_time - $show_time;
    if($dur < 60){
        return $dur.'秒前';
    }else if($dur < 3600){
        return floor($dur/60).'分钟前';
    }else if($dur < 86400) {
        return floor($dur/3600).'小时前';
    //}else if($dur < 259200) {//3天内
    //    return floor($dur / 86400) . '天前';
    }else{
        return $the_time;
    }
}
function tfen($str,$s,$e){
	 if($str){
		 $st="";
		 for($i=0;$i<$e;$i++){
			 $st.="*";
		 }
		$str=substr_replace($str,$st,$s,$e);
		return $str;
	 }else{
		 return "";
	 }
}
function is_user_login()
{
    $user = session('user_auth');
    if (empty($user)) {
        return 0;
    } else {
        return session('user_auth_sign') == data_auth_sign($user) ? $user['user_id'] : 0;
    }
}
/*
*登陆记录$type 1 登陆 2退出 3登陆错误
*/
function insert_user_log($type,$remark,$n="")
{
	$m=0;
    if (request()->isMobile()) {
        $m = 1;
    }else{
        $m = 0;
    }
	if(in_wechat()){
		$m=2;
	}
	$shop="";
	if($type==3 && $admin = User::where(['mobile' => $n])->find()){
		$shop=$admin['shopid'];
	}
    if (session('?user_auth') || ($type==3 && $shop)) {
		
        $id=Db::name('user_log')->insertGetId([
            'shopid'     => session('?user_auth.shop_id')?session('user_auth.shop_id'):$shop,
            'ism'     => $m,
            'ip'          => request()->ip(),
            'type'        => $type,
            'remark'      => $remark,
            'create_time' => time(),
        ]);
		if($type==1 || $type==3){
		   \think\facade\Queue::push("app\home\job\Jobone@getAdress", ['id'=>$id],'ipJobQueue');
	    }
    }
}
/**
 * 数组转换为数据集对象
 * @param array $resultSet 数据集数组
 * @return \think\model\Collection|\think\Collection
 */
function collection($resultSet)
{
    $item = current($resultSet);
    if ($item instanceof Model) {
        return \think\model\Collection::make($resultSet);
    } else {
        return \think\Collection::make($resultSet);
    }
}
function generate_password( $length = 8 ) { 
	 $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	 $password = "";  
	 for ( $i = 0; $i < $length; $i++ ){ 
		 $password .= substr($chars, mt_rand(0, strlen($chars)-1), 1);
		 $password .= $chars[ mt_rand(0, strlen($chars)-1) ];  
		 }  
		 return $password;
	}
/*生成Token*/

function makeToken()
    {
        $str = md5(uniqid(md5(microtime(true)), true)); //生成一个不会重复的字符串
        $str = sha1($str); //加密
        return $str;
    }