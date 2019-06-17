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
}