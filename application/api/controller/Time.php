<?php
/**
 * Created by PhpStorm.
 * User: ruoxigeng
 * Date: 2019-06-12
 * Time: 23:10
 */
namespace app\api\controller;

use think\Controller;

/**
 * 此接口保证客户端与服务端时间一制
 * Class Time
 * @package app\api\controller
 */
class Time extends Controller {
    public function index() {
        return show(1, 'OK', time());
    }
}