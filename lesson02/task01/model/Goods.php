<?php

namespace alexinbox\phpv20;
require_once "Good.php";

class Goods extends Good {
    private $goods = [];

    function __construct(array $goods, int $quantity)
    {
        $this->initGoods($goods, $quantity);
    }

    public function initGoods(array $goods, int $count): void
    {
        for ($i = 0; $i < $count; $i++) {
            $this->goods[$i] = [
                'id' => $i + 1,
                'name' => $goods[rand(0, count($goods) - 1)]['name'],
                'price' => $goods[rand(0, count($goods) - 1)]['price'],
                'quantity' => rand(1, count($goods))
            ];
        }
    }

    public function getGoods(): array
    {
        return $this->goods;
    }

    public function showGoods(bool $debug = false): void
    {
        for ($i = 0; $i < count($this->goods); $i++) {
            echo "id: {$this->goods[$i]['id']} 
                  name: {$this->goods[$i]['name']} 
                  price: {$this->goods[$i]['price']} 
                  quantity: {$this->goods[$i]['quantity']} <br>\n";
        }
        if ($debug) {
            echo "<pre>";
            print_r($this->goods);
            echo "</pre>";
        }
    }

    public function getCost(): float
    {
        return 0;
    }

    public function getFullPrice(float $price): float
    {
        return 0;
    }
}
