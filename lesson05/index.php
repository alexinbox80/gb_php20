<?php
session_start();

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//site.ru/index.php?c=user$act=reg
// c - controller
// act - action

spl_autoload_register(function ($name) {
    $dirs = ['controller', 'model', 'view'];
    $file = $name . ".php";
    foreach ($dirs as $dir) {
        if (is_file($dir . '/' . $file)) {
            include_once($dir . '/' . $file);
        }
    }
});


$action = 'action_';
$action .= (isset($_GET['act'])) ? $_GET['act'] : 'index';

$c = (isset($_GET['c'])) ? $_GET['c'] : '';

if (isset($_POST['enter'])) {
    $c = 'user';
    $action = 'action_auth';
}

echo $action . ' - ' . $c . "<br>\n";

switch ($c) {
    case 'user':
        $controller = new C_User();
        break;
    case 'reg':
        $controller = new C_Reg();
        break;
    case 'cabinet':
        $controller = new C_Cabinet();
        break;
    default:
        $controller = new C_Page();
}

$controller->Request($action);
