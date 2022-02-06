<?php

class Good extends Model {
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

    public static function getGoods($categoryId)
    {
        return db::getInstance()->Select(
            'SELECT good_id, category_id, `title`, price FROM goods WHERE category_id = :category_id AND status=:status',
            ['status' => Status::Active, 'category_id' => $categoryId]);
    }

    public function getGoodInfo(){
        return db::getInstance()->Select(
            'SELECT * FROM goods WHERE good_id = :good_id',
            ['good_id' => (int)$this->good_id]);
    }

    public static function getGoodPrice($good_id){
        $result = db::getInstance()->Select(
            'SELECT price FROM goods WHERE good_id = :good_id',
            ['good_good' => $good_id]);

        return (isset($result[0]) ? $result[0]['price'] : null);
    }
}
