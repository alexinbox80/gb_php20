<?php

abstract class User {

    protected static $data;

    function __construct($data)
    {
        $this->data = $data;
    }

    abstract public function auth();
}
