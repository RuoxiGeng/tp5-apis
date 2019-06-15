<?php
/**
 * Created by PhpStorm.
 * User: ruoxigeng
 * Date: 2019-06-15
 * Time: 23:44
 */
namespace app\common\lib\exception;

use think\Exception;

class ApiException extends Exception {
    public $message = '';
    public $httpCode = 500;
    public $code = 0;

    public function __construct($message = '', $httpCode = 0, $code = 0) {
        $this->httpCode = $httpCode;
        $this->message = $message;
        $this->code = $code;
    }
}