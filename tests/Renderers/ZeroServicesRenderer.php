<?php


namespace TaylorNetwork\RowColRenderer\Tests\Renderers;


use Illuminate\Database\Eloquent\Model;
use TaylorNetwork\RowColRenderer\Renderer;
use TaylorNetwork\RowColRenderer\Tests\Models\ZeroServices;

class ZeroServicesRenderer extends Renderer
{
    protected $model = ZeroServices::class;

    public function getView(Model $item): string
    {
        return '{ZERO}';
    }
}