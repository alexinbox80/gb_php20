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

        $user_uuid = $_SESSION['user_id'];

        $role = Auth::getGroupFromUUID($user_uuid);

        $answer = [
            'content' => $content,
            'status' => $auth['status'],
            'info' => $auth['info'],
            'role' => $role
        ];

        return $answer;
	}

    private function login($data)
    {
        return $this->checkAuth($data);
    }

    public function logout()
    {
        User::sessionStart();
        if (Auth::isAuthorized()) {
            Auth::logout();
        }

        header('Location: /');
        return [];
    }

    public function goods($data){

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
