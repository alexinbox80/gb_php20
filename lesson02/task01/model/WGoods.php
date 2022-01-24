<?php

namespace alexinbox\phpv20;
require_once "Goods.php";

class WGoods extends Goods
{
    public function getCost(): float
    {
        $sum = 0;
        for ($i = 0; $i < count($this->getGoods()); $i++) {
            if ($this->getGoods()[$i]['quantity'] >= 5) {
                $coefficient = 0.90;
            } else {
                $coefficient = 1.25;
            }
            $sum += $coefficient * $this->getGoods()[$i]['price'] * $this->getGoods()[$i]['quantity'];
        }
        return $sum;
    }

    public function getFullPrice(float $price): float
    {
        return $price * 1.2;
    }
}
