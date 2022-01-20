<?php
require_once "Good.class.php";

class PurchasedGood extends Good
{
    private $quantity = 0;
    private $price = 0;

    function __construct($id, $title, $description, $image, $price, $size, $color, $discount, $quantity = 1)
    {
        parent::__construct($id, $title, $description, $image, $price, $size, $color, $discount);

        $this->quantity = $quantity;
    }

    public function getPrice()
    {

        return $this->price * $this->quantity;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function add()
    {
        $this->quantity++;
    }

    public function remove()
    {
        $this->quantity--;
    }
}