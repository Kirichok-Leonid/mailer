<?php

// показ помилок
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// підключення файлів системи
define('ROOT', dirname(__FILE__));

//require_once(ROOT.'/components/Router.php');        // підключення роутера
//require_once(ROOT.'/components/Db.php');            // підключення до БД
//require_once (ROOT.'/components/Request.php');

require_once (ROOT.'/components/Autoload.php');     // автолоадер


// виклик роутера
$router = new Router();
$router->run();
