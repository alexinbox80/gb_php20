<?php

class RegsController extends Controller
{
    public $view = 'regs';

    function __construct()
    {
        parent::__construct();
        $this->title .= ' | Registration';
    }

    function index($data){

       return[];
    }
}
