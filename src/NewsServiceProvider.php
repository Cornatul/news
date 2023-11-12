<?php

namespace Cornatul\News;

use Cornatul\News\Clients\GoogleClient;
use Cornatul\News\Clients\NewsApiClient;
use Cornatul\News\Clients\NineGangClient;
use Cornatul\News\Clients\RedditClient;
use Cornatul\News\Clients\TrendingClient;
use Cornatul\News\Clients\TwitterClient;
use Cornatul\News\Commands\RedditHotCommand;
use Cornatul\News\Interfaces\GoogleInterface;
use Cornatul\News\Interfaces\NineGangInterface;
use Cornatul\News\Interfaces\RedditInterface;
use Cornatul\News\Interfaces\TrendingInterface;
use Cornatul\News\Interfaces\TwitterInterface;
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

    }

    final public function register(): void
    {
        $this->app->bind(ClientInterface::class, Client::class);
        $this->app->bind(TrendingInterface::class, TrendingClient::class);
        //commands

    }
}
