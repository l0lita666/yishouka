<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2019 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]
namespace think;


header('Content-Type: text/html; charset=UTF-8');
// header("Cache-Control: no-store, no-cache");
// include 'txprotect.php';
function inject_checks($sql_str)
{
    $check = preg_match('/select|insert|update|document|eval|delete|script|alert|\'|--|union|into|load_file|outfile/', strtolower($sql_str));
    if ($check) {
        return true;
    } else {
        return false;
    }
}

foreach ($GLOBALS as $key => $value) {
    if ($key != '_SERVER') {
        $res = json_encode($value);
        $returns = inject_checks($res);
        if ($returns) {
            header('location:/404.html');
            die;
        }
    }
}
require __DIR__ . '/../vendor/autoload.php';


// 执行HTTP应用并响应
$http = (new App())->http;

$response = $http->name('home')->run();

$response->send();

$http->end($response);
