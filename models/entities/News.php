<?php


namespace app\models\entities;
use app\models\Model;

class News extends Model
{

    protected $id;
    protected $title;
    protected $text;
    protected $props = [
        'title' => false,
        'text' => false,
    ];
    public function __construct($title = null, $text = null)
    {
        $this->title = $title;
        $this->text = $text;
    }
}