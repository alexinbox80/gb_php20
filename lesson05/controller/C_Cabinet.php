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

    public function render()
    {

        if ($this->getSiteSession('user')) {
            $user = $this->getSiteSession('user');

            array_push($user['history'], ['page' => 'Cabinet page']);

            $this->setSiteSession('user', $user);

            $this->vars['cabinet'] += ['history' => $user['history']];

            $this->vars['cabinet'] += ['login' => $user['role']];
            if ($user['role'] == 'User') {
                $this->vars['cabinet'] += ['cWarning' => "You are user!"];
                $this->vars['cabinet']['cWarning'] .= ' Hello, ' . $user['login'] . '!';
                //echo "You are user!<br>";
            } else {
                $this->vars['cabinet'] += ['cWarning' => "You are admin!"];
                $this->vars['cabinet']['cWarning'] .= ' Hello, ' . $user['login'] . '!';
                //echo "You are admin!<br>";
            }

        } else {
            $this->vars['cabinet'] += ['cError' => "You are not authorized!"];
            //echo "You are not authorized<br>\n";
        }

        $page = $this->Template('index.tmpl', $this->vars['cabinet']);

        echo $page;
    }

    public function action_show()
    {

    }
}
