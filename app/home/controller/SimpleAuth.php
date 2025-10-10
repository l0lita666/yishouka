<?php
namespace app\home\controller;
use app\common\controller\IndexBase;

use think\Request;
use think\Response;
use AlibabaCloud\SDK\Cloudauth\V20190307\Cloudauth;
use AlibabaCloud\Credentials\Credential;
use Darabonba\OpenApi\Models\Config;
use AlibabaCloud\SDK\Cloudauth\V20190307\Models\InitFaceVerifyRequest;
use AlibabaCloud\Tea\Utils\Utils\RuntimeOptions;
use AlibabaCloud\Tea\Exception\TeaError;


/**
 * 实名认证（阿里云实人认证）控制器
 * 路由示例：
 *  POST /SimpleAuth/initFaceVerify   → 获取认证链接（CertifyUrl）
 *  GET  /SimpleAuth/faceResult       → 认证回跳页（ReturnUrl）
 *  POST /SimpleAuth/describe         → 查询认证结果（可选）
 */
class SimpleAuth extends IndexBase
{
	public function  __construct(\think\App $app){
		parent::__construct($app);
	}
    /**
     * 显示实名认证页面
     */
    public function index()
    {
		
		//  return view('account/simple_auth',[
        //         'title'=>"实名认证",
        //     ]);
			
        // 获取真实用户登录数据
        $user = session('user_auth');
        if (!$user) {
            $this->redirect(url('home/Login/index'));
        }
        
        // 确保用户数据包含必要字段
        if (empty($user['mobile'])) {
            // 如果用户数据中没有手机号，尝试从数据库获取
            $userModel = new \app\common\model\User();
            $userInfo = $userModel->where('id', $user['user_id'])->find();
            if ($userInfo) {
                $user['mobile'] = $userInfo['mobile'] ?? '';
                $user['username'] = $userInfo['username'] ?? '';
            }
        }
        
        // 添加隐私保护显示
        $user['mobile_masked'] = $this->maskMobile($user['mobile'] ?? '');
        $user['idcard_masked'] = $this->maskIdCard('612401199208169417'); // 示例身份证号，实际应从用户数据获取
        
        // 获取用户的实名认证数据（如果有的话）
        $da = [];
        if (!empty($user['userReal'])) {
            $da = [
                'name' => $user['userReal']['name'] ?? '',
                'idcard' => $user['userReal']['idcard'] ?? '',
            ];
        }
        
        if(request()->isMobile()){
            return view('account/wap/simple_auth',[
                'title'=>"实名认证",
                'user' => $user,
                'da' => $da
            ]);
        }else{
            return view('account/simple_auth',[
                'title'=>"实名认证",
                'user' => $user,
                'da' => $da
            ]);
        }
    }
	
	 /**
     * 使用凭据初始化账号Client
     * @return Cloudauth Client
     */
    public  function createClient(){
        $credential = new Credential();
        $config = new Config([
            "credential" => $credential,
			"accessKeyId" => "ENV_ALIYUN_ACCESS_KEY_ID",
			"accessKeySecret" => "ENV_ALIYUN_ACCESS_KEY_SECRET",
        ]);
        $config->endpoint = "cloudauth.aliyuncs.com";
        return new Cloudauth($config);
    }
	
	
	/**
     * @param string[] $args
     * @return void
     */
    public function initFace(Request $request): Response
    {
        $params = $request->post();

        // 校验必填参数
        $required = [ 'certName', 'certNo', 'metaInfo', 'returnUrl'];
        foreach ($required as $key) {
            if (empty($params[$key])) {
                return json(['code' => 400, 'msg' => "缺少参数：$key"]);
            }
        }

        // 设置初始化请求参数
        $initRequest = new InitFaceVerifyRequest([
            'sceneId'      => 1000015222,
            'outerOrderNo' => time().rand(1,100),
            'productCode'  => "ID_PRO",
			'userId' =>1,
            'model'        => $params['model'] ?? 'LIVENESS',
            'certType'     => $params['certType'] ?? 'IDENTITY_CARD',
            'certName'     => $params['certName'],
            'certNo'       => $params['certNo'],
            'metaInfo'     => json_encode($params['metaInfo']),
            'returnUrl'    => $params['returnUrl']
        ]);
        $endpoints = [
            'cloudauth.cn-shanghai.aliyuncs.com',
            'cloudauth.cn-beijing.aliyuncs.com'
        ];

        foreach ($endpoints as $index => $endpoint) {
            try {
				$client = $this->createClient($endpoint);
				$runtime = new RuntimeOptions([
					'readTimeout' => 10000,
					'connectTimeout' => 10000,
				]);

				$response = $client->initFaceVerifyWithOptions($initRequest, $runtime);
				$body = $response->body;

				return json([
					'code' => 200,
					'msg'  => '初始化成功',
					'data' => [
						'certifyId' => $body->resultObject->certifyId ?? null,
						'certifyUrl'=> $body->resultObject->certifyUrl ?? null,
						'requestId' => $body->requestId ?? '',
						'result'    => $body->toMap(), // 可以转数组
					]
				]);

			} catch (\Exception $e) {
				return json([
					'code' => 500,
					'msg'  => '调用异常',
					'error' => $e->getMessage()
				]);
}

        }

        return json(['code' => 500, 'msg' => '所有区域调用失败']);
    }
	
	
	
	
    /**
     * 读取配置（优先 .env，其次 config/aliyun.php）
     */
    private function cfg($key, $default = '')
    {
        // 优先环境变量（使用 ThinkPHP 的 env 函数）
        $env = env($key);
        if ($env !== false && $env !== '') return $env;
        
        // 尝试从 ALIYUN 分组读取
        $aliyunKey = str_replace('ALIYUN_', '', $key);
        $env = env('ALIYUN.' . $aliyunKey);
        if ($env !== false && $env !== '') return $env;

        // 其次 ThinkPHP 配置（若你有 config/aliyun.php）
        // 期望键：
        // aliyun.cloudauth_ak, aliyun.cloudauth_sk, aliyun.product_code, aliyun.scene_id,
        // aliyun.region_id, aliyun.return_url
        $map = [
            'ALIYUN_AK'         => 'aliyun.cloudauth_ak',
            'ALIYUN_SK'         => 'aliyun.cloudauth_sk',
            'ALIYUN_PRODUCT'    => 'aliyun.product_code',
            'ALIYUN_SCENE_ID'   => 'aliyun.scene_id',
            'ALIYUN_REGION'     => 'aliyun.region_id',
            'ALIYUN_RETURN_URL' => 'aliyun.return_url',
        ];
        if (isset($map[$key])) {
            $v = config($map[$key]);
            if (!empty($v)) return $v;
        }
        
        // 直接读取 aliyun.php 配置
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
        try {
            // 检查用户是否已登录
            $user = session('user_auth');
            if (!$user) {
                return json(['code' => -1, 'msg' => '用户未登录，请先登录']);
            }
            
            // 验证用户session的有效性
            if (session('user_auth_sign') != data_auth_sign($user)) {
                return json(['code' => -1, 'msg' => '用户会话已过期，请重新登录']);
            }
            
            $name     = trim($request->post('name', ''));
            $idcard   = trim($request->post('idcard', ''));
            $metaInfo = $request->post('metaInfo', '');

// 兼容 application/json 直传
if (($name === '' || $idcard === '' || $metaInfo === '') && stripos($_SERVER['CONTENT_TYPE'] ?? '', 'application/json') !== false) {
    $raw = file_get_contents('php://input');
    $j = json_decode($raw, true);
    if (is_array($j)) {
        $name     = isset($j['name']) ? trim($j['name']) : $name;
        $idcard   = isset($j['idcard']) ? trim($j['idcard']) : $idcard;
        $metaInfo = $j['metaInfo'] ?? $metaInfo;
    }
}// 参数验证 - 使用IDENTITY_CARD时，姓名和身份证号都必填
            if ($name === '' || $idcard === '') {
                return json(['code' => -1, 'msg' => '参数缺失：使用身份证认证时，name和idcard都必填']);
            }
            
            // MetaInfo处理 - 根据阿里云文档，MetaInfo必须实时获取
            if (empty($metaInfo)) {
                return json(['code' => -1, 'msg' => 'MetaInfo参数缺失，请确保前端正确获取MetaInfo']);
            }
            
            // 如果metaInfo是数组，转换为JSON字符串
            if (is_array($metaInfo)) {
                $metaInfo = json_encode($metaInfo, JSON_UNESCAPED_UNICODE);
            }
            
            // 处理可能的HTML实体编码
            $metaInfo = html_entity_decode($metaInfo, ENT_QUOTES, 'UTF-8');
            
            // 验证MetaInfo是否为有效JSON
            $metaInfoDecoded = json_decode($metaInfo, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                // 如果JSON解析失败，记录详细信息用于调试
                error_log("MetaInfo解析失败: " . $metaInfo . " Error: " . json_last_error_msg());
                return json([
                    'code' => -1, 
                    'msg' => 'MetaInfo格式错误，必须是有效的JSON格式',
                    'debug' => [
                        'rawMetaInfo' => $metaInfo,
                        'jsonError' => json_last_error_msg()
                    ]
                ]);
            }
            // 获取阿里云配置
            $host    = 'https://cloudauth.aliyuncs.com';
            $method  = 'POST';
            $ak      = $this->cfg('ALIYUN_AK');
            $sk      = $this->cfg('ALIYUN_SK');
            $region  = $this->cfg('ALIYUN_REGION', 'cn-hangzhou');
            $product = $this->cfg('ALIYUN_PRODUCT', 'PV_FV');  // 金融级实人认证
            $sceneId = $this->cfg('ALIYUN_SCENE_ID');
            $return  = $this->cfg('ALIYUN_RETURN_URL', url('home/SimpleAuth/faceResult', [], true, true));
            $ossBucket = $this->cfg('ALIYUN_OSS_BUCKET');
            $ossObject = $this->cfg('ALIYUN_OSS_OBJECT');
    
            // 配置验证
            if (!$ak || !$sk || !$sceneId) {
                return json([
                    'code' => -2, 
                    'msg' => '服务端配置缺失：需配置 ALIYUN_AK/ALIYUN_SK/ALIYUN_SCENE_ID',
                    'serverConfig' => [
                        'AK' => !!$ak,
                        'SK' => !!$sk, 
                        'SCENE' => !!$sceneId,
                        'PRODUCT' => $product,
                        'REGION' => $region,
                        'RETURN' => $return
                    ]
                ]);
            }
    
            // 生成唯一订单号
            $outerOrderNo = 'auth_' . date('YmdHis') . '_' . mt_rand(1000, 9999);
    
            // 构建API请求参数 - 根据官方文档
            $params = [
                'Action'           => 'InitFaceVerify',
                'Version'          => '2019-03-07',
                'RegionId'         => $region,
                'ProductCode'      => $product,
                'SceneId'          => $sceneId,
                'OuterOrderNo'     => $outerOrderNo,
                'ReturnUrl'        => $return,
                'CertName'         => $name,
                'CertType'         => 'IDENTITY_CARD', // 身份证类型
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
            
            // 使用IDENTITY_CARD时，CertNo必填
            $params['CertNo'] = strtoupper($idcard);
                        
            // 生成签名
            $params['Signature'] = $this->generateSignature($params, $sk, $method);
  
            // 发起请求
            list($http, $resp, $err) = $this->doRequest($host, $method, $params);
    
            // 检查HTTP状态
            if ($http !== 200 || $resp === false) {
                return json([
                    'code' => -3, 
                    'msg' => '与阿里云通信失败', 
                    'http' => $http, 
                    'curlError' => $err
                ]);
            }
    
            // 解析响应
            $data = json_decode($resp, true);
            if (!is_array($data)) {
                return json([
                    'code' => -4, 
                    'msg' => '阿里云返回非JSON格式', 
                    'raw' => $resp
                ]);
            }
    
            // 检查API调用是否成功
            if (($data['Code'] ?? '') === 'Success' && !empty($data['ResultObject'])) {
                return json([
                    'code' => 0,
                    'msg' => 'ok',
                    'certifyId'  => $data['ResultObject']['CertifyId'] ?? '',
                    'certifyUrl' => $data['ResultObject']['CertifyUrl'] ?? '',
                    'outerOrder' => $outerOrderNo,
                ], 200, [], ['Content-Type' => 'application/json; charset=UTF-8']);
            }
    
            // API调用失败，返回详细错误信息
            return json([
                'code' => -5,
                'msg' => '阿里云API调用失败',
                'aliyunCode' => $data['Code'] ?? 'Unknown',
                'aliyunMessage' => $data['Message'] ?? 'Unknown error',
                'requestId' => $data['RequestId'] ?? null,
                'recommend' => $data['Recommend'] ?? null,
            ], 200, [], ['Content-Type' => 'application/json; charset=UTF-8']);
            
        } catch (\Throwable $e) {
            return json([
                'code' => -500,
                'msg' => '服务器异常：' . $e->getMessage()
            ]);
        }
    }

    /**
     * 回跳页面（ReturnUrl）
     * 阿里云认证完成后，会跳回此地址，根据官方文档处理认证结果
     * 注意：此方法不需要用户登录，因为它是阿里云的回调页面
     */
    public function faceResult(Request $request)
    {
        // 绕过父类的initialize方法，直接处理认证结果
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
            
            // 记录认证结果日志
            error_log("Face Auth Result: " . json_encode($authResult, JSON_UNESCAPED_UNICODE));
            
            // 返回JSON响应
            return json([
                'code' => 0,
                'msg' => '认证结果获取成功',
                'action' => $this->request->action(),
                'data' => $authResult
            ], 200, [], ['Content-Type' => 'application/json; charset=UTF-8']);
            
        } catch (\Throwable $e) {
            // 错误处理
            error_log("Face Auth Error: " . $e->getMessage());
            
            return json([
                'code' => -1,
                'msg' => '系统错误：' . $e->getMessage(),
                'data' => null
            ], 200, [], ['Content-Type' => 'application/json; charset=UTF-8']);
        }
    }
    
    /**
     * 重写initialize方法，对于faceResult方法跳过用户检查
     */
    public function initialize()
    {
        // 如果是faceResult方法，跳过父类的initialize
        $action = $this->request->action();
        error_log("SimpleAuth::initialize() - action: $action");
        
        if ($action === 'faceResult' || $action === 'faceresult') {
            error_log("SimpleAuth::initialize() - skipping parent initialize for faceResult");
            return;
        }
        
        // 其他方法正常调用父类的initialize
        error_log("SimpleAuth::initialize() - calling parent initialize");
        parent::initialize();
    }
    
    /**
     * 设置基本的模板变量（避免继承IndexBase的initialize）
     */
    private function setBasicTemplateVars()
    {
        // 获取系统配置
        $res = \app\common\model\Sysconfig::select()->toArray();
        $list = [];
        foreach($res as $k=>$v){
            $list[$v['name']]=$v['value'];
        }
        
        // 获取微信配置
        $wxapp = \think\facade\Config::load('setting/wxpay','wxpay');
        
        // 设置基本变量
        \think\facade\View::assign("C", array_merge($list, $wxapp));
        \think\facade\View::assign("contr", \think\facade\Request::controller());
        \think\facade\View::assign("action", \think\facade\Request::action());
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