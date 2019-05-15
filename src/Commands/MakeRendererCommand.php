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

    protected $type = 'Model renderer';

    protected $modelName;

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
        $this->modelName = parent::getNameInput();
        return $this->modelName . 'Renderer';
    }

    protected function replaceClass($stub, $name)
    {
        $name = last(explode('\\', $name));
        return parent::replaceClass($stub, $name);
    }

    protected function buildClass($name)
    {
        $stub = parent::buildClass($name);

        return $this->replaceModel($stub, $name);
    }

    protected function replaceModel($stub, $name)
    {
        return str_replace('DummyModel', config('row_col_renderer.models_namespace', '\\App\\') . $this->modelName, $stub);
    }
}