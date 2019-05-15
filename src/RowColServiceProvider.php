<?php


namespace TaylorNetwork\RowColRenderer;

use Illuminate\Support\ServiceProvider;
use TaylorNetwork\RowColRenderer\Commands\MakeRendererCommand;

class RowColServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('Renderer', Renderer::class);
        $this->mergeConfigFrom(__DIR__ . '/config/row_col_renderer.php', 'row_col_renderer');
        $this->commands([MakeRendererCommand::class]);
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/row_col_renderer.php' => config_path('row_col_renderer.php')
        ]);
    }
}