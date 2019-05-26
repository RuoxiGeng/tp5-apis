<?php
namespace app\admin\controller;

use think\Controller;

/**
 * 后台基础类库
 * Class Base
 * @package app\admin\controller
 */

class Base extends Controller
{
    /**
     * 初始化方法
     */
    public function _initialize() {
        $isLogin = $this->isLogin();
        if(!$isLogin) {
            return $this->redirect('login/index');
        }
    }

    public function isLogin() {
        $user = session(config('admin.session_user'), '', config('session_user_scope'));
        if($user && $user->id) {
            return true;
        }

        return false;
    }
}
