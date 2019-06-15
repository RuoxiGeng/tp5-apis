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

class Test extends Controller {
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

    public function save() {
        $data = input('post.');
        if($data['mt'] != 1) {
            throw new ApiException('数据不合法', 404);
        }
        return show(1, 'OK', input('post.'), 201);
    }
}