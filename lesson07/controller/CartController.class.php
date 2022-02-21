<?php

/**
 * Class CartController
 *
 * @author My Name <my.name@example.com>
 * @internal
 *
 */

class CartController extends Controller
{
    public $view = 'cart';
    public $title;

    function __construct()
    {
        parent::__construct();
        $this->title .= ' | Cart';
    }

    //метод, который отправляет в представление информацию в виде переменной content_data
    function index($data)
    {
        User::sessionStart();
        if (Auth::isAuthorized()) {

            $user_uuid = $_SESSION['user_id'];

            $role = Auth::getGroupFromUUID($user_uuid);

            $answer = [
                'info' => 'User is registered in the system!',
                'status' => 'ok',
                'role' => $role
            ];

        } else {
            Auth::login($data);

            $user_uuid = $_SESSION['user_id'];

            $role = Auth::getGroupFromUUID($user_uuid);

            $answer = [
                'info' => 'You are not logged in!',
                'status' => 'error',
                'role' => $role,
                'page' => 'cart'
            ];
            //header('Location: index.php?path=cart');
        }

        return $answer;
    }
}
