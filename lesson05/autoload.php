<?php

require 'vendor/autoload.php';

spl_autoload_register(function ($name) {
    $dirs = ['config', 'controller', 'model', 'view'];
    $file = $name . ".php";
    foreach ($dirs as $dir) {
        if (is_file($dir . '/' . $file)) {
            include_once($dir . '/' . $file);
        }
    }
});