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
        $this->loadRoutesFrom(__DIR__.'/../routes/news.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'news');
        $this->publishes([
            __DIR__ . '/Config/news.php' => config_path('news.php'),
        ]);
    }

    final public function register(): void
    {
        $this->app->bind(ClientInterface::class, Client::class);
        $this->app->bind(NewsInterface::class, NewsApiClient::class);
    }
}
