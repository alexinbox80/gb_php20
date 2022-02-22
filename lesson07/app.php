<?php

//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);

require_once 'autoload.php';

try {

    if (!isset($_COOKIE['user_id'])) {

        $user_id = App\Lib\UUID::v4();
        $cookie_name = 'user_id';
        App\Model\Auth::setSiteCookie(1, $user_id, $cookie_name);

    }

    App\Lib\App::init();

} catch (PDOException $e) {
    echo "DB is not available<br>";
    var_dump($e->getTrace());
} catch (Exception $e) {
    echo $e->getMessage();
}
