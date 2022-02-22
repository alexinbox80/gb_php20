<?php

/**
 * Class User
 *
 * @author My Name <my.name@example.com>
 * @internal
 *
 */

namespace App\Model;

abstract class User
{
    protected static $data;

    function __construct($data)
    {
        self::$data = $data;
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
            @session_id($_COOKIE['sid']);
        }

        if(!isset($_SESSION))
        {
            session_start();
        }
    }

    public static function getGroupFromUUID($uuid)
    {
        $sql = "SELECT users.user_id, user_role.role_id, roles.role
                FROM user_role
                INNER JOIN users ON user_role.user_id = users.user_id
                INNER JOIN roles ON user_role.role_id = roles.role_id
                WHERE users.user_id = :uuid LIMIT 1";

        $role = \App\Lib\db::getInstance()->Select(
            $sql,
            ['uuid' => $uuid]
        );

        if ($role) {
            $role = $role[0]['role'];
        }

        return $role;
    }

    public static function changeUserUUID(string $uuid_old, string $uuid):bool
    {
       $result = false;

        $sql = "UPDATE carts 
                SET user_id = :user_id
                WHERE user_id = :user_id_old";

        $update = \App\Lib\db::getInstance()->Query(
            $sql,
            [
                'user_id' => $uuid,
                'user_id_old' => $uuid_old
            ]);

        if($update) {
           $result = true;
        }

        return $result;
    }

    abstract public function auth();
    abstract public static function regs(array $user);
}
