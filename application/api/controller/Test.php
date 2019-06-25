<?php
/**
 * Created by PhpStorm.
 * User: ruoxigeng
 * Date: 2019-06-12
 * Time: 23:10
 */
namespace app\api\controller;

use think\Controller;
use app\common\lib\exception\ApiException;
use ali\top\TopClient;
use ali\top\request\AlibabaAliqinFcSmsNumSendRequest;
use app\common\lib\Alidayu;

class Test extends Common {
    public function index() {
        return [
            'dsa',
            'fdsfds',
        ];
    }

    public function update($id = 0) {
        halt(input('put.'));
//        return $id;
    }

    /**
     * post 新增
     * @return mixed
     */
    public function save() {
        $data = input('post.');

        // 获取到提交数据 插入库，
        // 给客户端APP  =》 接口数据
        return show(1, 'OK', input('post.'), 201);
    }

    /**
     * 发送短信测试场景
     */
    public function sendSms() {
        $c = new TopClient;
        $c->appkey = "24528979";
        $c->secretKey = "ec6d90dc7e93b4cc824183f71710e1ee";
        $req = new AlibabaAliqinFcSmsNumSendRequest;
        $req->setExtend("123456");
        $req->setSmsType("normal");
        $req->setSmsFreeSignName("singwa娱乐app");
        $req->setSmsParam("{\"number\":\"4567\"}");
        $req->setRecNum("18618158941");
        $req->setSmsTemplateCode("SMS_75915048");
        $resp = $c->execute($req);
        halt($resp);
    }

    public function testsend() {
        Alidayu::getInstance()->sendSmsIdentify('18618158941');
    }
}