<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SignatureController extends Controller
{
    //

public function getSignPackage(Request $request) {
    $app_id='wx777e2e84af24f035';
    $secret='c0371a07d33782f930b0b745af55e55b';
    $inurl=$request->get('url');
    $signPackage=new jssdk($app_id,$secret,$inurl);
    $sign=$signPackage->getSignPackage();
    return $sign;
}

public function tenxun()
{
    $secret_id = "AKIDytgIk1HgQ4X7ZpJseGiz8wMgpnaGl4OX";
    $secret_key = "7B5qPLK8rOkvuiMiyEJDvRluqbAaUGrZ";

// 确定签名的当前时间和失效时间
    $current = time();
    $expired = $current + 86400;  // 签名有效期：1天
// 向参数列表填入参数
    $arg_list = array(
        "secretId" => $secret_id,
        "currentTimeStamp" => $current,
        "expireTime" => $expired,
        "random" => rand(),
        'procedure'=>"QCVB_SimpleProcessFile(1,0,0,0)"
    );

// 计算签名
    $orignal = http_build_query($arg_list);
    $signature = base64_encode(hash_hmac('SHA1', $orignal, $secret_key, true).$orignal);

    return $signature;
}
}