<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/15
 * Time: 10:51
 */

namespace model;

use Flight;

class Vote
{
    private $table = 'vote_images';

    public function setList()
    {
        $len = 34;
        $data = [];
        for ($a = 1; $a <= $len; $a++) {
            $data[] = [
                img1 => $a . '-1.png',
                img2 => $a . '-2.png',
            ];
        }
        Flight::db()->insert($this->table, $data);

    }

    public function getList($data)
    {
        $page = $data['page'] ?? 1;
        $listRows = $data['list_rows'] ?? 150;
        $rows = $listRows;
        $start = ($page - 1) * $rows;
        $count = Flight::db()->count($this->table);
        $res = Flight::db()->select($this->table, "*", [
            'LIMIT' => [$start, $rows]
        ]);
        $data = \common\Vote::imgDeal($res);

        return [
            'data' => $data,
            'last_page' => ceil($count / $rows)
        ];
    }
}