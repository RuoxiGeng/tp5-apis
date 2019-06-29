<?php
/**
 * Created by PhpStorm.
 * User: ruoxigeng
 * Date: 2019-06-12
 * Time: 23:10
 */
namespace app\api\controller\v1;

use app\api\controller\Common;
use think\Controller;
use app\common\lib\exception\ApiException;
use app\common\lib\Alidayu;

class Identify extends Common {
   public function save() {
       if (!request()->isPost()) {
           return show(config('code.error'), '您提交的数据不合法', [], 403);
       }

       //校验数据
       $validate = validate('Identify');
       if(!$validate->check(input('post.'))) {
           return show(config('code.error'), $validate->getError(), [], 403);
       }

       $id = input('post.id');
       if(Alidayu::getInstance()->sendSmsIdentify($id)) {
           return show(config('code.success'), 'OK', [], 201);
       } else {
           return show(config('code.error'), 'Error', [], 403);
       }
   }


}