<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once "../controller/controller.php";

$controller = new \controller\phpv20\Controller();

if (isset($_GET['photo_id'])) {
    $photo_id = $_GET['photo_id'] ? strip_tags($_GET['photo_id']) : "";
} else {
    $photo_id = '';
}

$controller->init($photo_id);
