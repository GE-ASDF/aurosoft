<?php

define('DB_DRIVER', 'mysql');
define("SERVIDOR", "teste");
define("BANCO", "teste");
define("PORTA", "3306");
define("USUARIO", "");
define("SENHA", "");

define("DS", DIRECTORY_SEPARATOR);
define("COUNTRY_CODE",'55');
define('CONTROLLER_PADRAO', 'home');
define('METODO_PADRAO', 'index');
define('NAMESPACE_CONTROLLER', 'app\\controllers\\');
define("PASTA_PADRAO", "app/controllers/");
define('URL_BASE', 'http://pc-1/mvc/');
define("PATH_COMPONENTS", $_SERVER['DOCUMENT_ROOT']."/mvc/app/views/components/");
define("PATH_LAYOUTS", $_SERVER['DOCUMENT_ROOT']."/mvc/app/views/layouts/");
define("SESSION_LOGIN", "logado");
define("SESSION_LOGIN_ALUNO", "aluno_logado");
define("NOT_FOUND_MESSAGE", "404 - PÁGINA NÃO ENCONTRADA");
define("UPLOAD_DIR", $_SERVER["DOCUMENT_ROOT"]."/mvc/assets/uploads/");
define('ROOT', dirname(__FILE__, 2));
define("SECRET_KEY", "4Gh#9qP2z$6vJ@5x");

define('DAYS',[
    'Sun' => 0,
    'Mon' => 1,
    'Tue' => 2,
    'Wed' => 3,
    'Thu' => 4,
    'Fri' => 5,
    'Sat' => 6,
]);
define('DAYS_NAME',[
    '1' => 'Segunda-feira',
    '2' => 'Terça-feira',
    '3' => 'Quarta-feira',
    '4' => 'Quinta-feira',
    '5' => 'Sexta-feira',
    '6' => 'Sábado',
    '0' => 'Domingo',
    '7' => 'Domingo',
]);



