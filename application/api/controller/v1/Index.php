<?php
/**
 * Created by PhpStorm.
 * User: ruoxigeng
 * Date: 2019-06-12
 * Time: 23:10
 */
namespace app\api\controller\v1;

use think\Controller;
use app\api\controller\Common;
use app\common\lib\exception\ApiException;

class Index extends Common {

    /**
     * 获取首页接口
     * 1、头图 4-6
     * 2、推荐位列表 默认40条
     */
    public function index() {
        $heads = model('News')->getIndexHeadNormalNews();
        $heads = $this->getDealNews($heads);

        $positions = model('News')->getPositionNormalNews();
        $positions = $this->getDealNews($positions);

        $result = [
            'heads' => $heads,
            'positions' => $positions,
        ];

        return show(config('code.success'), 'OK', $result, 200);
    }
}