<?php


namespace app\controllers;


use app\models\Repositories\BasketProductRepository;
use app\models\Repositories\OrderRepository;
use app\engine\{Session, Request};
use app\models\entities\Order;
class OrderController extends Controller
{
    public function actionMake() {
        $session_id = (new Session())->getSessionId();
        $params = (new Request())->getParams();
        $order = new Order($session_id,'check', $params['num'], $params['email']);
        (new OrderRepository())->save($order);
        (new Session())->regenerateSession();
        echo $this->render('orderReady', []);
    }
    public function actionAdminPage() {
        $orders = (new OrderRepository())->getOrders();
        echo $this->render('orderList', ['orders' => $orders]);
    }
    public function actionAbout() {
        $session_order_id = (new Request())->getParams()['session_id'];
        $order_id = (new Request())->getParams()['id'];
        $order_contains = (new BasketProductRepository())->getBasket($session_order_id);
        $order = (new OrderRepository())->getOne($order_id);
        $order_id = $order->id;
        $order_status = $order->status;
        echo $this->render('orderOne', [
            'order' => $order_contains,
            'order_id' => $order_id,
            'order_status' =>$order_status
        ]);
    }
    public function actionChangeStatus() {
        $order_id = (new Request())->getParams()['order_id'];
        $status = (new Request())->getParams()['status'];
        $order = (new OrderRepository())->getOneWhereObject('id', $order_id);
        $order->status = $status;
        (new OrderRepository())->save($order);
        header('Location: /Order/AdminPage');
    }
}