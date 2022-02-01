<?php

namespace alexinbox\phpv20;

abstract class Good
{
    abstract public function initGoods(array $goods, int $count): void;

    abstract public function showGoods(bool $debug = false): void;

    abstract public function getCost(): float;

    abstract public function getFullPrice(float $price): float;
}
