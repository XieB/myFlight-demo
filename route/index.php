<?php

Flight::route('GET|POST /', array('controller\Home','index'));
Flight::route('GET|POST /template', array('controller\Home','template'));
Flight::route('GET|POST /database', array('controller\Home','dataBase'));
Flight::route('GET|POST /reg', array('controller\Home','myRegister'));
Flight::route('GET|POST /req', array('controller\Home','getReqParams'));
Flight::route('GET|POST /vali', array('controller\Home','validator'));
Flight::route('GET|POST /load', array('controller\Home','load'));

Flight::route('GET|POST /collection', array('controller\Home','collection'));
Flight::route('GET /log', array('controller\Home','log'));