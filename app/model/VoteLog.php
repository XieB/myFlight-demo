<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/4/15
 * Time: 21:54
 */

namespace model;

use Flight;
class VoteLog
{
    private $table = 'vote_log';
    public function getList($data) {
        $page = $data['page'] ?? 1;
        $listRows = $data['list_rows'] ?? 15;
        $rows = $listRows;
        $start = ($page - 1) * $rows;
        $count = Flight::db()->count($this->table);
        $res = Flight::db()->select($this->table, [
            "[>]vote_images" => ["vote_id" => "id"],
        ],[
            'vote_images.desc',
            'vote_images.id',
            'vote_images.img1',
            'vote_images.img2',
            'sum' => \Medoo\Medoo::raw('count(*)'),
        ], [
            'GROUP' => 'vote_id',
            'ORDER' => [
                'sum' => 'DESC'
            ],
            'LIMIT' => [$start, $rows]
        ]);

        $data = \common\Vote::imgDeal($res);
        return [
            'data' => $data,
            'last_page' => ceil($count / $rows)
        ];
    }

    public function add($data) {
        //组装数据
        $insertData = [];
        foreach ($data['list'] as $k => $item) {
            $insertData[$k]['openid'] = $data['userId'];
            $insertData[$k]['vote_id'] = $item;
        }
        return Flight::db()->insert($this->table, $insertData);
    }

    public function check($data) {
        $userId = $data['userId'];
        $num = Flight::db()->count($this->table, [
            'openid' => $userId
        ]);
        return $num;
    }
}