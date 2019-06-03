<?php
/**
 * Created by PhpStorm.
 * User: ruoxigeng
 * Date: 2019-06-03
 * Time: 21:47
 */
namespace app\common\lib;

use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

/**
 * 图片上传基类
 * Class Upload
 * @package app\common\lib
 */
class Upload {
    public static function image() {
        if(empty($_FILES['files']['tmp_name'])) {
            exception('您提交的图片不合法', 404);
        }
        //要上传的文件
        $file = $_FILES['files']['tmp_name'];
//        $ext = explode('.', $_FILES['files']['tmp_name']);
//        $ext = $ext[1];
        $pathinfo = pathinfo($_FILES['files']['tmp_name']);
        $ext = $pathinfo['extension'];

        //构建一个鉴权对象
        $config = config('qiniu');
        $auth = new Auth($config['ak'], $config['sk']);
        //生成token
        $token = $auth->uploadToken($config['bucket']);
        //上传七牛云后保存的文件名
        $key = date('Y')."/".date('m')."/".substr(md5($file), 0, 5).date('YmdHis').rand(0, 9999).'.'.$ext;
        //初始化uploadmanager
        $uploadMgr = new UploadManager();
        list($ret, $err) = $uploadMgr->putFile($token, $key, $file);

        if($err != null) {
            return null;
        } else {
            return $key;
        }
    }
}