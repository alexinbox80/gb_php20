<?php

class IndexController extends Controller
{
    public $view = 'index';
    public $title;

    function __construct()
    {
        parent::__construct();
        $this->title .= ' | Main';
    }
	
	//метод, который отправляет в представление информацию в виде переменной content_data
	function index($data){
        $content = '';

        $auth = self::login($data);

        $answer = [
            'content' => $content,
            'status' => $auth['status'],
            'info' => $auth['info']
        ];

        return $answer;
		 //return 111 . 'ZHOPA';
	}

    private function login($data)
    {
        $user = new Auth($data);
        $flag = $user->auth();

        if ($flag) {
            $result = ['info' => 'User is registered in the system!',
                       'status' => 'ok'];
        }

        if (($user->getError() != "") && ($_POST['act'] == 'login')) {
            $result = ['info' => $user->getError(),
                       'status' => 'error'];
        } else if ($_POST['act'] == 'logout') {
            $result = ['info' => $user->getError(),
                'status' => 'ok'];
        }

        return $result;
    }

    function goods(){

        $categoryId = 'ef720659-d7c1-4405-9fb1-ac1b36c00444';

        $goods = Good::getGoods($categoryId);

        return $goods;
    }


}

//site/index.php?path=index/test/5
