<?php

/**
 * Class Controller
 *
 * @author My Name <my.name@example.com>
 * @internal
 *
 */

namespace App\Controller;

class Controller
{
    public $view = 'admin';
    public $title;

    function __construct()
    {
        $this->title = \App\Lib\Config::get('sitename');
    }

    protected function adminCheckRights()
    {
        $answer = '';

        $user_uuid = $_SESSION['user_id'];

        $role = strtolower(\App\Model\Auth::getGroupFromUUID($user_uuid));

        if ($role == 'administrator') {
            $answer = [
                'info' => 'User is registered in the system!',
                'status' => 'ok',
                'role' => $role
            ];
        }

        if ($role == 'user') {
            $answer = [
                'info' => 'You dont have permission to access!',
                'status' => 'error',
                'role' => $role
            ];
        }

        return $answer;
    }

    protected function adminCheckAuth($data)
    {
        \App\Model\User::sessionStart();
        if (\App\Model\Auth::isAuthorized()) {

            $answer = $this->adminCheckRights();

        } else {
            \App\Model\Auth::login($data);

            $answer = $this->adminCheckRights();

        }

        return $answer;
    }

    protected function getRole($result)
    {
        $user_uuid = $_SESSION['user_id'];

        $role = strtolower(\App\Model\Auth::getGroupFromUUID($user_uuid));

        if ($result === '') {
            $answer = [
                'info' => 'User is registered in the system!',
                'status' => 'ok',
                'role' => $role
            ];
        } else {
            $answer = [
                'info' => $result['info'],
                'status' => $result['status'],
                'role' => $role
            ];
        }
        return $answer;
    }

    protected function checkAuth($data)
    {
        \App\Model\User::sessionStart();
        if (\App\Model\Auth::isAuthorized()) {

            $answer = $this->getRole('');

        } else {

            $result = \App\Model\Auth::login($data);
            $answer = $this->getRole($result);

        }

        return $answer;
    }

    protected function IsGet()
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    protected function IsPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    public function index($data)
    {
        return [];
    }
}
