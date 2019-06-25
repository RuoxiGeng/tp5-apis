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

class Version extends Base {

    /**
     * 通过apptype获取最后一条版本内容
     * @param string $appType
     */
    public function getLastNormalVersionByAppType($appType='') {
        $data = [
            'status' => 1,
            'app_type' => $appType,
        ];

        $order = [
            'id' => 'desc',
        ];

        return $this->where($data)
            ->order($order)
            ->limit(1)
            ->find();
    }
}