<?php
namespace model;
use Flight;
class Home {
    private $table = 'collection';
    public function getStone() {
        return Flight::db()->select("stone", '*', [
            'id[>]' => 1
        ]);
    }

    public function collection($data) {
        return Flight::db()->insert($this->table, $data);
    }

    public function getLogList($data) {
        $rows = $data['list_rows'];
        $start = ($data['page'] - 1) * $rows;
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