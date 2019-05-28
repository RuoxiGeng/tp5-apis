<?php
namespace app\admin\controller;

use think\Controller;

class News extends Base
{
    public function add() {
        return $this->fetch();
    }
}
