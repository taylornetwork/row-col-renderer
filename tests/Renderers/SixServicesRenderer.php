<?php


namespace TaylorNetwork\RowColRenderer\Tests\Renderers;

use Illuminate\Database\Eloquent\Model;
use TaylorNetwork\RowColRenderer\Renderer;
use TaylorNetwork\RowColRenderer\Tests\Models\SixServices;

class SixServicesRenderer extends Renderer
{
    protected $model = SixServices::class;

    public function getView(Model $item): string
    {
        return '{ITEM ' . $item->id . '}';
    }
}