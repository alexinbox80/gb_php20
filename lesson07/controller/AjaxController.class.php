<?php

//namespace App\Controllers;
//use App\Controllers;

/**
 * Class AjaxController
 *
 * @author My Name <my.name@example.com>
 * @internal
 *
 */

class AjaxController extends Controller
{

    /**
     * пример документирования переменной
     * @var string
     * @param mixed[] $array Array массив значений.
     * @param int|string $value некоторое значение.
     * @return int возвращает номер элемента.

     */
    //var $variable;

    /**
     * @var string
     */

    public $view = 'index';

    /**
     * AjaxController constructor.
     */
    function __construct()
    {
        parent::__construct();
        //$this->title .= ' | Catalog';
    }

    /**
     * @param $data
     *
     * @return array()
     */

    public function index($data)
    {
        return [];
    }

    /**
     * Ajax router
     *
     * @param $data
     *
     * @return array()
     */

    public function router($data)
    {
        $result = '';

        if ($this->IsPost()) {

            $post = file_get_contents('php://input');
            $post = json_decode($post, true);

            $action = $post['todo'];
            $data = $post['cart'];

            switch ($action) {
                case 'auth':
                    $data = $post['form'];
                    if (isset($data)) {
                        $controllerName = ucfirst(isset($data['page']) ? strip_tags($data['page']) : 'index') . 'Controller';//IndexController
                        $methodName = 'index';
                        $controller = new $controllerName();

                        $_POST['authLogin'] = $data['authLogin'] ? strip_tags($data['authLogin']) : "";
                        $_POST['authPasswd'] = $data['authPasswd'] ? strip_tags($data['authPasswd']) : "";
                        $_POST['authRemember-me'] = $data['authRemember-me'] ? strip_tags($data['authRemember-me']) : "";
                        $_POST['act'] = $data['act'] ? strip_tags($data['act']) : "";

                        $result = $controller->$methodName($_GET);
                    }
                    break;
                case 'regs':
                    $data = $post['form'];
                    $flag = true;
                    $error = '';

                    if ($data['firstName'] === '') {
                        $error .= ' Empty first name field';
                        $flag = false;
                    }

                    if ($data['secondName'] === '') {
                        $error .= ' Empty second name field';
                        $flag = false;
                    }

                    if ($data['email'] === '') {
                        $error .= ' Empty e-mail field';
                        $flag = false;
                    } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                        $error .= ' Wrong e-mail';
                        $flag = false;
                    }

                    if ($data['login'] === '') {
                        $error .= ' Empty login field';
                        $flag = false;
                    }

                    if ($data['passwd'] === '') {
                        $error .= ' Empty password field';
                        $flag = false;
                    }

                    if ($flag) {
                        if (!Auth::regs($data)) {
                            $result = [
                                'status' => 'error',
                                'message' => 'User already exist'
                            ];
                        } else {
                            $result = [
                                'status' => 'ok',
                                'message' => 'User registered successfully'
                            ];
                        }
                    } else {
                        $result = [
                            'status' => 'error',
                            'message' => $error
                        ];
                    }
                    break;
                case 'addToCart':
                    $result = Cart::updateCart($data);
                    break;
                case 'delFromCart':
                    $result = Cart::deleteCartItem($data);
                    break;
                case 'getCatalog':
                    $result = 'catalog';
                    break;
                default:
                    $result = 'Wrong operations!';
            }
        }

        return $result;
    }
}