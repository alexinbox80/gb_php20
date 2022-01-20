<?php
require_once "Good.class.php";
require_once "Catalog.class.php";

class GoodList
{
    protected $goodList = [];
    protected $goodCount;
    protected $title = "";


    function __construct($title)
    {
//        parent::__construct($id, $title, $description, $image, $color, $size, $price, $discount);
//
//        $this->createList();
//
        $this->title = $title;
    }

    public function createList()
    {
        $catalog = new Catalog;

        for ($i = 0; $i < count($catalog->catalog); $i++) {

            $good = new Good($catalog->catalog[$i]['id'],
                             $catalog->catalog[$i]['title'],
                             $catalog->catalog[$i]['description'],
                             $catalog->catalog[$i]['image'],
                             $catalog->catalog[$i]['color'],
                             $catalog->catalog[$i]['size'],
                             $catalog->catalog[$i]['price'],
                             $catalog->catalog[$i]['discount']);

            $this->goodList[$i] = $good->getGood();

        }
    }

    public function setCount($count)
    {
        $this->goodCount = $count;
    }

    public function add($good)
    {
        $this->goodList[] = $good;
    }

    public function remove($id)
    {
        $goods = [];

        foreach ($this->goodList as $good) {
            if ($good['id'] != $id) {
                $goods[] = $good;
            }
        }

        $this->goodList = $goods;
    }

    public function get($id)
    {
        $answ = [];

        foreach ($this->goodList as $good) {
            if ($good['id'] == $id) {
                $answ = $good;
            }
        }

        return $answ;
    }

    public function getAll()
    {

        return $this->goodList;
    }


    public function getSumGoodsList()
    {
        $sum = 0;

        foreach ($this->goodList as $good) {
            $sum += $good['price'];
        }

        return $sum;

    }

    public function showList()
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
