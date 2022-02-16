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
                    carts.order_id = :order_id AND
                    carts.user_id = :user_id AND
                    carts.good_id = :good_id";

        $params = [
            [
                'name' => ':order_id',
                'data' => $orderId,
                'type' => PDO::PARAM_STR
            ],
            [
                'name' => ':user_id',
                'data' => $userId,
                'type' => PDO::PARAM_STR
            ],
            [
                'name' => ':good_id',
                'data' => $data['good_id'],
                'type' => PDO::PARAM_STR
            ]
        ];

        $result = db::getInstance()->QueryBindParam(
            $sql,
            $params);

        $result = ['delete' => $result];

        return $result;
    }

    public static function updateCart($data)
    {

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

                $params = [
                    [
                        'name' => ':quantity',
                        'data' => $item['quantity'],
                        'type' => PDO::PARAM_INT
                    ],
                    [
                        'name' => ':status',
                        'data' => Status::Active,
                        'type' => PDO::PARAM_INT
                    ],
                    [
                        'name' => ':user_id',
                        'data' => $item['user_id'],
                        'type' => PDO::PARAM_STR
                    ],
                    [
                        'name' => ':good_id',
                        'data' => $item['good_id'],
                        'type' => PDO::PARAM_STR
                    ]
                ];

                $result = db::getInstance()->QueryBindParam(
                    $sql,
                    $params);

                $result = ['update' => $result];
            } else {
                //  insert

                $cartId = '3cb37309-7b6e-4a13-9472-dd7ad4c65626';
                $orderId = '3cb37309-7b6e-4a13-9472-dd7ad4c65626';

                $sql = "INSERT INTO  " . self::$table . " (cart_id, order_id, user_id, good_id, price,
                                            quantity, dateCreate, dateUpdate, status)
                        VALUES (:cart_id, :order_id, :user_id, :good_id, 0, :quantity,
                                NOW(), NOW(), :status)";

                $params = [
                    [
                        'name' => ':cart_id',
                        'data' => $cartId,
                        'type' => PDO::PARAM_STR
                    ],
                    [
                        'name' => ':order_id',
                        'data' => $orderId,
                        'type' => PDO::PARAM_STR
                    ],
                    [
                        'name' => ':user_id',
                        'data' => $item['user_id'],
                        'type' => PDO::PARAM_STR
                    ],
                    [
                        'name' => ':good_id',
                        'data' => $item['good_id'],
                        'type' => PDO::PARAM_STR
                    ],
//                    [
//                        'name' => ':price',
//                        'data' => (string)$item['price'],
//                        'type' => PDO::PARAM_STR
//                    ],
                    [
                        'name' => ':quantity',
                        'data' => $item['quantity'],
                        'type' => PDO::PARAM_INT
                    ],
                    [
                        'name' => ':status',
                        'data' => Status::ACTIVE,
                        'type' => PDO::PARAM_INT
                    ]
                ];

                $result = db::getInstance()->QueryBindParam(
                    $sql,
                    $params);

                $result = ['insert' => 'id:' . $result];
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
                'status' => Status::ACTIVE,
                'user_id' => $userId
            ]);
    }
}
