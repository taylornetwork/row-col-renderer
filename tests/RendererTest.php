<?php

namespace TaylorNetwork\RowColRenderer\Tests;

use Orchestra\Testbench\TestCase;
use TaylorNetwork\RowColRenderer\Facades\Renderer as RendererFacade;
use TaylorNetwork\RowColRenderer\RowColServiceProvider;

class RendererTest extends TestCase
{
    public function testSixServices()
    {
        // This should result in 2 rows of 3 each
        $renderer = RendererFacade::sixServices();

        $this->assertEquals(2, $renderer->getTotalRows());
        $this->assertEquals(3, $renderer->getNumberPerRow());
        $this->assertEquals(
            '<div class="row text-center">{ITEM 1}{ITEM 2}{ITEM 3}</div><div class="row text-center mb-5">{ITEM 4}{ITEM 5}{ITEM 6}</div>',
            $renderer->render()
        );
    }

    public function testEightServices()
    {
        $renderer = RendererFacade::eightServices();

        $this->assertEquals(2, $renderer->getTotalRows());
        $this->assertEquals(4, $renderer->getNumberPerRow());
        $this->assertEquals(
            '<div class="row text-center">{ID 1}{ID 2}{ID 3}{ID 4}</div><div class="row text-center mb-5">{ID 5}{ID 6}{ID 7}{ID 8}</div>',
            $renderer->render()
        );
    }

    public function testOverrideMaxPerRow()
    {
        $renderer = RendererFacade::fourServices(3);

        $this->assertEquals(2, $renderer->getTotalRows());
        $this->assertEquals(2, $renderer->getNumberPerRow());
        $this->assertEquals(
            '<row class="center">{F 1}{F 2}</row><row class="center">{F 3}{F 4}</row>',
            $renderer->render()
        );
    }

    public function testAlias()
    {
        $renderer = \Renderer::fourServices();

        $this->assertEquals(1, $renderer->getTotalRows());
        $this->assertEquals(4, $renderer->getNumberPerRow());
        $this->assertEquals(
            '<row class="center">{F 1}{F 2}{F 3}{F 4}</row>',
            $renderer->render()
        );
    }

    protected function getPackageProviders($app)
    {
        return [RowColServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return ['Renderer' => RendererFacade::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('row_col_renderer.namespace', 'TaylorNetwork\\RowColRenderer\\Tests\\Renderers\\');
        $app['config']->set('row_col_renderer.max_per_row', 4);
    }
}