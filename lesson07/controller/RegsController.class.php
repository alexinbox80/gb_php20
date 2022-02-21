<?php

/**
 * Class RegsController
 *
 * @author My Name <my.name@example.com>
 * @internal
 *
 */


class RegsController extends Controller
{
    public $view = 'regs';

    function __construct()
    {
        parent::__construct();
        $this->title .= ' | Registration';
    }

    function index($data)
    {
        return $this->checkAuth($data);
    }
}
