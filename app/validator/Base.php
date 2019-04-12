<?php
namespace validator;
use Flight;
use common\Send;

class Base {
    protected $v; //保存实例化对象
    
    public function setData($data) {
        $this->v = Flight::validator()->getInstance($data);
        return $this;
    }

    public function check() {
        if ($this->v->validate()) {
            return true;
        } else {
            Send::error($this->v->errors());
        }
    }
}