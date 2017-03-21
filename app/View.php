<?php

namespace app;


class View
{
    use MagicTrait;

    protected $data = [];

    public function view($path)
    {
        foreach ($this->data as $key => $value) {
            $$key = $value;
        }

        include $path;
    }

}