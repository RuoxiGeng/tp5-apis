<?php
/**
 * Created by PhpStorm.
 * User: ruoxigeng
 * Date: 2019-05-22
 * Time: 22:57
 */
return [
    'password_pre_halt' => '_#sing_ty',
    'aeskey' => '12f862d21dcfeafb57bckfrrt5yuiopf', //aes密钥, 服务端和客户端必须保持一致
    'apptypes' => [
        'ios',
        'android',
    ],
    'app_sign_time' => 10, //sign失效时间
    'app_sign_cache_time' => 20, //sign缓存失效时间
];