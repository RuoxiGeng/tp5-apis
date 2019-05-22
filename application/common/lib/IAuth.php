<?php
/**
 * Created by PhpStorm.
 * User: ruoxigeng
 * Date: 2019-05-22
 * Time: 22:52
 */
namespace app\common\lib;

class IAuth {
    /**
     * 设置密码
     * @param string $data
     * @return string
     */
    public static function setPassword($data) {
        return md5($data.config('app.password_pre_halt'));
    }
}