<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/19
 * Time: 9:18
 */

namespace controller;
use common\Send;
use Flight;

class Innovation
{
    public static function getList() { //提案列表
        $request = Flight::request()->query->getData();
        $res = (new \model\Innovation())->getList($request);
        Send::success($res);
    }

    public static function add() { //打分
        $request = Flight::request()->data->getData();
        $newId = $request['new_id'];
        $info = (new \model\Innovation())->info($newId);
        if (!$info['state']) {
            Send::error('该提案已结束打分');
        }
        (new \validator\Innovation())->setData($request)->add();

        $inModel = new \model\Innovation();
        $num = $inModel->check($request);

        if ($num) {
            Send::error('已提交，无法重复打分');
        }

        $res = $inModel->add($request);
        if ($res->rowCount()) {
            Send::success();
        } else {
            Send::error('打分失败');
        }
    }

    public static function logList() { //结果列表
        $res = (new \model\Innovation())->logList();
        Send::success($res);
    }

    public static function info() {
        $request = Flight::request()->query->getData();
        (new \validator\Innovation())->setData($request)->info();
        $res = (new \model\Innovation())->info($request['id']);
        Send::success($res);
    }

    public static function check() { //是否已打分
        $request = Flight::request()->data->getData();
        (new \validator\Innovation())->setData($request)->checkUser();
        $num = (new \model\Innovation())->check($request);
        Send::success(['num' => $num]);
    }
}