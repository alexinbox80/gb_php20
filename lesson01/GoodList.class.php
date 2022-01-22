<?php
require_once "Good.class.php";
require_once "Catalog.class.php";

class GoodList Extends Good
{
    protected $goodList = [];

    function __construct()
    {
        parent::__construct($this->goodList);

    }

    public function createList()
    {
        $catalog = new Catalog;

        for ($i = 0; $i < count($catalog->catalog); $i++) {

            $catalogGood = ['id' => $catalog->catalog[$i]['id'],
                            'title' => $catalog->catalog[$i]['title'],
                            'description' => $catalog->catalog[$i]['description'],
                            'image' => $catalog->catalog[$i]['image'],
                            'color' => $catalog->catalog[$i]['color'],
                            'size' => $catalog->catalog[$i]['size'],
                            'price' => $catalog->catalog[$i]['price'],
                            'discount' => $catalog->catalog[$i]['discount']];

            $good = new Good($catalogGood);

            $this->goodList[$i] = $good->getGood();

        }
    }

    public function getCount():int
    {
        return count($this->goodList);
    }

    public function add(array $good):void
    {
        $this->goodList[] = $good;
    }

    public function remove(int $id):void
    {
        $goods = [];

        foreach ($this->goodList as $good) {
            if ($good['id'] != $id) {
                $goods[] = $good;
            }
        }

        $this->goodList = $goods;
    }

    public function get(int $id):array
    {
        $answ = [];

        foreach ($this->goodList as $good) {
            if ($good['id'] == $id) {
                $answ = $good;
            }
        }

        return $answ;
    }

    public function getAll():array
    {

        return $this->goodList;
    }


    public function getSumGoodsList():float
    {
        $sum = 0;

        foreach ($this->goodList as $good) {
            $sum += $good['price'];
        }

        return $sum;

    }

    public function showList():void
    {

        foreach ($this->goodList as $good) {
            echo "<br><br>";

            echo " id: " . $good['id'] .
                 " title: " . $good['title'] .
                 " description: " . $good['description'] .
                 " image: " . $good['image'] .
                 " color: " . $good['color'] .
                 " size: " . $good['size'] .
                 " price: " . $good['price'] .
                 " discount: " . $good['discount'] . "<br><hr>";

        }
    }
}
