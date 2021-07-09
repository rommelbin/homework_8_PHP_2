<?php


namespace app\controllers;


use app\models\entities\{BasketProduct};
use app\engine\{Request, Session};
use app\models\Repositories\BasketProductRepository;

class BasketController extends Controller
{
    public function actionShow()
    {
        $session = new Session();
        $basket = (new BasketProductRepository())->getBasket($session->getSessionId());
        echo $this->render('basket', ['basket' => $basket]);
    }


    public function actionAdd() {

        $id = (new Request())->getParams()['id'];
        $session_id = (new Session())->getSessionId();
        $basket = new BasketProduct($id, $session_id, 1);
        (new BasketProductRepository())->save($basket);
        $response = [
            'success' => 'ok',
            'count' => ((new BasketProductRepository())->getCountWhere('session_id', session_id()))
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }
    public function actionDelete() {
        $error = "ok";
        $id = (new Request())->getParams()['id'];
        $session_id = (new Session())->getSessionId();
        /** @var BasketProduct $basket */
        $basket = (new BasketProductRepository())->getOne($id);
        if ($session_id == $basket->session_id) {
            (new BasketProductRepository())->delete($basket);
        } else {
            $error = 'error';
        }
        $response = [
            'success' => $error,
            'count' => ((new BasketProductRepository())->getCountWhere('session_id', session_id()))
        ];
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}