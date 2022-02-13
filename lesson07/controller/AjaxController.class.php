<?php

/**
 * Class AjaxController
 *
 * @author My Name <my.name@example.com>
 * @internal
 *
 */

//namespace App\Controllers;
//use App\Controllers;

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
     * AjaxController constructor.
     */

    public $view = 'index';

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
                    $result = $data;
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
