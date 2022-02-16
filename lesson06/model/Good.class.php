<?php

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
                AND id <= :offset ";
                //LIMIT :offset; ";

        return db::getInstance()->Select(
            $sql,
            [
                'status' => Status::Active,
                'category_id' => $categoryId,
                'begin' => (int)$begin,
                'offset' => (int)$offset
            ]);
    }

    public static function getGoods($categoryId)
    {
        //$sql = "SELECT good_id, category_id, `title`, price FROM goods WHERE category_id = :category_id AND status=:status";
        $sql = "SELECT * FROM goods WHERE category_id = :category_id AND status = :status";
        return db::getInstance()->Select(
            $sql,
            ['status' => Status::Active, 'category_id' => $categoryId]);
    }

    public function getGoodInfo()
    {
        return db::getInstance()->Select(
            'SELECT * FROM goods WHERE good_id = :good_id',
            ['good_id' => $this->good_id]);
    }

    public static function getGoodPrice($good_id)
    {
        $result = db::getInstance()->Select(
            'SELECT price FROM goods WHERE good_id = :good_id',
            ['good_good' => $good_id]);

        return (isset($result[0]) ? $result[0]['price'] : null);
    }
}
