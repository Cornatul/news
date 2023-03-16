<?php

namespace Cornatul\News;

use Cornatul\News\Clients\NewsApiClient;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\ServiceProvider;
use Cornatul\News\Interfaces\NewsInterface;

class NewsServiceProvider extends ServiceProvider
{
    final public function boot(): void
    {

        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/Config/news.php' => config_path('news.php'),
            ], 'news');

        }

        $this->loadRoutesFrom(__DIR__ . '/../routes/news.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'news');


        $this->mergeConfigFrom(
            __DIR__ . '/Config/news.php', 'news'
        );
    }

    final public function register(): void
    {
        $this->app->bind(ClientInterface::class, Client::class);
        $this->app->bind(NewsInterface::class, NewsApiClient::class);
    }
}
