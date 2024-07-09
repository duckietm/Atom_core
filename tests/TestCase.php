<?php

namespace Atom\Core\Tests;

use Atom\Core\CoreServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    /**
     * Load package service provider.
     */
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Atom\\Core\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    /**
     * Define environment setup.
     */
    protected function getPackageProviders($app)
    {
        return [
            CoreServiceProvider::class,
        ];
    }
}
