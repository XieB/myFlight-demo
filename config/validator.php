<?php
use Valitron\Validator as V;

V::lang('zh-cn');

class Valid {
    public function getInstance($data) {
        return new V($data);
    }
}

Flight::register('validator', 'Valid');