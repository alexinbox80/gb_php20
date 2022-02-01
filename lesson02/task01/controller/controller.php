<?php
namespace alexinbox\phpv20;
use alexinbox\phpv20 as goods;

require_once "model/DGoods.php";
require_once "model/PGoods.php";
require_once "model/WGoods.php";

class Controller {
    public function init(): void
    {
        $dgoods = [
            ['name' => 'music', 'price' => 1.35],
            ['name' => 'book', 'price' => 2.44],
            ['name' => 'license', 'price' => 0.99],
            ['name' => 'games', 'price' => 3.35],
            ['name' => 'operating system', 'price' => 7.62]
        ];

        $pgoods = [
            ['name' => 'cell phone', 'price' => 2.15],
            ['name' => 'notebook', 'price' => 4.44],
            ['name' => 'tablet', 'price' => 5.99],
            ['name' => 'powerbank', 'price' => 12.35],
            ['name' => 'watch', 'price' => 5.45]
        ];

        $wgoods = [
            ['name' => 'bred', 'price' => 1.15],
            ['name' => 'buter', 'price' => 2.44],
            ['name' => 'potato', 'price' => 3.99],
            ['name' => 'tomatos', 'price' => 6.35],
            ['name' => 'cucumbers', 'price' => 1.44]
        ];

        echo "Digital products<br>\n";
        $goods = new goods\DGoods($dgoods, rand(1, 10));
        $goods->showGoods();
        echo "Total price: {$goods->getCost()} units.<br>\n";
        echo "Full price: {$goods->getFullPrice($goods->getCost())} units.<br><br>\n";

        echo "Piece products<br>\n";
        $goods = new goods\PGoods($pgoods, rand(1, 12));
        $goods->showGoods();
        echo "Total price: {$goods->getCost()} units.<br>\n";
        echo "Full price: {$goods->getFullPrice($goods->getCost())} units.<br><br>\n";

        echo "Weight products<br>\n";
        $goods = new goods\WGoods($wgoods, rand(1, 15));
        $goods->showGoods();
        echo "Total price: {$goods->getCost()} units.<br>\n";
        echo "Full price: {$goods->getFullPrice($goods->getCost())} units.<br><br>\n";
    }
}
