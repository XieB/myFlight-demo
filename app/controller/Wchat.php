<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/4/15
 * Time: 21:49
 */

namespace controller;
use Flight;

class Wchat
{
    public static function code() {
        $request = Flight::request()->query->getData();
        $res = (new \common\Wechat())->code($request['code']);
        $error = empty($res['errcode']);
        if (empty($error)) {
            Send::success([
                'token' => $res['access_token']
            ]);
        } else {
            Send::error('微信返回错误，错误码' . $error);
        }
    }
}