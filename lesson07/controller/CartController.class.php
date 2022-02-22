<?php

/**
 * Class CartController
 *
 * @author My Name <my.name@example.com>
 * @internal
 *
 */

namespace App\Controller;

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
        \App\Model\User::sessionStart();
        if (\App\Model\Auth::isAuthorized()) {

            $user_uuid = $_SESSION['user_id'];

            $role = \App\Model\Auth::getGroupFromUUID($user_uuid);

            $answer = [
                'info' => 'User is registered in the system!',
                'status' => 'ok',
                'role' => $role
            ];

        } else {
            \App\Model\Auth::login($data);

            $user_uuid = $_SESSION['user_id'];

            $role = \App\Model\Auth::getGroupFromUUID($user_uuid);

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
