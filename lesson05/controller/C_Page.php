<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//include_once('model/model.php');
//include_once('C_Base.php');

class C_Page extends C_Base
{
//
//    function __construct()
//    {
//        parent::__construct();
//    }

    public function action_index()
    {
        $this->title .= ' Index Title';
        $model = new Model();
        $text = $model->text_get();

        $this->content .= ' ' . $text;
        //$this->content = $this->Template('view/v_index.php', array('text' => $text));
        //$this->content = $this->show(['text' => $text]);
    }

    public function action_catalog()
    {

    }
}
