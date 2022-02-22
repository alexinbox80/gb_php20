<?php

/**
 * Class Page
 *
 * @author My Name <my.name@example.com>
 * @internal
 *
 */

namespace App\Model;

class Page extends Model
{
    protected static $table = 'pages';

    protected static function setProperties()
    {
        self::$properties['id'] = [
            'type' => 'int',
        ];

        self::$properties['name'] = [
            'type' => 'varchar',
            'size' => 512
        ];

    }
}
