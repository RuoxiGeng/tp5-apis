<?php
/**
 * Created by PhpStorm.
 * User: ruoxigeng
 * Date: 2019-06-12
 * Time: 23:10
 */
namespace app\api\controller\v1;

use app\api\controller\Common;
use app\common\lib\Aes;
use app\common\lib\Alidayu;
use app\common\lib\exception\ApiException;
use app\common\lib\IAuth;
use app\common\model\User;

class Login extends Common {

   public function save() {
       if (!request()->isPost()) {
           return show(config('code.error'), '您没有权限', [], 403);
       }

       $param = input('param.');
       if(empty($param['phone'])) {
           return show(config('code.error'), '手机不合法', [], 404);
       }
       if(empty($param['code'])) {
           //敏感数据加密
           $param['code'] = Aes::decrypt($param['code']); // 1234
           return show(config('code.error'), '手机短信验证码不合法', [], 404);
       }

       $code = Alidayu::getInstance()->checkSmsIdentify($param['phone']);
       if($code != $param['code']) {
           return show(config('code.error'), '手机短信验证码不存在', [], 404);
       }

       $token = IAuth::setAppLoginToken($param['phone']);
       $data = [
           'token' => $token,
           'time_out' => strtotime("+".config('app.login_time_out_day')." days"),
       ];

       //查询手机号是否存在
       $user = User::get(['phone' => $param['phone']]);
       if($user && $user->status == 1) {
           //更新逻辑
           $id = model('User')->save($data, ['phone' => $param['phone']]);
       } else {
           //第一次登陆 注册数据
           $data['username'] = 'singwa粉-' . $param['phone'];
           $data['status'] = 1;
           $data['phone'] = $param['phone'];
           $id = model('User')->add($data);
       }

       $obj = new Aes(); //传输加密
       if($id) {
           $result = [
               'token' => $obj->encrypt($token."||".$id),
           ];
           return show(config('code.success'), 'OK', $result);
       } else {
           return show(config('code.error'), '登陆失败', 403);
       }
   }
}