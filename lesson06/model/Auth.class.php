<?php

class Auth extends User
{
    private $error = "";

    function __construct($data)
    {
        parent::__construct($data);
    }

    public function getError()
    {
        return $this->error;
    }

    public function auth()
    {
        $flag = false;

        if ($this->IsPost()) {
            $login = $_POST['login'] ? strip_tags($_POST['login']) : "";
            $passwd = $_POST['passwd'] ? strip_tags($_POST['passwd']) : "";
            $rememberme = $_POST['remember-me'] ? strip_tags($_POST['remember-me']) : "";
            $action = $_POST['act'] ? strip_tags($_POST['act']) : "";

            $flag = true;

            switch ($action) {
                case 'login':
                    if (($login == "") || ($passwd == "")) {
                        $this->error = "Empty login or password!";
                        $flag = false;
                    }
                    break;
                case 'logout':
                        $this->error = "Site logout success!";
                    break;
            }
        }

        echo "login = " . $login . " passwd = " . $passwd . " rememberme = " . $rememberme . " action = " . $action . "<br>\n";

        return $flag;
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
