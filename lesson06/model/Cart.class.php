<?php

class Cart extends Model
{
//    function __construct(array $values = [])
//    {
//        parent::__construct($values);
//    }

    protected static $table = 'carts';

    protected static function setProperties()
    {
        self::$properties['cart_id'] = [
            'type' => 'varchar',
            'size' => 36
        ];

        self::$properties['user_id'] = [
            'type' => 'varchar',
            'size' => 36
        ];

        self::$properties['order_id'] = [
            'type' => 'varchar',
            'size' => 36
        ];

        self::$properties['price'] = [
            'type' => 'float'
        ];

        self::$properties['quantity'] = [
            'type' => 'int'
        ];

        self::$properties['dateCreate'] = [
            'type' => 'timestamp'
        ];

        self::$properties['dateUpdate'] = [
            'type' => 'timestamp'
        ];

        self::$properties['status'] = [
            'type' => 'int'
        ];
    }

    public static function getCart($userId)
    {

        $sql = "SELECT carts.cart_id, carts.user_id, carts.good_id, carts.quantity, goods.title, goods.description, goods.image, goods.color, goods.size, goods.price, goods.discount
                FROM carts
                INNER JOIN goods ON carts.good_id = goods.good_id
                WHERE carts.status = :status AND goods.status = :status AND user_id = :user_id";

        return db::getInstance()->Select(
            $sql,
            [
                'status' => Status::Active,
                'user_id' => $userId
            ]);
    }
}
