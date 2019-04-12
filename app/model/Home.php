<?php
namespace model;
use Flight;
class Home {

    public function getStone() {
        return Flight::db()->select("stone", '*', [
            'id[>]' => 1
        ]);
    }

    public function collection($data) {
        return Flight::db()->insert('collection', $data);
    }
}