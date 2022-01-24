<?php

namespace alexinbox\phpv20;
require_once "Goods.php";

class DGoods extends Goods
{
    public function getCost(): float
    {
        $sum = 0;
        for ($i = 0; $i < count($this->getGoods()); $i++) {
            $sum += $this->getGoods()[$i]['price'] * $this->getGoods()[$i]['quantity'];
        }

        return $sum;
    }

    public function getFullPrice(float $price): float
    {
        return $price * 0.8;
    }
}
