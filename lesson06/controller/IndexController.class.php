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

    function goods(){

        $categoryId = 'ef720659-d7c1-4405-9fb1-ac1b36c00444';

        $goods = Good::getGoods($categoryId);

        return $goods;
    }


}

//site/index.php?path=index/test/5