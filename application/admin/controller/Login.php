<?php
/**
 * Created by PhpStorm.
 * User: ruoxigeng
 * Date: 2019-05-22
 * Time: 22:04
 */
namespace app\admin\controller;

use think\Controller;
use app\common\lib\IAuth;

class Login extends Controller
{
    public function index() {
        return $this->fetch();
    }

    public function check() {
        if(request()->isPost()) {
            $data = input('post.');
            if(!captcha_check($data['code'])) {
                $this->error('验证码不正确');
            }
            //validate username password from post
            //username
            $user = model('AdminUser')->get(['username' => $data['username']]);
            if(!$user || $user->status != 1) {
                $this->error('用户不存在');
            }
            //password
            if(IAuth::setPassword($data['password']) != $user['password']) {
                $this->error('密码不正确');
            }

            halt($user);

        }else {
            $this->error('请求不合法');
        }
    }

    public function welcome() {
        return "dsd";
    }
}

