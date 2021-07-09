<?php


namespace app\models;


 abstract class Model
{
    public function &__get($key)
    {
        return $this->$key;
    }

    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->props[$name] = true;
            $this->$name = $value;
        } else {
            return false;
        }
    }

    public function __isset($name)
    {
        if (isset($this->$name)) {
            return $this->$name;
        } else {
            return false;
        }

    }
}