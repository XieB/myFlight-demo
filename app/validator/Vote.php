<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/16
 * Time: 10:05
 */

namespace validator;


class Vote extends Base
{
    public function add() {
        $this->v->rule('required', 'list');
        $this->v->rule('array', 'list');
        $this->v->rule('required', 'userId');
        $this->check();
    }

    public function checkVote() {
        $this->v->rule('required', 'userId');
        $this->check();
    }
}