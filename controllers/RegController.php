<?php


namespace app\controllers;
use app\engine\Request;
use app\models\Repositories\UserRepository;
use app\models\entities\User;
class RegController extends Controller
{
    public function actionRegistr()
    {
        /**
         * @var string $login
         * @var string $password
         * @var string $password2
         * @var string $email
         */
        extract((new Request())->getParams());
//        if ((new UserRepository())->checkLogin($login)) {
//            // TODO make an error message to render in the page.
//        } else {
            if ($password === $password2) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $user = new User($login, $hash, $email);
                (new UserRepository())->save($user);
                header('Location: /');
                die;
//            }
        }
    }
    public function actionRegPage()
    {
        $this->layout = 'authLayout';
        echo $this->render('regPage', []);
    }
}