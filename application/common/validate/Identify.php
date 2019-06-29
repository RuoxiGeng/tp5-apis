<?php
/**
 * Created by PhpStorm.
 * User: ruoxigeng
 * Date: 2019-05-21
 * Time: 22:28
 */
namespace app\common\validate;

use think\Validate;

class Identify extends Validate {
    protected $rule = [
        'id' => 'require|number|length:11',
    ];
}
