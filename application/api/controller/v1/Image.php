<?php
/**
 * Created by PhpStorm.
 * User: ruoxigeng
 * Date: 2019-06-12
 * Time: 23:10
 */
namespace app\api\controller\v1;

use app\api\controller\Common;
use app\common\lib\Aes;
use app\common\lib\exception\ApiException;
use app\common\lib\Upload;

class Image extends AuthBase {

   public function save() {
       $image = Upload::image();
       if($image) {
           return show(config('code.success'), 'OK', config('qiniu.image_url').'/'.$image);
       }
   }
}