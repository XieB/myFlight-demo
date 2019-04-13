<?php
namespace controller;
use common\Send;
use Flight;
class Home
{
    public static function index()
    {  //发送json
        Send::success();
    }

    public static function template()
    {  //模板
        Flight::render('index.php', array('name' => 'Bob'));
    }

    public static function dataBase()
    { //数据库
        $data = (new \model\Home())->getStone();
        Send::success($data);
    }

    public static function myRegister()
    { //注册自定义类
        Flight::xx()->index();
    }

    public static function getReqParams()
    { //获取参数
        $request = Flight::request();
        // Send::success($request->data->a);
        // Send::success($request->getBody());
        Send::success($request->query['a']);
    }

    public static function validator()
    { //验证器
        $v = (new \validator\Home())->setData(['id' => '111'])->validator();
        
        Send::success(['a' => 111]);
    }

    public static function collection() {
        $request = Flight::request()->data->getData();
//        (new \validator\Home())->setData($request)->collection();

        $res = (new \model\Home())->collection($request);
        if ($res) {
            Send::success();
        } else {
            Send::error('提交失败');
        }
    }

    public static function log() {
        $request = Flight::request()->query->getData();

        $res = (new \model\Home())->getLogList($request);
        Send::success($res);
    }
}

