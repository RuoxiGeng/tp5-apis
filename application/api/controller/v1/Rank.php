<?php
/**
 * Created by PhpStorm.
 * User: ruoxigeng
 * Date: 2019-06-12
 * Time: 23:10
 */
namespace app\api\controller\v1;

use app\api\controller\Common;
use app\common\lib\exception\ApiException;

class Rank extends Common {

    /**
     * 获取排行榜列表
     * 1、获取数据库 按read_count排序 5-10
     * 2、优化 redis排行榜
     */
    public function index() {
        try {
            $rands = model('News')->getRankNormalNews();
            $rands = $this->getDealNews($rands);
        }catch (\Exception $e) {
            return new ApiException('error', 400);
        }
        return show(config('code.success'), 'OK', $rands, 200);
    }
}