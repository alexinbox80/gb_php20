<?php

/**
 * Class Order
 *
 * @author My Name <my.name@example.com>
 * @internal
 *
 */

class Order extends Model {
    protected static $table = 'orders';

    protected static function setProperties()
    {
        self::$properties['phone'] = [
            'type' => 'varchar',
            'size' => 512
        ];

        self::$properties['address'] = [
            'type' => 'varchar',
            'size' => 512
        ];

        self::$properties['email'] = [
            'type' => 'float'
        ];

        self::$properties['order_id'] = [
            'type' => 'varchar',
            'size' => 36
        ];

        self::$properties['user_id'] = [
            'type' => 'varchar',
            'size' => 36
        ];

        self::$properties['amount'] = [
            'type' => 'int',
        ];

        self::$properties['price'] = [
            'type' => 'float',
        ];
    }

    public static function setOrder(array $data)
    {
        $sql = "SELECT good_id, order_id FROM carts WHERE user_id = :user_id AND status = :status ORDER BY user_id";
        $result = db::getInstance()->Select(
            $sql,
            [
                'status' => Status::ACTIVE,
                'user_id' => $data['user_id']
            ]);

        $goodId = $result[0]['good_id'];
        $orderId = $result[0]['order_id'];

        try {
            if (db::getInstance()->beginTransaction()) {

                $sql = "SELECT * FROM orders WHERE order_id = :order_id";

                $exist = db::getInstance()->Select(
                    $sql,
                    [
                        'order_id' => $orderId
                    ]);

                if ($exist) {
                    $sql = "UPDATE orders
                            SET amount = :amount,
                                price = :price,
                                dateUpdate = NOW()
                            WHERE status = :status AND 
                                user_id = :user_id AND
                                order_id = :order_id";

                    $params = [
                        [
                            'name' => ':amount',
                            'data' => $data['amount'],
                            'type' => PDO::PARAM_INT
                        ],
                        [
                            'name' => ':price',
                            'data' => $data['price'],
                            'type' => PDO::PARAM_INT
                        ],
                        [
                            'name' => ':status',
                            'data' => Status::ACTIVE,
                            'type' => PDO::PARAM_INT
                        ],
                        [
                            'name' => ':user_id',
                            'data' => $data['user_id'],
                            'type' => PDO::PARAM_STR
                        ],
                        [
                            'name' => ':order_id',
                            'data' => $orderId,
                            'type' => PDO::PARAM_STR
                        ]
                    ];

                    $result = db::getInstance()->QueryBindParam(
                        $sql,
                        $params);


                } else {
                    $sql = "INSERT INTO orders(order_id, user_id, amount, price, dateCreate, dateUpdate, status)
                        VALUES (:order_id, :user_id, :amount, :price, NOW(), NULL, :status)";

                    $params = [
                        [
                            'name' => ':order_id',
                            'data' => $orderId,
                            'type' => PDO::PARAM_STR
                        ],
                        [
                            'name' => ':user_id',
                            'data' => $data['user_id'],
                            'type' => PDO::PARAM_STR
                        ],
                        [
                            'name' => ':amount',
                            'data' => $data['amount'],
                            'type' => PDO::PARAM_INT
                        ],
                        [
                            'name' => ':price',
                            'data' => $data['price'],
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
                }
                // users update
                $sql = "UPDATE users
                        SET address = :address,
                            phone = :phone
                        WHERE status = :status AND 
                              user_id = :user_id";

                $address = $data['shippingCity'] . " " . $data['shippingState'] . " " . $data['shippingZip'];

                $params = [
                    [
                        'name' => ':address',
                        'data' => $address,
                        'type' => PDO::PARAM_STR
                    ],
                    [
                        'name' => ':phone',
                        'data' => $data['shippingPhone'],
                        'type' => PDO::PARAM_INT
                    ],
                    [
                        'name' => ':status',
                        'data' => Status::ACTIVE,
                        'type' => PDO::PARAM_INT
                    ],
                    [
                        'name' => ':user_id',
                        'data' => $data['user_id'],
                        'type' => PDO::PARAM_STR
                    ]
                ];

                $result = db::getInstance()->QueryBindParam(
                    $sql,
                    $params);


                $result = [
                    'status' => 'ok',
                    'message' => 'Order succesfully created!'
                ];

                db::getInstance()->commit();
            }

        } catch (PDOException $e) {
            if (db::getInstance()->inTransaction()) {
                db::getInstance()->rollBack();
                die($e->getMessage());
            }
        }

        return $result;
    }
}
