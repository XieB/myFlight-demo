<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/16
 * Time: 10:53
 */

namespace common;


class Vote
{
    public static function imgDeal($res) {
        $data = [];
        $dir = '/static/images/logo/';
        $domain = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];
        foreach ($res as $k => $item) {
            $data[$k] = $item;
            $data[$k]['img1'] = $domain . $dir . $item['img1'];
            if (!empty($item['img2'])) {
                $data[$k]['img2'] = $domain . $dir . $item['img2'];
            }
        }
        return $data;
    }
}