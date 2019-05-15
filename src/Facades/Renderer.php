<?php

namespace TaylorNetwork\RowColRenderer\Facades;

use Illuminate\Support\Facades\Facade;

class Renderer extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Renderer';
    }

}