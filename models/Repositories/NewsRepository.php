<?php
namespace app\models\Repositories;

use app\models\entities\News;
use \app\models\Repository;
use app\engine\Session;

class NewsRepository extends Repository
{

    protected function getEntityClass()
    {
        return News::class;
    }

    protected function getTableName()
    {
        return 'news';
    }
}