<?php

class CatalogController extends Controller
{
    public $view = 'catalog';

    function __construct()
    {
        parent::__construct();
        $this->title .= ' | Catalog';
    }

    function index($data){

        return[];
    }
}
