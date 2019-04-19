<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/19
 * Time: 9:19
 */

namespace validator;


class Innovation extends Base
{
    public function add() {
        $this->v->rule('required', ['s_new', 's_app', 's_pro', 's_all', 's_lin', 'new_id', 'openid', 'total']);
        $this->check();
    }

    public function checkUser() {
        $this->v->rule('required', ['userId', 'new_id']);
        $this->check();
    }

    public function info() {
        $this->v->rule('required', 'id');
        $this->check();
    }
}