<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//include_once('controller/C_Page.php');
//include_once('controller/C_User.php');

//site.ru/index.php?c=user$act=reg
// c - controller
// act - action

//spl_autoload_register(function ($name){
//   include_once("controller/$name.php");
//});

spl_autoload_register(function ($name){
    $dirs = ['controller', 'model', 'view'];
    $file = $name . ".php";
    foreach ($dirs as $dir){
        if (is_file($dir .'/'. $file)) {
            include_once($dir .'/'. $file);
        }
    }
    //include_once("controller/$name.php");
});



$action = 'action_';
$action .= (isset($_GET['act'])) ? $_GET['act'] : 'index';

$c = (isset($_GET['c'])) ? $_GET['c'] : '';

switch($c){
    case'user':
            $controller = new C_User();
        break;
    default:
        $controller = new C_Page();
}

//$controller->$action();
//$controller->render();

$controller->Request($action);
