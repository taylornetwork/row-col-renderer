<?php


namespace TaylorNetwork\RowColRenderer\Tests;

use Orchestra\Testbench\TestCase;
use TaylorNetwork\RowColRenderer\RowColServiceProvider;

class CommandTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [RowColServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('row_col_renderer.namespace', 'TaylorNetwork\\RowColRenderer\\Tests\\Renderers\\');
        $app['config']->set('row_col_renderer.max_per_row', 4);
    }
}