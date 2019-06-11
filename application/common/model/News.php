<?php
/**
 * Created by PhpStorm.
 * User: ruoxigeng
 * Date: 2019-06-10
 * Time: 22:03
 */
namespace app\common\model;

use http\Params;
use think\Model;

class News extends Base {
    /**
     * 后台自动化分页
     * @param array $data
     * @return array
     */
    public function getNews($data = []) {
        $data['status'] = [
            'neq', config('code.status_delete')
        ];
        $order = ['id' => 'desc'];

        $result = $this->where($data)
            ->order($order)
            ->paginate();

        return $result;
    }

    public function getNewsByCondition($condition = [], $from=0, $size=5) {
        $condition['status'] = [
            'neq', config('code.status_delete')
        ];
        $order = ['id' => 'desc'];

        $result = $this->where($condition)
            ->limit($from, $size)
            ->order($order)
            ->select();
//        echo $this->getLastSql();
        return $result;
    }

    /**
     * @param array $param
     */
    public function getNewsCountByCondition($condition = []) {
        $condition['status'] = [
            'neq', config('code.status_delete')
        ];

        return $this->where($condition)
            ->count();
    }
}