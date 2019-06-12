<?php
/**
 * Created by PhpStorm.
 * User: ruoxigeng
 * Date: 2019-06-12
 * Time: 23:10
 */
namespace app\api\controller;

use think\Controller;

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
        return input('post.');
    }
}