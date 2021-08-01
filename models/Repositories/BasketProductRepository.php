<?php

namespace app\models\Repositories;

use app\engine\Db;
use app\models\entities\BasketProduct;
use \app\models\Repository;

class BasketProductRepository extends Repository
{
    public function getBasket($session_id)
    {
        $sql = "SELECT basket_products.id basket_id, products.id prod_id, products.name, products.description, products.price FROM `basket_products`,`products` WHERE `session_id` = '{$session_id}' AND basket_products.item_id = products.id";
        return Db::getInstance()->queryAll($sql);
    }

    protected function getEntityClass()
    {
        return BasketProduct::class;
    }

    protected function getTableName()
    {
        return 'basket_products';
    }
}