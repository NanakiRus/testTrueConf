<?php

namespace app;

trait MagicTrait
{
    protected $data = [];

    public function __get($name)
    {
        return $this->data[$name];
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __isset($name)
    {
        return $this->data[$name];
    }

}