<?php

/**
 * Class Good
 *
 * @author My Name <my.name@example.com>
 * @internal
 *
 */

namespace App\Model;

class Good extends Model
{
    protected static $table = 'goods';

    protected static function setProperties()
    {

        self::$properties['good_id'] = [
            'type' => 'varchar',
            'size' => 36
        ];

        self::$properties['title'] = [
            'type' => 'varchar',
            'size' => 512
        ];

        self::$properties['price'] = [
            'type' => 'float'
        ];

        self::$properties['discount'] = [
            'type' => 'float'
        ];

        self::$properties['description'] = [
            'type' => 'text'
        ];

        self::$properties['category_id'] = [
            'type' => 'varchar'
        ];

        self::$properties['image'] = [
            'type' => 'varchar'
        ];

        self::$properties['color'] = [
            'type' => 'varchar'
        ];

        self::$properties['size'] = [
            'type' => 'varchar'
        ];
    }

    public static function getGoodsPage($categoryId, $begin = 0, $offset)
    {
        $sql = "SELECT * 
                FROM  " . self::$table . "
                WHERE category_id = :category_id AND status = :status AND id > :begin 
                LIMIT :offset";

        $params = [
            [
                'name' => ':category_id',
                'data' => $categoryId,
                'type' => \PDO::PARAM_STR
            ],
            [
                'name' => ':status',
                'data' => Status::ACTIVE,
                'type' => \PDO::PARAM_INT
            ],
            [
                'name' => ':begin',
                'data' => (int)$begin,
                'type' => \PDO::PARAM_INT
            ],
            [
                'name' => ':offset',
                'data' => (int)$offset,
                'type' => \PDO::PARAM_INT
            ]
        ];

        $result = \App\Lib\db::getInstance()->QueryBindParam($sql, $params);

        return $result;
    }

    public static function getGoods($categoryId)
    {
        $sql = "SELECT * FROM goods WHERE category_id = :category_id AND status = :status";

        return \App\Lib\db::getInstance()->Select(
            $sql,
            ['status' => Status::ACTIVE, 'category_id' => $categoryId]);
    }

    public function getGoodInfo()
    {
        return \App\Lib\db::getInstance()->Select(
            'SELECT * FROM goods WHERE good_id = :good_id',
            ['good_id' => $this->good_id]);
    }

    public static function getGoodPrice($good_id)
    {
        $result = \App\Lib\db::getInstance()->Select(
            'SELECT price FROM goods WHERE good_id = :good_id',
            ['good_good' => $good_id]);

        return (isset($result[0]) ? $result[0]['price'] : null);
    }
}
