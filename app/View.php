<?php

namespace app;


class View
{
    use MagicTrait;

    public function view($path)
    {
        foreach ($this->data as $key => $value) {
            $$key = $value;
        }

        include $path;
    }

}