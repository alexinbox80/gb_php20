<?php

namespace alexinbox\phpv20;
require_once "getObject.php";

class DB
{
    use getObject;
    static $obj;
    static $connect;

    private function __construct()
    {
        self::$connect = "...";
    }

    private function __clone()
    {
    }

    public function select(): array
    {
        $a = [];
        return $a;
    }

    public function insert(): array
    {
        $a = [];
        return $a;
    }

    public function update(): array
    {
        $a = [];
        return $a;
    }

    public function delete(): array
    {
        $a = [];
        return $a;
    }
}

class request
{
    private $db;

    function __construct()
    {
        $this->db = DB::getObject();
    }

    public function showGoods(): void
    {
        $this->db->select();
        $this->db->update();
    }
}

$req = new request();
$req->showGoods();
