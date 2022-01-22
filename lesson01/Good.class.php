<?php


class Good
{

    private $id;
    private $title;
    private $description;
    private $image;
    private $color;
    private $size;
    private $price;
    private $discount;
    private $good;

    function __construct(array $good)
    {

        $this->id = $good['id'];
        $this->title = $good['title'];
        $this->description = $good['description'];
        $this->image = $good['image'];
        $this->color = $good['color'];
        $this->size = $good['size'];
        $this->price = $good['price'];
        $this->discount = $good['discount'];

        $this->good = $good;
    }

    /**
     * @return mixed
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle():string
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getDescription():string
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getImage():string
    {
        return $this->image;
    }

    /**
     * @return mixed
     */
    public function getPrice():float
    {
        return $this->price;
    }

    /**
     * @param mixed $size
     */
    public function getSize():string
    {
        return $this->size;
    }

    /**
     * @param mixed $color
     */
    public function getColor():string
    {
        return $this->color;
    }

    /**
     * @return mixed
     */
    public function getDiscount():float
    {
        return $this->discount;
    }

    public function showGood():void
    {
        echo   " id: ". $this->id .
               " title: " . $this->title .
               " description: " . $this->description .
               " image: " . $this->image .
               " color: " . $this->color .
               " size: " . $this->size .
               " price: " . $this->price .
               " discount: " . $this->discount . "<br><hr><br>";
    }

    public function getGood():array
    {
        return $this->good;
    }
}
