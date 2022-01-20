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

    function __construct($id, $title, $description, $image, $color, $size, $price, $discount)
    {

        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->color = $color;
        $this->size = $size;
        $this->price = $price;
        $this->discount = $discount;

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $size
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $color
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @return mixed
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    public function showGood()
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

    public function getGood()
    {
        return  ['id' => $this->id,
                 'title' => $this->title,
                 'description' => $this->description,
                 'image' => $this->image,
                 'color' => $this->color,
                 'size' => $this->size,
                 'price' => $this->price,
                 'discount' => $this->discount];
    }
}
