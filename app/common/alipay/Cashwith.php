<?php
/**
 * Created by PhpStorm.
 * User: 一往无前 314732607
 * Date: 2018/12/19
 * Time: 13:28
 */

namespace app\common\alipay;
use think\Session;
use think\Model;

class Cashwith{
	
	public function withdr($orderid,$userid='',$money='',$remarks=''){
		try{
	        $pei=\think\facade\Config::load('setting/alipay','alipay');
			$aop = new AopClient ();
			$aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do'; //请求url
			$aop->appId = $pei['appid'];        //商家支付宝APPID
			$aop->rsaPrivateKey = $pei['alimach'];    //私钥
			$aop->alipayrsaPublicKey=$pei['alikey'];    //支付宝公钥
			$aop->apiVersion = '1.0';    //版本号
			$aop->signType = 'RSA2';    //加密方式
			$aop->postCharset='utf-8';    
			$aop->format='xml';  //支付宝返回方式
			$out_biz_no = $orderid;    //订单号
			$request = new AlipayFundTransToaccountTransferRequest();
			$request->setBizContent("{" .
			"\"out_biz_no\":\"".$out_biz_no."\"," .
			"\"payee_type\":\"ALIPAY_LOGONID\"," .
			"\"payee_account\":\"".$userid."\"," .
			"\"amount\":\"".$money."\"," .
			"\"payer_show_name\":\"公司名\"," .
			"\"remark\":\"".$remarks."\"" .
			"}");
			$result = $aop->execute ( $request); 
			$responseNode = str_replace(".", "_", $request->getApiMethodName()) . "_response";
			$resultCode = $result->$responseNode->code;
			$result = json_decode(json_encode($result),true);
			if($result['code']== 10000 && $result['msg']=='Success'){
				//转账记录入库
				$data['code'] = 1;
				$data['msg'] = '企业转账';
				$data['out_biz_no'] = $out_biz_no;
				return  $data;
			} else {
				$data['code'] = 0;
				$data['msg'] = $result['sub_msg'];
				return $data;
			}
		}catch (\Exception $e) {
			$data['code'] = 0;
			$data['msg'] = $e->getMessage();
			return $data;
		};
    }

}