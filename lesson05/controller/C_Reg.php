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

        var_dump($this->vars['reg']);

        $page = $this->Template('index.tmpl', $this->vars['reg']);

        echo $page;
    }

    public function action_reg()
    {

    }
}
