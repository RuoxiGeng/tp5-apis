<?php
/**
 * Created by PhpStorm.
 * User: ruoxigeng
 * Date: 2019-06-10
 * Time: 22:03
 */
namespace app\common\model;

use http\Params;
use think\helper\Time;
use think\Model;

class User extends Base {
    /**
     * @param array $userIds
     */
    public function getUsersByUserId($userIds = []) {
        $data = [
            'id' => ['in', implode(',', $userIds)], //TP5 sql in 查询方式
            'status' => 1,
        ];

        $order = [
            'id' => 'desc',
        ];

        return $this->where($data)
            ->field(['id', 'username', 'image'])
            ->order($order)
            ->select();
    }
}