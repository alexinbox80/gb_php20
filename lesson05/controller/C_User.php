<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//include_once('C_Controller.php');
//include_once('model/M_User.php');

class C_User extends C_Controller {

    protected function before()
    {
        $this->title = 'Auth user';
        $this->content = '';
        $this->keywords = 'keywords';
    }

    public function render()
    {

    }

    public function action_login() {}

    public function action_logout() {}

    public function action_auth() {
        //USE SESSION
        //PDO:: use prepare method!!!
        $user = new M_User();
        if ($this->IsPost()) {
            $login = $_POST['login'];
            $user->auth('log', 'pass');
            // header('Location');
        } else {
            $this->content = $this->Template('view/v_auth.ph');
        }
    }

    public function action_regisration() {}

    public function action_parea() {}
}
