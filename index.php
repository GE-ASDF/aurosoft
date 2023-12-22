<?php

ini_set('default_charset', 'utf-8');
session_name(md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']));
session_start();
date_default_timezone_set('America/Fortaleza');
header("Access-Control-Allow-Origin: *");

require "dompdf/autoload.inc.php";
require "vendor/autoload.php";
require  "config/config.php";
require 'app/core/Core.php';


use app\core\Core;
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$core = new Core;

try{
    $core->run();
}catch(Exception $e){
    echo $e;
}


