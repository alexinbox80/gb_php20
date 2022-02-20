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
    }
}

//site/index.php?path=index/test/5
