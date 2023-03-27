<?php

namespace Cornatul\News\Tests;
use Cornatul\News\NewsServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
class TestCase extends OrchestraTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    final protected function getPackageProviders($app)
    {
        return [
            NewsServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}
