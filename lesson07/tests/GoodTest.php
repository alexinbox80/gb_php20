<?php

//require_once __DIR__ . "../../model/Good.class.php";
//require_once __DIR__ . "../../model/Model.class.php";

//use PHPUnit\Framework\TestCase;



//class CategoryTest extends BaseTest
//{
//    public function testGetCategories()
//    {
///        $this->assertNotNull(Category::getCategories());
//    }
//}

require_once  "../model/Model.class.php";
require_once  "../model/Good.class.php";
require_once  "../tests/BaseTest.php";

class GoodTest extends BaseTest
{
    /**
     * @dataProvider additionProvider
     */
    public function testAdd($categoryId, $begin, $offset, $expected)
    {
        $loginObj = new Good();
        $answ = count($loginObj->getGoodsPage($categoryId, $begin, $offset));

        $this->assertSame($expected, $answ);
    }

    public function additionProvider()
    {
        return [
            ['ef720659-d7c1-4405-9fb1-ac1b36c00444', 0, 6, 6]
        ];
    }
}
