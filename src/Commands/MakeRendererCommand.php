<?php


namespace TaylorNetwork\RowColRenderer\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeRendererCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:renderer {name}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a model renderer';

    protected function getStub()
    {
        return __DIR__ . '/stubs/renderer.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return config('row_col_renderer.namespace', 'App\\Rendererers');
    }

    protected function getNameInput()
    {
        return parent::getNameInput() . 'Renderer';
    }


}