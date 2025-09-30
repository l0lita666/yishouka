<?php
return [
    'cloudauth_ak' => 'YOUR_ACCESS_KEY_ID',
    'cloudauth_sk' => 'YOUR_ACCESS_KEY_SECRET',
    'product_code' => 'PV_FV', // 根据官方文档，唯一取值：PV_FV
    'scene_id' => '1000015222',
    'region_id' => 'cn-hangzhou',
    'return_url' => 'https://www.ssyd.fun/SimpleAuth/faceResult',
    // OSS配置 - 根据控制台显示的OSS信息
    'oss_bucket_name' => 'cn-beijing-aliyun-cloudauth-2025061919326228',
    'oss_object_name' => 'face_contrast_' . date('YmdHis') . '.jpg',
];

