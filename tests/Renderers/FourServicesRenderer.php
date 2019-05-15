<?php


namespace TaylorNetwork\RowColRenderer\Tests\Renderers;

use Illuminate\Database\Eloquent\Model;
use TaylorNetwork\RowColRenderer\Renderer;
use TaylorNetwork\RowColRenderer\Tests\Models\FourServices;

class FourServicesRenderer extends Renderer
{
    protected $model = FourServices::class;

    protected $appendOnLastRow = false;

    public function getView(Model $item): string
    {
        return '{F ' . $item->id . '}';
    }

    public function getClasses(): array
    {
        return ['center'];
    }

    public function defineOpenRow(): string
    {
        return '<row class="{row_classes}">';
    }

    public function defineCloseRow(): string
    {
        return '</row>';
    }

}