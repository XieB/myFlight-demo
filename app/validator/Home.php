<?php
namespace validator;
class Home extends Base {

    public function validator() {
        $this->v->rule('required', 'id');
        $this->check();
    }

    public function collection() {
        $this->v->rule('required', 'goods');
        $this->v->rule('required', 'price');
        $this->check();
    }
}