<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/15
 * Time: 10:48
 */

namespace controller;
use common\Send;
use Flight;

class Vote
{
    public static function getList()
    {
        $request = Flight::request()->query->getData();
        $res = (new \model\Vote())->getList($request);
        Send::success($res);
    }

    public static function setList()
    {
        (new \model\Vote())->setList();
    }
}