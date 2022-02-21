<?php

/**
 * Class ProductController
 *
 * @author My Name <my.name@example.com>
 * @internal
 *
 */

class ProductController extends Controller
{
    public $view = 'product';

    function __construct()
    {
        parent::__construct();
        $this->title .= ' | Products';
    }

    function index($data){
        return $this->checkAuth($data);
    }
}
