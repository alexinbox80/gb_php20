<?php
require_once "GoodList.class.php";

class Cart extends GoodList
{
    private $cart = [];

    function __construct()
    {
        parent::__construct();
    }

    public function getCart():array
    {
        return $this->cart;
    }

    public function add2cart(array $good):void
    {
        $findIndex = 0;

        for($i = 0; $i < count($this->cart); $i++) {
            if($this->cart[$i]['id'] == $good['id']) {
                $findIndex = $i;
            }
        }

        if ($this->cart[$findIndex]['id'] == $good['id']){
            $this->cart[$findIndex]['count']++;
        } else {
            $good['count'] = 1;
            $this->cart[] = $good;
        }
    }

    public function decrease(int $id):array
    {
        $goods = [];

        for($i = 0; $i < count($this->cart); $i++) {
            if($this->cart[$i]['id'] != $id) {
                $goods[] = $this->cart[$i];
            }
        }

        return $goods;
    }

    public function getCount():int
    {
        $count = 0;

        if (count($this->cart)) {
            foreach ($this->cart as $goods) {
                $count += $goods['count'];
            }
        }
        return $count;
    }
}

