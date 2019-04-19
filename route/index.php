<?php

Flight::route('GET|POST /', array('controller\Home','index'));
Flight::route('GET|POST /template', array('controller\Home','template'));
Flight::route('GET|POST /database', array('controller\Home','dataBase'));
Flight::route('GET|POST /reg', array('controller\Home','myRegister'));
Flight::route('GET|POST /req', array('controller\Home','getReqParams'));
Flight::route('GET|POST /vali', array('controller\Home','validator'));
Flight::route('GET|POST /load', array('controller\Home','load'));

//意见征集
Flight::route('GET|POST /collection', array('controller\Home','collection'));
Flight::route('GET /log', array('controller\Home','log'));

//投票
Flight::route('GET /vote/list', array('controller\Vote','getList'));
Flight::route('GET /vote/log', array('controller\Vote','logList'));
Flight::route('POST /vote/add', array('controller\Vote','add'));
Flight::route('POST /vote/check', array('controller\Vote','check'));

//创新打分
Flight::route('GET /new/list', array('controller\Innovation','getList'));
Flight::route('GET /new/log', array('controller\Innovation','logList'));
Flight::route('POST /new/add', array('controller\Innovation','add'));
Flight::route('POST /new/check', array('controller\Innovation','check'));
Flight::route('GET /new/info', array('controller\Innovation','info'));

//微信登录
Flight::route('GET /wechat/code', array('controller\Wechat','code'));

