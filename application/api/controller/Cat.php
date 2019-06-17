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

class Cat extends Common {

    /**
     * 栏目接口, 从配置文件中读取 extra/cat.php
     */
    public function read() {
        $cats = config('cat.lists');

        $result[] = [
            'catid' => 0,
            'catname' => '首页',
        ];

        foreach ($cats as $catid => $catname) {
            $result[] = [
                'catid' => $catid,
                'catname' => $catname,
            ];
        }
        return show(config('code.success'), 'OK', $result, 200);
    }
}