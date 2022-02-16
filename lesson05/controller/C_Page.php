<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

class C_Page extends C_Base
{
    public function action_index()
    {
        $goods = new M_Goods();
        $data = $goods->getGoods();

        $this->vars['index'] += ['goods' => $data];

        if ($this->getSiteSession('user')) {
            $user = $this->getSiteSession('user');

            array_push($user['history'], ['page' => 'Index page']);

            $this->setSiteSession('user', $user);
        }
    }

    public function action_catalog()
    {
    }
}
