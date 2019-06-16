<?php
namespace app\common\lib;

use think\Hook;

/**
 * aes 加密 解密类库
 * @by singwa
 * Class Aes
 * @package app\common\lib
 */
class Aes {

    private $key = null;

    /**
     *
     * @param $key 		密钥
     * @return String
     */
    public function __construct() {
        // 需要小伙伴在配置文件app.php中定义aeskey
        $this->key = config('app.aeskey');
    }

    /**
     * 加密
     * @param String input 加密的字符串
     * @param String key   解密的key
     * @return HexString
     */
    public function encrypt($input = '') {
        $iv = $this->getIv();
        $data= base64_encode(openssl_encrypt($input, 'AES-128-CBC',$this->key, OPENSSL_RAW_DATA , $iv));
        return $data;
    }

    public function getIv() {
        return $iv = substr($this->key, 0, 16);
    }

    /**
     * 解密
     * @param String input 解密的字符串
     * @param String key   解密的key
     * @return String
     */
    public function decrypt($sStr) {
        $iv = $this->getIv();
        $decrypted = openssl_decrypt(base64_decode($sStr), 'AES-128-CBC', $this->key, OPENSSL_RAW_DATA, $iv);
        return $decrypted;
    }

}