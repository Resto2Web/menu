<?php

namespace Resto2web\Menu\Tests;

use Orchestra\Testbench\TestCase;
use Resto2web\Menu\MenuServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [MenuServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
