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

class Login extends Base
{
    /**
     * 覆盖初始化方法，防止死循环
     */
    public function _initialize()
    {
    }

    public function index() {
        $isLogin = $this->isLogin();
        if($isLogin) {
            return $this->redirect('index/index');
        }else {
            return $this->fetch();

        }
    }

    public function check() {
        if(request()->isPost()) {
            $data = input('post.');
            if(!captcha_check($data['code'])) {
                $this->error('验证码不正确');
            }
            //validate username password from post
            try {
                //username
                $user = model('AdminUser')->get(['username' => $data['username']]);
            }catch (\Exception $e) {
                $this->error($e->getMessage());
            }
                if(!$user || $user->status != config('code.status_normal')) {
                    $this->error('用户不存在');
                }
                //password
                if(IAuth::setPassword($data['password']) != $user['password']) {
                    $this->error('密码不正确');
                }
                //update database
                $udata = [
                    'last_login_time' => time(),
                    'last_login_ip' => request()->ip(),
                ];
            try{
                model('AdminUser')->save($udata, ['id' => $user->id]);
            }catch (\Exception $e) {
                $this->error($e->getMessage());
            }

            //session
            session(config('admin.session_user'), $user, config('session_user_scope'));
            $this->success('登陆成功', 'index/index');
//            halt($user);

        }else {
            $this->error('请求不合法');
        }
    }

    public function welcome() {
        return "dsd";
    }

    /**
     * 清空session, 跳转页面
     */
    public function logout() {
       session(null, config('session_user_scope'));
       $this->redirect('login/index');
    }
}

