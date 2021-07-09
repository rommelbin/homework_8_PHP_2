<?php

session_start();
use  app\models\{Product, User};
use app\engine\{Render, twigRender, Request, logException};
use  app\controllers\ProductController;

include '../vendor/autoload.php';
include "../config/config.php";

try {
    /** @var Product $product */
    /** @var User $user */


    $request = new Request();


    $controllerName = $request->getControllerName() ?: 'product';
    $actionName = $request->getActionName();

    $controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";
    /** @var $controller ProductController */
    if (class_exists($controllerClass)) {
        $controller = new $controllerClass(new Render());
        $controller->runAction($actionName);
    } else {
        echo "404";
    }
} catch (\PDOException $e) {
    logException::logError($e);
}



die();
