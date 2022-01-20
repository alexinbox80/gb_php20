<?php
require_once "GoodList.class.php";

class Cart extends GoodList
{

    function __construct($id, $title, $description, $image, $price, $size, $color, $discount)
    {
        parent::__construct($id, $title, $description, $image, $price, $size, $color, $discount);

    }

    public function add($good)
    {
        foreach ($this->goodList as $goods) {
            if ($goods['id'] == $good['id']) {
                $goods['count']++;
            } else {
                $this->goodList[] = $good;
            }
        }

        return $this->goodList;
    }

    public function decrease($id)
    {
        $goods = [];

        foreach ($this->goodList as $good) {
            if ($goods['id'] != $id) {
                $goods[] = $good;
            }
        }

        return $goods;
    }

    public function getCount()
    {
        $count = 0;

        foreach ($this->goodList as $goods) {
           $count += $goods['count'];
        }

        return $count;
    }
}

