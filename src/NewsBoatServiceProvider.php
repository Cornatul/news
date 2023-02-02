<?php

namespace UnixDevil\NewsBoat;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\ServiceProvider;
use UnixDevil\NewsBoat\Client\NewsBoat;
use UnixDevil\NewsBoat\Interfaces\HeadlinesInterface;
use UnixDevil\NewsBoat\Interfaces\NewsInterface;

class NewsBoatServiceProvider extends ServiceProvider
{
    final public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/Config/news-boat.php' => config_path('news-boat.php'),
        ]);
    }

    final public function register(): void
    {
        $this->app->bind(ClientInterface::class, Client::class);
        $this->app->bind(NewsInterface::class, NewsBoat::class);
    }
}
