<?php

//include_once('M_DB.php');
class M_User
{

    private $db;

    function __construct()
    {
        $this->db = M_DB::getObject();
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


        echo "auth1 <br>\n";
        if (isset($data[0]))
            var_dump($data[0]);


        if (count($data)) {

            echo "auth2 <br>\n";
            var_dump($data);

            $result = true;

            $user['login'] = $login;
            //$user['passwd'] = md5($passwd);
            //$user['passwd'] = $passwdMd5;
            $user['userId'] = $data[0]['userId'];
            $user['roleId'] = $data[0]['roleId'];
            $user['role'] = $data[0]['role'];

            $this->setSiteSession('user', $user);
        }

        return $result;
    }
}