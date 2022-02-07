<?php

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
    }

    public static function getProperties()
    {
        return self::$properties;
    }

    private static function getMenuTree($dataset)
    {
        $tree = array();

        $ind = 0;

        foreach ($dataset as $id => &$node) {

            echo "id = " . $id . "<br>";
            print_r($node);

            //Если нет вложений
            if (!$node['parent_id']) {
                $tree[$id] = &$node;
                //$tree[$id]['ind'] = $ind;
                //$tree[$node['category_id']] = &$node;
            } else {
                //Если есть потомки то перебераем массив
                $dataset[$node['parent_id']]['childs'][$id] = &$node;
                // $dataset[$node['parent_id']]['childs'][$id]['ind'] = $ind;
            }
            //$ind++;
        }
        return $tree;
    }

    private static function getMenu($parentId, $menu): array
    {
        //$arr = self::getMenuTree($menu);

        $arr = [];
        $ind = 0;

        foreach ($menu as $item) {
            $arr[] = [
                'category_id' => $item['category_id'],
                'name' => $item['name'],
                'parent_id' => $item['parent_id'],
                'ind' => $ind
            ];
            //$arr[]['ind'] = $ind;
            $ind++;
        }

        echo "HERE";
        $return = array();
        foreach ($menu as $value) { //Обходим массив
            $return[$value['parent_id']][] = $value;

            echo " : " . $value['parent_id'] . "<pre>";
            print_r($return[$value->parent_id]);
            echo "</pre>";
        }


        echo "<pre>";
        print_r($return);
        echo "</pre>";


        echo "<pre>";
        print_r($arr);
        echo "</pre>";

        $arr = self::getMenuTree($arr);

        echo "<pre>";
        print_r($arr);
        echo "</pre>";

        return $arr;
    }

    public static function getCategories($parentId = 0)
    {
        $result = db::getInstance()->Select(
            'SELECT category_id, name FROM categories WHERE status=:status AND parent_id = :parent_id',
            ['status' => Status::Active, 'parent_id' => $parentId]);

        if ($parentId <> 0) {
            $result = db::getInstance()->Select(
                'SELECT category_id, name, parent_id FROM categories WHERE status=:status',
                ['status' => Status::Active]);
            $result = self::getMenu($parentId, $result);


            //$this->_category_arr = $this->_getCategory();
//
//            $result = db::getInstance()->Select(
//                'SELECT id, name, parent FROM menu WHERE status=:status',
//                ['status' => Status::Active]);
//            $result = self::getMenu1($parentId, $result);
        }

        return $result;
    }
}
