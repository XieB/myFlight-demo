<?php
namespace common;
class MyRegister {
    public $config;
    public function __construct($config) {
        $this->config = $config;
    }

    public function index() {
        print_r($this->config);
    }
}