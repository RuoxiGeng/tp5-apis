<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;

/**
 * 后台图片上传相关逻辑
 * Class Image
 * @package app\admin\controller
 */
class Image extends Base
{
    /**
     * 图片上传
     * @return mixed
     */
    public function upload() {
        $file = Request::instance()->file('file');
        $info = $file->move('upload');

        if($info && $info->getPathname()) {
            $data = [
                'status' => 1,
                'message' => 'OK',
                'data' => '/'.$info->getPathname(),
            ];
            echo json_encode($data); exit;
        }

        echo json_encode([ 'status' => 1, 'message' => 'Fail']);
    }
}
