<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/15
 * Time: 15:50
 */

namespace common;
use \Curl\Curl;
class Wechat
{
    private $config = [
        'appId' => 'wx99a94f53927dc5fe',
        'secret' => '9f1476d327c37c689c4057e6f628758c',
    ];
    public function code($code) {
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $this->config['appId'] . '&secret=' . $this->config['secret'] . '&code=' . $code . '&grant_type=authorization_code';
        $curl = new Curl();
        $curl->get($url);
        return $curl->response;
    }
}