<?php
// 临时入口文件用于测试
require __DIR__ . '/vendor/autoload.php';

// 执行HTTP应用并响应
$http = (new \think\App())->http;

$response = $http->name('home')->run();

$response->send();

$http->end($response);
