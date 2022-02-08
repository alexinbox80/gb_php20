<?php

class Auth extends User
{
    private $error = "";
    private $is_authorized = false;
    private $user_id = '';

    function __construct($data)
    {
        parent::__construct($data);

//        echo "Ses : <br>";
//        print_r($_SESSION);
//        echo "<br>";
    }

    public function getError()
    {
        return $this->error;
    }

    protected function makePasswdMd5($login, $passwd)
    {
        $salt = "zyjdfhm";
        return strrev(md5($salt) . $passwd . md5($login));
    }

    protected static function isAuthorized(): bool
    {
        if (!empty($_SESSION["user_id"])) {
            return (bool) $_SESSION["user_id"];
        }
        return false;
    }

    protected function saveSession($remember = false, $http_only = true, $days = 7)
    {
        $_SESSION["user_id"] = $this->user_id;

        if ($remember) {
            // Save session id in cookies
            $sid = session_id();

            $expire = time() + $days * 24 * 3600;
            $domain = ""; // default domain
            $secure = false;
            $path = "/";

            $cookie = setcookie("sid", $sid, $expire, $path, $domain, $secure, $http_only);
        }
    }

    public function logout()
    {
        if (!empty($_SESSION["user_id"])) {
            unset($_SESSION["user_id"]);
        }
    }

    public function auth(): bool
    {

        if ($this->IsPost()) {
            $login = $_POST['login'] ? strip_tags($_POST['login']) : "";
            $passwd = $_POST['passwd'] ? strip_tags($_POST['passwd']) : "";
            $rememberme = $_POST['remember-me'] ? strip_tags($_POST['remember-me']) : "";
            $action = $_POST['act'] ? strip_tags($_POST['act']) : "";

            if (isset($rememberme)) {
                $remember = true;
            }

            switch ($action) {
                case 'login':
                    if (($login == "") || ($passwd == "")) {
                        $this->error = "Empty login or password!";
                        $this->is_authorized = false;
                    } else {

                        $passwdMd5 = $this->makePasswdMd5($login, md5($passwd));

                        $sql = "SELECT users.user_id, users.role_id, roles.role
                                FROM user_role
                                INNER JOIN users ON user_role.user_id = users.user_id
                                INNER JOIN roles ON user_role.role_id = roles.role_id
                                WHERE login = '$login' AND passwd = '$passwdMd5' LIMIT 1";

                       // echo $sql . "<br>";

                        $authUser = db::getInstance()->Select(
                            $sql,
                            ['login' => $login, 'passwd' => $passwdMd5]);

//                        print_r($authUser);
//                        echo "<br> id : ";
//                        print_r($authUser[0]['user_id']);
//                        echo "<br>";

                        if (!$authUser[0]['user_id']) {
                            $this->is_authorized = false;
                            $this->error = "Wrong login or password!";
                        } else {
                            $this->is_authorized = true;
                            $this->user_id = $authUser[0]['user_id'];
                            $this->saveSession($remember);
                        }

                    }
                    break;
                case 'logout':
                        $this->error = "Site logout success!";
                        $this->logout();
                    break;
            }
        }

        //echo "login = " . $login . " passwd = " . $passwd . " rememberme = " . $rememberme . " action = " . $action . "<br>\n";

        return $this->is_authorized;
    }

    protected function IsGet()
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    protected function IsPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }
}
