<?php
require_once "Good.class.php";

class PurchasedGood extends Good
{
    private $quantity = 0;
    private $price = 0;

    function __construct($arr, $quantity = 1)
    {
        parent::__construct($arr);

        $this->quantity = $quantity;
    }

    public function getPrice():float
    {

        return $this->price * $this->quantity;
    }

    public function getQuantity():int
    {
        return $this->quantity;
    }

    public function add():int
    {
        $this->quantity++;
    }

    public function remove():int
    {
        $this->quantity--;
    }
}
