<?php
/**
 * Created by PhpStorm.
 * User: ruoxigeng
 * Date: 2019-06-15
 * Time: 23:08
 */
namespace app\common\lib\exception;

use think\exception\Handle;

class ApiHandleException extends Handle {

    /**
     * @var int http code
     */
    public $httpCode = 500;

    public function render(\Exception $e) {
        if (config('app_debug') == true) {
            return parent::render($e);
        }

        if ($e instanceof ApiException) {
            $this->httpCode = $e->httpCode;
        }
        return show(0, $e->getMessage(), [], $this->httpCode);
    }
}