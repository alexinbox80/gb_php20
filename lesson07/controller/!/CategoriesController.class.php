<?php

class CategoriesController extends Controller
{

    public $view = 'categories';

    public function index($data)
    {
        $categories = Category::getCategories(isset($data['id']) ? $data['id'] : 0);
        $goods = Good::getGoods(isset($data['id']) ? $data['id'] : 0);

        //$categories = Category::getCategories(isset($data['id']) ? $data['id'] : null);
        //$goods = Good::getGoods(isset($data['id']) ? $data['id'] : null);

        return ['subcategories' => $categories, 'goods' => $goods];
    }

    public function goods($data)
    {

        if ( isset($data['id'] )) {
            $good = new Good([
                "good_id" => $data['id']
            ]);

            return $good->getGoodInfo()[0];

        } else {
            header("Location: /categories/");
        }


    }
}
