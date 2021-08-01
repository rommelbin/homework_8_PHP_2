<?php

namespace app\models\entities;
use app\models\Model;

class Order extends Model
{
    protected $id;
    protected $session_id;
    protected $status;
    protected $num;
    protected $created_at;
    protected $updated_at;
    protected $email;
    protected $props = [
        'id' =>false,
        'session_id' => false,
        'status' => false,
        'num' => false,
        'created_at' => false,
        'updated_at' => false,
        'email' => false
    ];

    public function __construct($session_id = null, $status = null, $num = null ,$email = null, $created_at = null, $updated_at = null )
    {
        $this->session_id = $session_id;
        $this->status = $status;
        $this->num = $num;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->email = $email;
    }

}