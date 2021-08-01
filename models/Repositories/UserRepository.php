<?php
namespace app\models\Repositories;

use app\engine\Session;
use app\models\entities\User;
use app\models\Repository;



class UserRepository extends Repository
{

    public function auth($login, $pass) {
        $user = $this->getOneWhereObject('login', $login); //понятно почему? Мы уже в UserRepository же!
        if (password_verify($pass, $user->pass)) {
            (new Session())->setParam('login', $login);
            return true;
        }
        return true;
    }

    public function isAuth() {
        $session = (new Session())->getParams()['login'] ?? null;
        return is_string($session);
    }

    public function isAdmin() {
        if(isset($_SESSION['login']) && $_SESSION['login'] == 'admin') {
            return true;
        } else {
            return false;
        }
//        return $_SESSION['login'] == 'admin' ?? false;
    }

    protected function getEntityClass()
    {
        return User::class;
    }

    protected function getTableName()
    {
        return 'users';
    }

    public function getName() {
        return (new Session())->getParams()['login'] ?? null;

    }


}