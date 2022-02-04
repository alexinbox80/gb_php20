<?php

class M_User
{
    private object $db;

    function __construct()
    {
        $this->db = M_DB::getObject();
    }
    private function getGUID()
    {
        if (function_exists('com_create_guid')) {
            $guid = com_create_guid();

        } else {

            mt_srand((double)microtime() * 10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid =
                substr($charid, 0, 8) . $hyphen .
                substr($charid, 8, 4) . $hyphen .
                substr($charid, 12, 4) . $hyphen .
                substr($charid, 16, 4) . $hyphen .
                substr($charid, 20, 12);

            $guid = strtolower($uuid);
        }

        return $guid;
    }

    private function setSiteSession(string $name, array $arr): bool
    {
        $_SESSION[$name] = $arr;

        return true;
    }

    public function auth(string $login, string $passwdMd5): bool
    {
        $result = false;

//        $sql = "SELECT id, userId, roleId FROM users WHERE login = '$login' AND passwd = '$passwdMd5'";

        $sql = "SELECT users.userId, users.roleId, roles.role
                FROM user_role
                INNER JOIN users ON user_role.userId = users.userId
                INNER JOIN roles ON user_role.roleId = roles.roleId
                WHERE login = '$login' AND passwd = '$passwdMd5'";

        $data = $this->db->select($sql);

        if (count($data)) {
            $result = true;

            $user['login'] = $login;
            //$user['passwd'] = md5($passwd);
            //$user['passwd'] = $passwdMd5;
            $user['userId'] = $data[0]['userId'];
            $user['roleId'] = $data[0]['roleId'];
            $user['role'] = $data[0]['role'];
            $user['history'] = [];

            $this->setSiteSession('user', $user);
        }

        return $result;
    }

    public function reg(array $user): bool
    {
        $result = false;

        $sql = "SELECT id FROM users WHERE login = '" . $user['login'] . "' OR email = '" . $user['email'] . "'";

        $roleId = '7d303e73-f1e2-4b02-a0c5-813f3892e172';
        $userId = $this->getGUID();

        $data = $this->db->select($sql);

        if (count($data)) {
            //echo "exists<br>\n";

        } else {
            $sql1 = "INSERT INTO users (userId, roleId, lastName, login, passwd, email, status, dateCreate) 
                    VALUES ( '" . $userId . "', '$roleId' ,'" . $user['name'] ."', '" . $user['login'] . "',
                     '" . $user['passwdMd5'] . "', '" . $user['email'] . "', '1'," . time() . " )";

            echo $sql1 . "<br\n>";

            $sql2 = "INSERT INTO user_role(userId, roleId)
                     VALUES ('$userId', '$roleId')";

            echo $sql2 . "<br\n>";

            $this->db->insert($sql1);
            $this->db->insert($sql2);

            echo "NO exist<br>\n";

            $result = true;
        }

        return $result;
    }
}
