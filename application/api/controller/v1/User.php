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
use app\common\lib\exception\ApiException;

class User extends AuthBase {

    /**
     * 获取用户信息
     * 用户基本信息为敏感数据 加密处理
     */
   public function read() {
       $obj = new Aes();
       return show(config('code.success'), 'OK', $obj->encrypt($this->user));
   }
}