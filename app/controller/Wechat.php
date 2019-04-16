<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/4/15
 * Time: 21:49
 */

namespace controller;
use common\Send;
use Flight;

class Wechat
{
    public static function code() {
        $request = Flight::request()->query->getData();
        $res = (new \common\Wechat())->code($request['code']);
        $res = json_decode($res);
        $errorCode = isset($res->errcode) ? $res->errcode : false;
        if (!$errorCode) {
            Send::success([
                'token' => $res->openid
            ]);
        } else {
            Send::error('微信返回错误，错误码' . $res->errcode);
        }
    }
}