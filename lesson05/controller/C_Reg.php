<?php
class C_Reg extends C_Controller
{
    protected function before()
    {
        $this->vars = [
            'reg' => [
                'title' => 'Registration page',
                'loginPage' => 'reg.tmpl'
            ]
        ];
    }

    public function render()
    {

        $page = $this->Template('index.tmpl', $this->vars['reg']);

        echo $page;
    }

    public function action_reg()
    {

        $flag = true;
        $user = new M_User();

        if ($this->IsPost()) {
            $name = $_POST['name'] ? strip_tags($_POST['name']) : "";
            $email = $_POST['email'] ? strip_tags($_POST['email']) : "";
            $login = $_POST['login'] ? strip_tags($_POST['login']) : "";
            $passwd = $_POST['passwd'] ? strip_tags($_POST['passwd']) : "";

            $passwdMd5 = $this->makePasswdMd5($login, md5($passwd));

            $userReg = [
                'name' => $name,
                'email' => $email,
                'login' => $login,
                'passwd' => $passwd,
                'passwdMd5' => $passwdMd5
            ];

            $this->vars['reg'] += ['regError' => ''];

            if (($userReg['name'] == '') || ($userReg['email'] == '') ||
                ($userReg['login'] == '') || ($userReg['passwd'] == '')) {
                $this->vars['reg']['regError'] .= 'These fields are empty! : ';
                $flag = false;
            }

            if($userReg['name'] == '') {
                $this->vars['reg']['regError'] .= ' User name ';
                $flag = false;
            }

            if($userReg['email'] == '') {
                $this->vars['reg']['regError'] .= ' User email ';
                $flag = false;
            }

            if($userReg['login']  == '') {
                $this->vars['reg']['regError'] .= ' User login ';
                $flag = false;
            }

            if($userReg['passwd'] == '') {
                $this->vars['reg']['regError'] .= ' User password';
                $flag = false;
            }

            if ($flag) {
                if ($user->reg($userReg)) {
                    $this->vars['reg']['regError'] = 'User has been successfully registered!';
                } else {
                    $this->vars['reg']['regError'] = 'User already exist!';
                }
            }
        }
    }
}
