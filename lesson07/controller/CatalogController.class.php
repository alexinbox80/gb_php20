<?php

/**
 * Class CatalogController
 *
 * @author My Name <my.name@example.com>
 * @internal
 *
 */

namespace App\Controller;

class CatalogController extends Controller
{
    public $view = 'catalog';

    function __construct()
    {
        parent::__construct();
        $this->title .= ' | Catalog';
    }

    public function index($data)
    {
        return $this->checkAuth($data);
    }
}
