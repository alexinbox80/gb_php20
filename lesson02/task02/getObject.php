<?php
namespace alexinbox\phpv20;
trait getObject {
    public static function getObject(): object
    {
        if (self::$obj == null) {
            //self::$obj = new DB();
            self::$obj = new self;
        }
        return self::$obj;
    }
}
