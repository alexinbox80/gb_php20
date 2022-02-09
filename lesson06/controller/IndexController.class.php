<?php

class IndexController extends Controller
{
    public $view = 'index';
    public $title;

    function __construct()
    {
        parent::__construct();
        $this->title .= ' | Showcase';
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

    function goods($data){

        $categoryId = 'ef720659-d7c1-4405-9fb1-ac1b36c00444';

        $lbgn = $_GET['lbgn'] ? strip_tags($_GET['lbgn']) : "";
        $lcnt = $_GET['lcnt'] ? strip_tags($_GET['lcnt']) : "";

        if (($lbgn >= 0 ) || ($lbgn > 0)) {
            $goods = Good::getGoodsPage($categoryId, $lbgn, $lcnt);
        } else {
            $goods = Good::getGoods($categoryId);
        }

        return $goods;
    }

    function cart($data)
    {
        $userId = 'c08b32be-1677-443c-bf00-877291354c93';

        $cart = Cart::getCart($userId);

        return $cart;
    }
}

//site/index.php?path=index/test/5
