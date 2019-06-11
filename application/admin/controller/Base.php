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
    public $page = '';

    public $size = '';
    /**
     * 查询条件的起始值
     * @var int
     */
    public $from = 0;
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

    /**
     * 获取分页内容
     * @param $data
     */
    public function getPageAndSize($data) {
        $this->page = !empty($data['page']) ? $data['page'] : 1;
        $this->size = !empty($data['size']) ? $data['size'] : config('paginate.list_rows');
        $this->from = ($this->page - 1) * $this->size;
    }
}
