<?php

namespace UnixDevil\NewsBoat\Tests;
use UnixDevil\NewsBoat\NewsBoatServiceProvider;
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
            NewsBoatServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}
