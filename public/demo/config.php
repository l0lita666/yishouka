<?php

const PID = 10075;//商户ID

const KEY = 'yBcmtZyt6uJitC3w1xZg581ISdUbiH';//商户sign加密密钥

const DESKEY='xt1nmN2HTwxnO9TS';//3des加密密钥

const URL="https://card.368ys.cn/api.php/tocard.html";//提交地址
/*
*$para @array
*拼接字符串
*/
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
	
/*
*$para @array
*去除不参加签名的sign和空值参数
*/
	
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
   function vpost($url, $data = array()) {// 模拟提交数据函数
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