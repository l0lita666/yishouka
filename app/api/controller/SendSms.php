<?php
declare (strict_types = 1);

namespace app\api\controller;

use think\facade\Log;
use think\Request;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Dysmsapi;
use Darabonba\OpenApi\Models\Config;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Models\SendSmsRequest;
class SendSms
{
    /**
     *发送短信
     * @return \think\Response
     */
    public function sendCode($mobile,$content,$templateCode)
    {
        $accessKeyId = env('ALIYUN.AK', '');
        $accessKeySecret = env('ALIYUN.SK', '');
        //接收手机号参数
        $phone= $mobile;
        //发短信
        $client = self::createClient($accessKeyId, $accessKeySecret);
        $sendSmsRequest = new SendSmsRequest([
            "phoneNumbers" => $phone,
            "signName" => "陕西松鼠跃动网络技术",
            "templateCode" => $templateCode,
            "templateParam" => json_encode($content,JSON_UNESCAPED_UNICODE)
        ]);
        $response =  $client->sendSms($sendSmsRequest);
        Log::info($mobile.'推送结果:'.$response->body->code);
        if ($response->body->code === 'OK') {
            return ['code'=>1,'msg'=>$response->body->message];
        } else {
            return ['code'=>-1,'msg'=>$response->body->message];
        }
    }
    /**
     * 使用AK&SK初始化账号Client
     * @param string $accessKeyId
     * @param string $accessKeySecret
     * @return Dysmsapi Client
     */
    public static function createClient($accessKeyId, $accessKeySecret){
        $config = new Config([
            // 您的AccessKey ID
            "accessKeyId" => $accessKeyId,
            // 您的AccessKey Secret
            "accessKeySecret" => $accessKeySecret
        ]);
        // 访问的域名
        $config->endpoint = "dysmsapi.aliyuncs.com";
        return new Dysmsapi($config);
    }
}