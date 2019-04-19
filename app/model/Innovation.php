<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/19
 * Time: 9:18
 */

namespace model;
use Flight;

class Innovation
{
    private $table = 'new_name';
    private $logTable = 'new_log';

    public function getList($data) {
        $page = $data['page'] ?? 1;
        $listRows = $data['list_rows'] ?? 15;
        $rows = $listRows;
        $start = ($page - 1) * $rows;
        $count = Flight::db()->count($this->table);
        $res = Flight::db()->select($this->table, "*", [
            'LIMIT' => [$start, $rows],
            'ORDER' => [
                'id' => 'ASC'
            ],
        ]);

        return [
            'data' => $res,
            'last_page' => ceil($count / $rows)
        ];
    }

    public function logList() {
        $res = Flight::db()->select($this->logTable, [
            "[>]new_name" => ["new_id" => "id"],
        ],[
            'new_name.name',
            'new_log.new_id',
            'new_name.part',
            'new_name.user_name',
            'sum' => \Medoo\Medoo::raw('sum(new_log.total)'),
        ], [
            'GROUP' => 'new_id',
//            'ORDER' => [
//                'sum' => 'DESC'
//            ],
        ]);

        $data = [];
        foreach ($res as $k => $v) {
            $data[$k] = $v;
            $count = Flight::db()->count($this->logTable, [
                'new_id' => $v['new_id']
            ]);
            if ($count <= 2) {
                $data[$k]['score'] = 0;
            } else {

                $maxScore = Flight::db()->get($this->logTable, 'total', [
                    'new_id' => $v['new_id'],
                    'ORDER' => [
                        'total' => 'DESC'
                    ],
                ]);

                $minScore = Flight::db()->get($this->logTable, 'total', [
                    'new_id' => $v['new_id'],
                    'ORDER' => [
                        'total' => 'ASC'
                    ],
                ]);

                $data[$k]['score'] = round(($v['sum'] - $maxScore - $minScore) / ($count - 2), 2);
            }
        }

        return self::arraySequence($data, 'score');
    }

    public function add($data) {
        return Flight::db()->insert($this->logTable, $data);
    }

    public function check($data) {
        $num = Flight::db()->count($this->logTable, [
            'openid' => $data['userId'],
            'new_id' => $data['new_id']
        ]);
        return $num;
    }

    public function info($id) {
        $res = Flight::db()->get($this->table, '*', [
            'id' => $id
        ]);
        return $res;
    }

    private static function arraySequence($array, $field, $sort = 'SORT_DESC'){
        $arrSort = array();
        foreach ($array as $uniqid => $row) {
            foreach ($row as $key => $value) {
                $arrSort[$key][$uniqid] = $value;
            }
        }
        array_multisort($arrSort[$field], constant($sort), $array);
        return $array;
    }
}