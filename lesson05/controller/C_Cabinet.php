<?php
class C_Cabinet extends C_Controller
{
    protected function before()
    {
        $this->vars = [
            'cabinet' => [
                'title' => 'Cabinet page',
                'cabinetPage' => 'cabinet.tmpl'
            ]
        ];
    }

    public function getSiteSession(string $name):array
    {

        return $_SESSION[$name];
    }

    public function render()
    {

        $user = $this->getSiteSession('user');

        var_dump($user);

        //var_dump($this->vars['cabinet']);
        if ($user['role'] == 'User') {
            echo "You are user!<br>";
        } else {
            echo "You are admin!<br>";
        }
        $page = $this->Template('index.tmpl', $this->vars['cabinet']);

        echo $page;
    }

    public function action_show()
    {

    }
}
