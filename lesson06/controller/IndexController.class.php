<?php

class IndexController extends Controller
{
    public $view = 'index';
    public $title;

    function __construct()
    {
        parent::__construct();
        $this->title .= ' | Главная';
    }
	
	//метод, который отправляет в представление информацию в виде переменной content_data
	function index($data){
		 return 111 . 'ZHOPA';
	}

	function test($id){

        return 'indexClessTest';
    }


}

//site/index.php?path=index/test/5