<?php
require_once __DIR__ . "/../autoload.php";
require_once 'PHPUnit/Autoload.php';

abstract class BaseTest extends PHPUnit_Framework_TestCase{
    protected function setUp()
    {
        App::Init();
    }

}