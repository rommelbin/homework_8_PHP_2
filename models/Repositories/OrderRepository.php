<?php


namespace app\models\Repositories;


use app\engine\Db;
use app\models\entities\Order;
use app\models\Repository;

class OrderRepository extends Repository
{
    protected function getEntityClass()
    {
        return Order::class;
    }

    protected function getTableName()
    {
        return 'orders';
    }
    public function getOrders(){
        $sql = "SELECT * FROM orders";
        return Db::getInstance()->queryAll($sql);
    }

}