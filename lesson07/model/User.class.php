<?php

abstract class User
{
    protected static $data;

    function __construct($data)
    {
        $this->data = $data;
        $this->sessionStart();
    }

    public static function getData()
    {
        return self::$data;
    }

    public static function sessionStart()
    {
        if (!empty($_COOKIE['sid'])) {
            // check session id in cookies
            session_id($_COOKIE['sid']);
        }
        session_start();
    }

    public static function getGroupFromUUID($uuid)
    {
        $sql = "SELECT users.user_id, users.role_id, roles.role
                FROM users
                INNER JOIN roles ON users.role_id = roles.role_id
                WHERE users.user_id = :uuid";

        $role = db::getInstance()->Select(
            $sql,
            ['uuid' => $uuid]
        )[0]['role'];

        return $role;
    }

    abstract public function auth();
    abstract public static function regs(array $user);
}
