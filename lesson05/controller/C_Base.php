<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

class C_Base extends C_Controller {
    protected $title;
    protected $content;
    protected $keywords;

    protected function before()
    {
        $this->vars = [
            'index' => [
                'title' => 'Site Name'
            ]
        ];

    }

    public function render()
    {
        if ($this->getSiteSession('user')) {
            $user = $this->getSiteSession('user');

            $this->vars['index'] += ['login' => $user['role']];

        } else {
            //$this->vars['index'] +=['loginError' => "You are not authorized!"];
        }

        $page = $this->Template('index.tmpl', $this->vars['index']);
        echo $page;
    }
}
