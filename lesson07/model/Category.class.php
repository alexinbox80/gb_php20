<?php

/**
 * Class Category
 *
 * @author My Name <my.name@example.com>
 * @internal
 *
 */

namespace App\Model;

class Category extends Model
{
    protected static $table = 'categories';

    protected static function setProperties()
    {
        self::$properties['name'] = [
            'type' => 'varchar',
            'size' => 512
        ];

        self::$properties['parent_id'] = [
            'type' => 'varchar',
            'size' => 36
        ];

        self::$properties['url'] = [
            'type' => 'varchar',
            'size' => 256
        ];
    }

    public static function getProperties()
    {
        return self::$properties;
    }

    private static function createMenuTree(array $elements, $parentId = 0): array
    {
        $tree = array();

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {

                $children = self::createMenuTree($elements, $element['id']);

                if ($children) {
                    //$element[$element['menu_nl']] = $children;
                    $element['children'] = $children;
                }

                $tree[] = $element;
            }
        }

        return $tree;
    }

    private static function createMenuTreeUUID(array $elements, $parentId = 'root'): array
    {
        $tree = array();
        foreach ($elements as $element) {

            if ($element['parent_id'] == $parentId) {

                $children = self::createMenuTreeUUID($elements, $element['category_id']);

                if ($children) {
                    //$element[$element['menu_nl']] = $children;
                    $element['children'] = $children;
                }

                $tree[] = $element;
            }
        }

        return $tree;
    }

    public static function getCategories($parentId = 0)
    {
        if ($parentId == -1) {
            $result = \App\Lib\db::getInstance()->Select(
                'SELECT category_id, name, url, parent_id FROM categories WHERE status=:status',
                ['status' => Status::ACTIVE]);

            $result = self::createMenuTreeUUID($result, 'root');
            //$result = self::createMenuTree($result, 0);;

        } elseif ($parentId == 0) {

            $result = \App\Lib\db::getInstance()->Select(
                'SELECT category_id, name FROM categories WHERE status=:status AND parent_id = :parent_id',
                ['status' => Status::ACTIVE, 'parent_id' => $parentId]);

        }

        return $result;
    }
}
