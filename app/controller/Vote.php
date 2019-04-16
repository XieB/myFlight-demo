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

    public static function logList() {
        $request = Flight::request()->query->getData();
        $res = (new \model\VoteLog())->getList($request);
        Send::success($res);
    }

    public static function add() {
        $request = Flight::request()->data->getData();

        (new \validator\Vote())->setData($request)->add();

        $voteModel = new \model\VoteLog();
        $num = $voteModel->check($request);
        if (!$num) {
            Send::error('已提交，无法重复投票');
        }
        $res = $voteModel->add($request);
        if ($res->rowCount()) {
            Send::success();
        } else {
            Send::error('投票失败');
        }
    }

    public static function check() {
        $request = Flight::request()->data->getData();
        (new \validator\Vote())->setData($request)->checkVote();
        $num = (new \model\VoteLog())->check($request);
        Send::success(['num' => $num]);
    }
}