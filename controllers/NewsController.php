<?php


namespace app\controllers;

use app\models\Repositories\NewsRepository;
class NewsController extends Controller
{
    public function actionShow()
    {
        $news = (new NewsRepository())->getAll();
        echo $this->render('news', [
           'news' => $news,
            'title' => 'News'
        ]);
    }

    public function actionIndex()
    {
        echo $this->render('index');
    }
}