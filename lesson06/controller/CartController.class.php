<?php

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
        return [];
    }
}