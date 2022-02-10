<?php

class Controller
{
    public $view = 'admin';
    public $title;

    function __construct()
    {
        $this->title = Config::get('sitename');
    }

    protected function adminCheckAuth($data)
    {
        User::sessionStart();
        if (Auth::isAuthorized()) {
            $user_uuid = $_SESSION['user_id'];

            $role = Auth::getGroupFromUUID($user_uuid);

            if ($role == 'Administrator') {
                $answer = [
                    'info' => 'User is registered in the system!',
                    'status' => 'ok',
                    'role' => $role
                ];
            }

            if ($role == 'User') {
                $answer = [
                    'info' => 'You dont have permission to access!',
                    'status' => 'error',
                    'role' => $role
                ];
            }

        } else {
            Auth::login($data);
            $user_uuid = $_SESSION['user_id'];

            $role = Auth::getGroupFromUUID($user_uuid);

            if ($role == 'Administrator') {
                $answer = [
                    'info' => 'User is registered in the system!',
                    'status' => 'ok',
                    'role' => $role
                ];
            }

            if ($role == 'User') {
                $answer = [
                    'info' => 'You dont have permission to access!',
                    'status' => 'error',
                    'role' => $role
                ];
            }
        }
        return $answer;
    }

    protected function checkAuth($data)
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

            $result = Auth::login($data);

            $answer = [
                'info' => $result['info'],
                'status' => $result['status'],
                'role' => $role
            ];
        }

        return $answer;
    }

    public function index($data)
    {
        return [];
    }
}
