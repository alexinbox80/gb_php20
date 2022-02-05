<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

class C_User extends C_Base
{
    protected function before()
    {
        $this->vars = [
            'login' => [
                'title' => 'Login page',
                'loginPage' => 'login.tmpl'
            ]
        ];
    }

    public function render()
    {
        if ($this->getSiteSession('user')) {
            $user = $this->getSiteSession('user');

            array_push($user['history'], ['page' => 'Login page']);

            $this->setSiteSession('user', $user);

            $this->vars['login'] += ['login' => $user['role']];
            $this->vars['login'] +=['loginWarning' => "You are already logged in!"];

            if ($user['role'] == 'User') {
                $this->vars['login']['loginWarning'] .= " You are user!";

            } else {
                $this->vars['login']['loginWarning'] .= " You are admin!";

            }
            header("Location: index.php");
        } else {
            $this->vars['login'] +=['loginError' => "You are not authorized!"];

        }

        $page = $this->Template('index.tmpl', $this->vars['login']);

        echo $page;
    }

    public function action_login()
    {
    }

    public function action_logout()
    {
        $_SESSION['user'] = array();
        header("Location: index.php");
    }

    private function isValidMd5($md5 = '')
    {
        return preg_match('/^[a-f0-9]{32}$/', $md5);
    }

    public function action_auth(): void
    {
        if ($this->IsPost()) {
            $login = $_POST['login'] ? strip_tags($_POST['login']) : "";
            $passwd = $_POST['passwd'] ? strip_tags($_POST['passwd']) : "";

            if ($this->isValidMd5($passwd)) {
                $passwdMd5 = $this->makePasswdMd5($login, $passwd);
            } else {
                $passwdMd5 = $this->makePasswdMd5($login, md5($passwd));
            }

            if ($this->user->auth($login, $passwdMd5)) {

                $_SESSION['loginSuccess'] = true;
                $_SESSION['errorMessage'] = '';

                //header("Location: index.php");

            } else {
                $this->vars['login'] += ['loginError' => 'Wrong login or password!'];
            }
        } else {
            //$this->content = $this->Template('index.tmpl', []);
        }
    }

    public function action_registration()
    {
    }

    public function action_parea()
    {
    }
}
