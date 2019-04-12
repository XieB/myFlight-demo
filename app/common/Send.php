<?php
namespace common;

use Flight;
class Send {
    public static function success($data = []) {
        Flight::json([
            'data' => $data,
            'message' => 'ok',
            'status' => 1
        ]);
        exit;
    }

    public static function error($info = '出错了') {
        $infoData = '';
        if (is_array($info)) {
            foreach($info as $v) {
                $infoData = $v[0];
                break;
            }
        } else {
            $infoData = $info;
        }

        Flight::json([
            'data' => [],
            'info' => $infoData,
            'status' => 0
        ]);
        exit;
    }
}