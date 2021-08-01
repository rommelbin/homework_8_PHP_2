<?php


namespace app\controllers;

use app\engine\Request;
use app\engine\Session;
use app\models\entities\User;
use app\models\Repositories\UserRepository;

class AuthController extends Controller
{

    public function actionLogin()
    {
        $request = new Request();
        /** @var string $login
         * @var string $password
         * @var string $save
         */
        $login = $request->getParams()['login'];
        $password = $request->getParams()['password'];
        $save = $request->getParams()['save'];
        if ((new UserRepository())->auth($login, $password)) {
            if (isset($save)) {
                $user = (new UserRepository())->getOneWhereObject('login', $login);
                $user->hash = uniqid(rand(), true);
                setcookie('hash', $user->hash, time() + 3600, '/');
                (new UserRepository())->save($user);
            }
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die;
        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die;
        }
    }

    public function actionLogout()
    {
        setcookie('hash', '', time() - 3600, '/');
        (new Session())->regenerateSession();
        (new Session())->destroySession();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        die;
    }

    public function actionIndex()
    {
        echo $this->render('index');
    }
}