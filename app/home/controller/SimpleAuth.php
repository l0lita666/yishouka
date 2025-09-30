<?php
namespace app\home\controller;

use app\common\controller\IndexBase;
use think\Request;

/**
 * 实名认证（阿里云实人认证）控制器
 * 路由示例：
 *  POST /SimpleAuth/initFaceVerify   → 获取认证链接（CertifyUrl）
 *  GET  /SimpleAuth/faceResult       → 认证回跳页（ReturnUrl）
 *  POST /SimpleAuth/describe         → 查询认证结果（可选）
 */
class SimpleAuth extends IndexBase
{
	public function __construct(){
		parent::initialize();
	}
    /**
     * 显示实名认证页面
     */
    public function index()
    {
        // 获取真实用户登录数据
        $user = session('user_auth');
        if (!$user) {
            $this->redirect(url('home/Login/index'));
        }
        
        // 确保用户数据包含必要字段
        if (empty($user['mobile'])) {
            // 临时测试：使用默认手机号
            $user['mobile'] = '16619884636';
            $user['username'] = '测试用户';
        }
        
        // 添加隐私保护显示
        $user['mobile_masked'] = $this->maskMobile($user['mobile'] ?? '');
        $user['idcard_masked'] = $this->maskIdCard('612401199208169417'); // 示例身份证号，实际应从用户数据获取
        
        if(request()->isMobile()){
            return view('account/wap/simple_auth',[
                'title'=>"实名认证",
                'user' => $user
            ]);
        }else{
            return view('account/simple_auth',[
                'title'=>"实名认证",
                'user' => $user
            ]);
        }
    }
    
    
    /**
     * 读取配置（优先 .env，其次 config/aliyun.php）
     */
    private function cfg($key, $default = '')
    {
        // 直接读取 aliyun.php 配置（因为 .env 文件读取有问题）
        $aliyunConfig = config('aliyun');
        if (is_array($aliyunConfig)) {
            $directMap = [
                'ALIYUN_AK'         => 'cloudauth_ak',
                'ALIYUN_SK'         => 'cloudauth_sk',
                'ALIYUN_PRODUCT'    => 'product_code',
                'ALIYUN_SCENE_ID'   => 'scene_id',
                'ALIYUN_REGION'     => 'region_id',
                'ALIYUN_RETURN_URL' => 'return_url',
                'ALIYUN_OSS_BUCKET' => 'oss_bucket_name',
                'ALIYUN_OSS_OBJECT' => 'oss_object_name',
            ];
            if (isset($directMap[$key]) && isset($aliyunConfig[$directMap[$key]])) {
                return $aliyunConfig[$directMap[$key]];
            }
        }
        
        return $default;
    }

    /**
     * RFC3986 百分号编码（阿里云签名要求）
     */
    private function percentEncode($str)
    {
        $res = urlencode($str);
        $res = str_replace(['+','*','%7E'], ['%20','%2A','~'], $res);
        return $res;
    }

    /**
     * 手机号隐私保护
     */
    private function maskMobile($mobile)
    {
        if (empty($mobile) || strlen($mobile) < 7) {
            return $mobile;
        }
        return substr($mobile, 0, 3) . '****' . substr($mobile, -4);
    }
    
    /**
     * 身份证号隐私保护
     */
    private function maskIdCard($idcard)
    {
        if (empty($idcard) || strlen($idcard) < 8) {
            return $idcard;
        }
        return substr($idcard, 0, 6) . '********' . substr($idcard, -4);
    }
    
    /**
     * 姓名隐私保护
     */
    private function maskName($name)
    {
        if (empty($name) || mb_strlen($name) < 2) {
            return $name;
        }
        $len = mb_strlen($name);
        if ($len == 2) {
            return mb_substr($name, 0, 1) . '*';
        } else {
            return mb_substr($name, 0, 1) . str_repeat('*', $len - 2) . mb_substr($name, -1);
        }
    }

    /**
     * 生成阿里云 RPC 签名
     */
    private function generateSignature(array $params, $accessKeySecret, $method = 'POST')
    {
        // 移除Signature参数（如果存在）
        unset($params['Signature']);
        
        ksort($params);
        $pairs = [];
        foreach ($params as $k => $v) {
            $pairs[] = $this->percentEncode($k) . '=' . $this->percentEncode($v);
        }
        $canonicalizedQuery = implode('&', $pairs);
        $stringToSign = $method . '&' . $this->percentEncode('/') . '&' . $this->percentEncode($canonicalizedQuery);
        
        return base64_encode(hash_hmac('sha1', $stringToSign, $accessKeySecret . '&', true));
    }

    /**
     * 发起请求
     */
    private function doRequest($host, $method, array $params)
    {
        $ch = curl_init($host);
        curl_setopt_array($ch, [
            CURLOPT_CUSTOMREQUEST  => $method,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => http_build_query($params),
            CURLOPT_HTTPHEADER     => ['Content-Type: application/x-www-form-urlencoded; charset=UTF-8'],
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_TIMEOUT        => 15,
        ]);
        $resp = curl_exec($ch);
        $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $err  = curl_error($ch);
        curl_close($ch);

        return [$http, $resp, $err];
    }

    /**
     * 初始化实人认证，获取 CertifyUrl
     * 前端需提交：name, idcard, metaInfo
     */
    public function initFaceVerify(Request $request)
    {
        error_log('HIT_FACEAUTH_' . date('His'));
        try {
            $name     = trim($request->post('name', ''));
            $idcard   = trim($request->post('idcard', ''));
            $metaInfo = $request->post('metaInfo', '');
    
            if ($name === '' || $idcard === '' || $metaInfo === '') {
                return json([
                    'code' => -1,
                    'msg'  => '参数缺失：name/idcard/metaInfo 必填'
                ]);
            }
            
            // MetaInfo处理
            if (is_array($metaInfo)) {
                $metaInfo = json_encode($metaInfo, JSON_UNESCAPED_UNICODE);
            }
            $metaInfo = html_entity_decode($metaInfo, ENT_QUOTES, 'UTF-8');
    
            $host    = 'https://cloudauth.aliyuncs.com';
            $method  = 'POST';
            $ak      = $this->cfg('ALIYUN_AK');
            $sk      = $this->cfg('ALIYUN_SK');
            $region  = $this->cfg('ALIYUN_REGION', 'cn-hangzhou');
            $sceneId = $this->cfg('ALIYUN_SCENE_ID', '1000014019');
            $return  = $this->cfg('ALIYUN_RETURN_URL', url('home/SimpleAuth/faceResult', [], true, true));
    
            if (!$ak || !$sk || !$sceneId) {
                return json([
                    'code'   => -2,
                    'msg'    => '服务端配置缺失：请检查 ALIYUN_AK/ALIYUN_SK/ALIYUN_SCENE_ID',
                    'detail' => ['AK'=>!!$ak,'SK'=>!!$sk,'SCENE'=>$sceneId]
                ]);
            }
    
            $outerOrderNo = 'auth_' . date('YmdHis') . '_' . mt_rand(1000, 9999);
    
            $params = [
                'Action'           => 'InitFaceVerify',
                'Version'          => '2019-03-07',
                'RegionId'         => $region,
                'ProductCode'      => 'PV_FV',              // ✅ 人证比对 + 活体检测
                'SceneId'          => $sceneId,
                'OuterOrderNo'     => $outerOrderNo,
                'ReturnUrl'        => $return,
    
                'CertType'         => 'IDENTITY_CARD',      // ✅ 明确证件类型
                'CertName'         => $name,
                'CertNo'           => strtoupper($idcard),  // ✅ 校验位大写 X
                'MetaInfo'         => $metaInfo,
                'UserId'           => 'user_' . mt_rand(100000, 999999), // 根据官方文档添加UserId
    
                // 公共参数
                'AccessKeyId'      => $ak,
                'SignatureMethod'  => 'HMAC-SHA1',
                'SignatureVersion' => '1.0',
                'Timestamp'        => gmdate('Y-m-d\TH:i:s\Z'),
                'SignatureNonce'   => bin2hex(random_bytes(8)),
                'Format'           => 'JSON',
            ];
            $params['Signature'] = $this->generateSignature($params, $sk, $method);
    
            list($http, $resp, $err) = $this->doRequest($host, $method, $params);
    
            if ($http !== 200 || $resp === false) {
                return json(['code' => -3, 'msg' => '请求失败', 'http'=>$http, 'err'=>$err]);
            }
    
            $data = json_decode($resp, true);
            if (!is_array($data)) {
                return json(['code' => -4, 'msg' => '返回解析失败', 'raw'=>$resp]);
            }
    
            if (($data['Code'] ?? '') === 'Success' && !empty($data['ResultObject'])) {
                $res = $data['ResultObject'];
                return json([
                    'code'       => 0,
                    'msg'        => 'ok',
                    'certifyId'  => $res['CertifyId'] ?? '',
                    'certifyUrl' => $res['CertifyUrl'] ?? '',
                    'outerOrder' => $outerOrderNo
                ]);
            }
    
            return json([
                'code'          => -5,
                'msg'           => '阿里云API调用失败',
                'aliyunCode'    => $data['Code']    ?? null,
                'aliyunMessage' => $data['Message'] ?? null,
                'requestId'     => $data['RequestId'] ?? null,
                'resp'          => $data
            ]);
    
        } catch (\Throwable $e) {
            return json(['code' => -500, 'msg' => '服务器异常：' . $e->getMessage()]);
        }
    }

    /**
     * 回跳页面（ReturnUrl）
     * 阿里云认证完成后，会跳回此地址，根据官方文档处理认证结果
     */
    public function faceResult(Request $request)
    {
        try {
            // 根据阿里云文档，认证结果会通过response参数返回
            $response = $request->get('response', '');
            $certifyId = $request->get('certifyId', '');
            $outerOrder = $request->get('outerOrderNo', '');
            
            // 解析response参数（URL编码的JSON）
            $result = null;
            if (!empty($response)) {
                $decodedResponse = urldecode($response);
                $result = json_decode($decodedResponse, true);
            }
            
            // 提取认证结果信息
            $authResult = [
                'code' => $result['code'] ?? '',
                'subCode' => $result['subCode'] ?? '',
                'reason' => $result['reason'] ?? '',
                'certifyId' => $result['extInfo']['certifyId'] ?? $certifyId,
                'outerOrder' => $outerOrder,
                'rawResponse' => $response
            ];
            
            // 返回认证结果页面
            return view('account/face_result', [
                'title' => '认证结果',
                'authResult' => $authResult,
                'certifyId' => $authResult['certifyId'],
                'outerOrder' => $authResult['outerOrder']
            ]);
            
        } catch (\Throwable $e) {
            // 错误处理
            return view('account/face_result', [
                'title' => '认证结果',
                'authResult' => [
                    'code' => 'ERROR',
                    'reason' => '系统错误：' . $e->getMessage()
                ],
                'certifyId' => '',
                'outerOrder' => ''
            ]);
        }
    }

    /**
     * 查询认证结果（可选：前端在回跳后调用）
     * 根据阿里云官方文档，用于获取最终认证结果
     * 入参：certifyId
     */
    public function describe(Request $request)
    {
        try {
            $certifyId = trim($request->post('certifyId', ''));
            if ($certifyId === '') {
                return json(['code' => -1, 'msg' => 'certifyId 不能为空']);
            }

            // 获取阿里云配置
            $host    = 'https://cloudauth.aliyuncs.com';
            $method  = 'POST';
            $ak      = $this->cfg('ALIYUN_AK');
            $sk      = $this->cfg('ALIYUN_SK');
            $region  = $this->cfg('ALIYUN_REGION', 'cn-hangzhou');

            if (!$ak || !$sk) {
                return json(['code' => -2, 'msg' => '服务端配置缺失：请设置 ALIYUN_AK/ALIYUN_SK']);
            }

            // 构建查询参数
            $params = [
                'Action'           => 'DescribeFaceVerify',
                'Version'          => '2019-03-07',
                'RegionId'         => $region,
                'CertifyId'        => $certifyId,

                // 公共参数
                'AccessKeyId'      => $ak,
                'SignatureMethod'  => 'HMAC-SHA1',
                'SignatureVersion' => '1.0',
                'Timestamp'        => gmdate('Y-m-d\TH:i:s\Z'),
                'SignatureNonce'   => bin2hex(random_bytes(8)),
                'Format'           => 'JSON',
            ];
            
            // 生成签名
            $params['Signature'] = $this->generateSignature($params, $sk, $method);

            // 发起请求
            list($http, $resp, $err) = $this->doRequest($host, $method, $params);
            
            if ($http !== 200 || $resp === false) {
                return json([
                    'code' => -3, 
                    'msg' => '请求失败：' . ($err ?: "HTTP $http")
                ]);
            }

            // 解析响应
            $data = json_decode($resp, true);
            if (!is_array($data)) {
                return json([
                    'code' => -4, 
                    'msg' => '返回解析失败', 
                    'raw' => $resp
                ]);
            }

            // 检查API调用是否成功
            if (isset($data['Code']) && $data['Code'] === 'Success') {
                $resultObject = $data['ResultObject'] ?? [];
                
                // 根据阿里云文档，Passed字段表示认证结果：T=通过，F=不通过
                $passed = $resultObject['Passed'] ?? 'F';
                $subCode = $resultObject['SubCode'] ?? '';
                $materialInfo = $resultObject['MaterialInfo'] ?? '';
                
                return json([
                    'code' => 0, 
                    'msg' => 'ok', 
                    'data' => [
                        'passed' => $passed === 'T',
                        'subCode' => $subCode,
                        'materialInfo' => $materialInfo,
                        'rawResult' => $resultObject
                    ]
                ]);
            }

            // API调用失败
            $code = $data['Code'] ?? 'Unknown';
            $msg  = $data['Message'] ?? 'Unknown';
            return json([
                'code' => -5, 
                'msg' => "阿里云API调用失败: $code - $msg", 
                'aliyunCode' => $code,
                'aliyunMessage' => $msg,
                'requestId' => $data['RequestId'] ?? null
            ]);

        } catch (\Throwable $e) {
            return json([
                'code' => -500, 
                'msg' => '服务器异常：' . $e->getMessage()
            ]);
        }
    }
}