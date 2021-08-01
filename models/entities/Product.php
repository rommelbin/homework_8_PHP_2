<?php

namespace app\models\entities;

use app\models\Model;

class Product extends Model
{
    protected $id;
    protected $name;
    protected $description;
    protected $price;
    protected $consistOf;
    protected $manufacturer;

    protected $props = [
        'name' => false,
        'description' => false,
        'price' => false,
        'consistOf' => false,
        'manufacturer' => false
    ];

    public function __construct($name = null, $description = null, $price = null, $consistOf = null, $manufacturer = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->consistOf = $consistOf;
        $this->manufacturer = $manufacturer;
    }

}


