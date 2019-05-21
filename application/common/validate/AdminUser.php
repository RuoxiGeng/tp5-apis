<?php
/**
 * Created by PhpStorm.
 * User: ruoxigeng
 * Date: 2019-05-21
 * Time: 22:28
 */
namespace app\common\validate;

use think\Validate;

class AdminUser extends Validate {
    protected $rule = [
        'username' => 'require|max:20',
        'password' => 'require|max:20',
    ];
}
