<?php

//namespace App\Controllers;

//use App\Configuration as Config;

class Controller
{
    public $view = 'admin';
    public $title;

    function __construct()
    {
        $this->title = Config::get('sitename');
    }

    protected function adminCheckRights()
    {
        $answer = '';

        $user_uuid = $_SESSION['user_id'];

        $role = strtolower(Auth::getGroupFromUUID($user_uuid));

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
        User::sessionStart();
        if (Auth::isAuthorized()) {

            $answer = $this->adminCheckRights();

        } else {
            Auth::login($data);

            $answer = $this->adminCheckRights();

        }

        return $answer;
    }

    protected function getRole($result)
    {
        $user_uuid = $_SESSION['user_id'];

        $role = strtolower(Auth::getGroupFromUUID($user_uuid));

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
        User::sessionStart();
        if (Auth::isAuthorized()) {

            $answer = $this->getRole('');

        } else {

            $result = Auth::login($data);
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
