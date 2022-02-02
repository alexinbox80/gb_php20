<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//include_once('C_Controller.php');
//include_once('model/M_User.php');

class C_User extends C_Controller
{

    protected function before()
    {
        $this->title = 'Auth user';
        $this->content = '';
        $this->keywords = 'keywords';
    }

    public function render()
    {
    }

    public function action_login()
    {
    }

    public function action_logout()
    {
    }

    private function isValidMd5($md5 = '')
    {
        return preg_match('/^[a-f0-9]{32}$/', $md5);
    }

    private function makePasswdMd5($login, $passwd) {
        $salt = "zyjdfhm";
        return strrev(md5($salt) . $passwd . md5($login));
    }

    public function action_auth()
    {
        //USE SESSION
        //PDO:: use prepare method!!!
        $user = new M_User();
        if ($this->IsPost()) {
            $login = $_POST['login'] ? strip_tags($_POST['login']) : "";
            $passwd = $_POST['passwd'] ? strip_tags($_POST['passwd']) : "";

            if ($this->isValidMd5($passwd)) {

                $passwdMd5 = $this->makePasswdMd5($login, $passwd);

            } else {

                $passwdMd5 = $this->makePasswdMd5($login, md5($passwd));

            }

            if ($user->auth($login, $passwdMd5)) {
                //header("Location: index.php");
            } else {
                echo "Wrong login or password!";
            }
        } else {
            //$this->content = $this->Template('view/v_auth.ph');
        }
    }

    public function action_regisration()
    {
    }

    public function action_parea()
    {
    }
}
