<?php

abstract class User
{

    protected static $data;

    function __construct($data)
    {
        $this->data = $data;
        $this->sessionStart();
    }

    private function sessionStart()
    {
        if (!empty($_COOKIE['sid'])) {
            // check session id in cookies
            session_id($_COOKIE['sid']);
        }
        session_start();
    }

    abstract public function auth();
}
