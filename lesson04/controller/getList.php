<?php
require_once "BD.php";

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

if (isset($_POST)) {
    $postQuery = [
        'todo' => $_POST['todo'] ? strip_tags($_POST['todo']) : "",
        'listBegin' => $_POST['listBegin'] ? strip_tags($_POST['listBegin']) : "",
        'listCount' => $_POST['listCount'] ? strip_tags($_POST['listCount']) : ""
    ];

    switch ($postQuery['todo']) {
        case 'getList':
            $data = new \twig\phpv20\BD();
            $result = $data->getData($postQuery['listBegin'], $postQuery['listCount']);
            break;
        default:
            $result = [
                'err' => 'Wrong Operations!'
            ];

    }
}

echo json_encode($result);
