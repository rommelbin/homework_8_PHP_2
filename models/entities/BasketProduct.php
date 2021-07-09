<?php


namespace app\models\entities;
use app\models\Model;

class BasketProduct extends Model
{
    protected $id;
    protected $item_id;
    protected $session_id;
    protected $quantity;
    protected $props = [
        'item_id' => false,
        'session_id' => false,
        'quantity' => false
    ];
    public function __construct($item_id = null, $session_id = null, $quantity = null)
    {
        $this->item_id = $item_id;
        $this->session_id = $session_id;
        $this->quantity = $quantity;
    }




}