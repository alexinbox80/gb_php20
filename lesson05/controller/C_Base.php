<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//include_once('C_Controller.php');

class C_Base extends C_Controller {
    protected $title;
    protected $content;
    protected $keywords;

    protected function before()
    {
        $this->title = 'Site Name';
        $this->content = 'OPA OPA v2.5';
        $this->keywords = 'keywords';
    }

    public function render()
    {
        $vars = array(
            'title' => $this->title,
            'content' => $this->content,
            'keywords' => $this->keywords,
            'words' => ['sky', 'mountain', 'falcon', 'forest', 'rock', 'blue']
        );
        //$page = $this->Template('view/v_main.php', $vars);
        $page = $this->Template('twig.tmpl', $vars);
        echo $page;
    }
}
