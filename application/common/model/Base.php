<?php
/**
 * Created by PhpStorm.
 * User: ruoxigeng
 * Date: 2019-05-21
 * Time: 22:41
 */
namespace app\common\model;

use think\Model;

class Base extends Model {
   //protected $table = "table_real_name";
    protected $autoWriteTimestamp = true;
    /**
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    public function add($data) {
        if(!is_array($data)) {
            exception('传递数据不合法');
        }
        $this->allowField(true)->save($data);
        return $this->id;
    }
}