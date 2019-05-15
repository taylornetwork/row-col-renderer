<?php

namespace TaylorNetwork\RowColRenderer\Tests\Renderers;

use Illuminate\Database\Eloquent\Model;
use TaylorNetwork\RowColRenderer\Renderer;
use TaylorNetwork\RowColRenderer\Tests\Models\EightServices;

class EightServicesRenderer extends Renderer
{
    protected $model = EightServices::class;

    public function getView(Model $item): string
    {
        return '{ID ' . $item->id . '}';
    }
}