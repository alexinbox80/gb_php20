<?php
require_once 'autoload.php';

try{
    if (!isset($_COOKIE['user_id'])) {

        $user_id = UUID::v4();
        $expire = time() + 1 * 24 * 3600;
        $domain = ""; // default domain
        $secure = false;
        $path = "/";
        $http_only = false;

        setcookie('user_id', $user_id, $expire, $path, $domain, $secure, $http_only);
    }

    App::init();
}
catch (PDOException $e){
    echo "DB is not available";
    var_dump($e->getTrace());
}
catch (Exception $e){
    echo $e->getMessage();
}
