<?php

class Cart extends Model
{
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

        self::$properties['good_id'] = [
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

    public static function deleteCartItem($data)
    {
        $orderId = '3cb37309-7b6e-4a13-9472-dd7ad4c65626';
        $userId = 'c08b32be-1677-443c-bf00-877291354c93';

        $sql = "DELETE FROM " . self::$table . "
                WHERE
                    carts.order_id = '" . $orderId ."' AND
                    carts.user_id = '" . $userId . "' AND
                    carts.good_id = '" . $data['good_id'] . "'";

        $result = 'ok';
        db::getInstance()->Query(
            $sql,
            [
                'user_id' => $userId,
                'order_id' => $orderId,
                'good_id' => $data['good_id']
            ]);

        return $result;
    }

    public static function updateCart($data)
    {
        $orderId = '3cb37309-7b6e-4a13-9472-dd7ad4c65626';

        foreach ($data as $item) {
            $sql = "SELECT *
                    FROM " . self::$table . "
                    WHERE carts.status = :status AND 
                          carts.user_id = :user_id AND
                          carts.good_id = :good_id";

            $result = db::getInstance()->Select(
                $sql,
                [
                    'status' => Status::Active,
                    'user_id' => $item['user_id'],
                    'good_id' => $item['good_id']
                ]);

            if (count($result) > 0) {
                // update
                $sql = "UPDATE " . self::$table . "
                        SET quantity = :quantity,
                            dateUpdate = NOW()
                        WHERE carts.status = :status AND 
                              carts.user_id = :user_id AND
                              carts.good_id = :good_id";

                $result = 'ok';
                    db::getInstance()->Query(
                    $sql,
                    [
                        'quantity' => $item['quantity'],
                        'status' => Status::Active,
                        'user_id' => $item['user_id'],
                        'good_id' => $item['good_id']
                    ]);
            } else {
                //  insert
//                $sql = "INSERT INTO  " . self::$table . " (cart_id, order_id, user_id, good_id, price,
//                                            quantity, dateCreate, dateUpdate, status)
//                        VALUES (`:cart_id`, `:order_id`, `:user_id`, `:good_id`, 0, :quantity,
//                                NOW(), NOW(), :status)";

                $sql = "INSERT INTO  " . self::$table . " (cart_id, order_id, user_id, good_id, price,
                                            quantity, dateCreate, dateUpdate, status)
                        VALUES ('" . $orderId . "',
                                '" . $orderId . "',
                                '" . $item['user_id'] . "',
                                '" . $item['good_id'] . "',
                                0,
                                " . $item['quantity'] . ",
                                NOW(), NOW(),
                                1)";

                $result = 'ok';
                    db::getInstance()->Query(
                    $sql,
                    [
                        'cart_id' => $orderId,
                        'order_id' => $orderId,
                        'user_id' => $item['user_id'],
                        'good_id' => $item['good_id'],
                        'quantity' => $item['quantity'],
                        'status' => 1
                    ]);
            }
        }
        return $result;
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
