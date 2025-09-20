<?php
declare(strict_types=1);

namespace app\home\controller;

use think\Request;
use think\Response;
use AlibabaCloud\SDK\Cloudauth\V20190307\Cloudauth;
use AlibabaCloud\Credentials\Credential;
use Darabonba\OpenApi\Models\Config;
use AlibabaCloud\SDK\Cloudauth\V20190307\Models\InitFaceVerifyRequest;
use AlibabaCloud\Tea\Utils\Utils\RuntimeOptions;
use AlibabaCloud\Tea\Exception\TeaError;
use app\common\controller\IndexBase;

class Aliverify extends IndexBase
{
    /**
     * 创建 Cloudauth 客户端
     */
    private function createClient(string $endpoint)
    {
        $credential = new Credential(); // 从配置文件或环境变量读取 AK/SK
        $config = new Config([
            'credential' => $credential,
            'endpoint'   => $endpoint,
        ]);
        return new Cloudauth($config);
    }

    /**
     * 初始化人脸认证
     * @param Request $request
     * @return Response
     */
    public function initFace(Request $request)
    {
        $params = $request->post();

        // 校验必填参数
        $required = [ 'certName', 'certNo'];
        foreach ($required as $key) {
            if (empty($params[$key])) {
                return json(['code' => 400, 'msg' => "缺少参数：$key"]);
            }
        }
        // 设置初始化请求参数
        $initRequest = new InitFaceVerifyRequest([
            'sceneId'      => 1000014019,
            'outerOrderNo' => md5(rand(0,99).time()),
            'productCode'  => 'ID_PRO',
            'model'        => $params['model'] ?? 'LIVENESS',
            'certType'     => $params['certType'] ?? 'IDENTITY_CARD',
            'certName'     => $params['certName'],
            'certNo'       => $params['certNo'],
            'metaInfo'     => json_encode([
  "bioMetaInfo"=>"4.1.0:2916352,0",
  "deviceType"=> "web",
  "ua"=> "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36",
  "guardToken"=> "V0VCX1BSRUlEI3NoZjljYWRlNTdoczVmOWI5NzdmMDIyMzVhNmQ4MDZjLWgtMTc1MTU0MDcyMjk0Ny01MjQ3MWNjOGEzZjQ0NzA2YjZiNDE4NzM4NDc0MTQyNiN3VFdVL3VKcTFGV3BRTnZ0R0haaElES0pMazFGU3YybU41bm5xaEw1a3BkdE1vVElCMCtBTmhJNDRody9oVDV1Y3R3Q05XNnRIalZUT2J4VkpwUi9qNDZYV2YwNVJtTGFUWS9WRVIxd1hHQnZyRHBwV2xnZlp5OTg0NEF4YWlsVWhqWEVaWGVteG9BK21oUGdmcFRuenoxVGNUZGlRRitBTUNQVmdPWEp1M2pSeDFtdjFmQkZnQjdUcVpmVXZmQldZWW43Nlc3Y1ZNVlc2alJjbU43UEhrTm80R1RUcFJBV2I4eEpKZUMxVXd2NUFTL3ovVC96aFlNeWZ4K2M2dEwzS2oySE9KT3I1NTdqSHZHdnpTN0FFSUZqWjJDSERtZnhsWnl2dTI3cEZyOXBPUERMWkF5TXJhdnhublo4VFBxUnRZN1EwcldtNGdFeXRDaU9oc2hUYVdpajQvWkFqQzZOUG01R0hXeEV0OEM3VmxPclRES0wrZzYzU3BxM2tnemVFRnYyRUw2WkFIZGgvNHdTSjNvR0dGa2htb1k4Y25LbDFyMkN3SERLWk5HYVhZd0JzOENnM3FpRGlnL1N5Z1hicTNEeGpnTmJnSmhVVkdPUERldWRwTnREaFg4M3JvcHljVDc2SklQQ3l1cGVjVXdvQ1BFVGJwZk5ZVHdjMXliejNoUm4ycmM1R3oyV09oZm9CUmIrWEc0Zmo4Sjl6eStNeC9YTzdNNUVwZ3YwMEM0bVZESlFKZ01hQmZLdVlacTZaM1F5aStlcDU0L3Zta1JtOHRpNUJsWmM4NThZTXBMcVF4MmdhMHVPcGgxTmJYSkNZa1JZRkYvZEcveE40cnVMT3NTdlBvZkN1MzJEdWp2enhFbWN3NVE4a0FNWDc1Yjd4bmlBSHNsRjRCN2Z3b0dGYncwVS9Ud3V1ZXdyZDN6YW5yeFlockNzejJnRWRIM1FzY1BCTEFPdm5EYjY1OS83aWdmMlJrRlNMNG89IzAjZjEzOWVmMTAyOGI2OGNkZWVjZWJlNTJjMjg4YTViM2Y="
]),
            'returnUrl'    => "https://ssyd.fun"
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
                // 如果服务端报500错误，尝试下一个
				if ($response->statusCode === 500 || 
					($response->body && $response->body->code === '500')) {
					continue;
				}

				// 成功返回
				return json([
					'code' => 200,
					'msg'  => '初始化成功',
					'data' => [
						'certifyId' => $response->body->resultObject->certifyId ?? null,
						'requestId' => $response->body->requestId ?? '',
						'result'    => $response->body->toMap(), // 如果你需要原始结构
					]
				]);
            } catch (\Exception $e) {
                if ($index === count($endpoints) - 1) {
                    return json([
                        'code' => 500,
                        'msg'  => '调用异常',
                        'error' => $e->getMessage()
                    ]);
                }
                // 吞掉中间的错误，继续下一个 endpoint
            }
        }

        return json(['code' => 500, 'msg' => '所有区域调用失败']);
    }
}
