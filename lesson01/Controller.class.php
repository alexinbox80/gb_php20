<?php

require_once "Cart.class.php";
require_once "Catalog.class.php";

class Controller
{

    public function load()
    {

        $goods = new GoodList("name");

        $goods->createList();

        $goods->showList();

        echo "remove good id : 4<br>";

        $goods->remove(4);

        echo "add good<br>";

        $good = [
            "id" => 8,
            "title" => "ELLERY X CAPSULE",
            "description" => "Known for her sculptural takes on traditional tailoring, Australian\n arbiter of cool Kym Ellery teams up with Moda Operandi.",
            "image" => "prod-item-8.jpg",
            "color" => "blue",
            "size" => "XXXL",
            "price" => 85.00,
            "discount" => 20
        ];

        $goods->add($good);

        echo "get id 8 <br>";
        print_r($goods->get(8));
        echo "<br>";

        echo "Sum of goods list is {$goods->getSumGoodsList()}<br>";

    }
}
