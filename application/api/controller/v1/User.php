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
use app\common\lib\IAuth;

class User extends AuthBase {

    /**
     * 获取用户信息
     * 用户基本信息为敏感数据 加密处理
     */
   public function read() {
       $obj = new Aes();
       return show(config('code.success'), 'OK', $obj->encrypt($this->user));
   }

   /**
    * 修改数据
    */
   public function update() {
       $postData = input('param.');
       //validate
       $data = [];
       if(!empty($postData['image'])) {
           $data['image'] = $postData['image'];
       }
       if(!empty($postData['username'])) {
           $data['username'] = $postData['username'];
       }
       if(!empty($postData['sex'])) {
           $data['sex'] = $postData['sex'];
       }
       if(!empty($postData['signature'])) {
           $data['signature'] = $postData['signature'];
       }
       if(!empty($postData['password'])) {
           $data['password'] = IAuth::setPassword($postData['password']);
       }

       if(empty($data)) {
           return show(config('code.error'), '数据不合法', [], 404);
       }

       try {
           $id = model('user')->save($data, ['id' => $this->user->id]);
           if($id) {
               return show(config('code.success'), 'OK', [], 202);
           } else {
               return show(config('code.error'), '更新失败', [], 401);
           }
       }catch (\Exception $e) {
           return show(config('code.error'), $e->getMessage(), [], 500);
       }
   }
}