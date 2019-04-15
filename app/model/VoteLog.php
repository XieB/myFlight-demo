<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/4/15
 * Time: 21:54
 */

namespace model;


class VoteLog
{
    private $table = 'vote_log';
    public function getList($data) {
        $page = $data['page'] ?? 1;
        $listRows = $data['list_rows'] ?? 15;
        $rows = $listRows;
        $start = ($page - 1) * $rows;
        $count = Flight::db()->count($this->table);
        $data = Flight::db()->select($this->table, "*", [
            'ORDER' => [
                'id' => 'DESC'
            ],
            'LIMIT' => [$start, $rows]
        ]);

        return [
            'data' => $data,
            'last_page' => ceil($count / $rows)
        ];
    }
}