<?php

namespace app\controllers;


use app\engine\Request;
use app\models\Repositories\ProductRepository;

class ProductController extends Controller
{

    public function actionIndex()
    {
        echo $this->render('index');
    }
    public function actionCatalog()
    {
        $page = (new Request())->getParams()['page'] ?? 0;
        if($page === 0) {
            $from = 0;
            $to = 5;
        } else {
            $from = $page * 5;
            $to = 5;
        }
        $catalog = (new ProductRepository())->getLimit($from, $to);
        echo $this->render('catalog', [
            'catalog' => $catalog,
            'page' => ++$page
        ]);
    }

    public function actionCard()
    {
        /**
         * @var integer $id
         */
        $id = (new Request())->getParams()['id'];

        $good = (new ProductRepository())->getOne($id);
        echo $this->render('card', [
            'good' => $good
        ]);
    }
}