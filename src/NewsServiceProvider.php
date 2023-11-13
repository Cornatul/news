<?php

namespace Cornatul\News;

use Cornatul\Feeds\Console\ArticleExtractorCommand;
use Cornatul\Feeds\Console\FeedEntriesExtractor;
use Cornatul\News\Clients\GoogleClient;
use Cornatul\News\Clients\NewsClient;
use Cornatul\News\Console\NewsExtractorCommand;
use Cornatul\News\Interfaces\TrendingInterface;
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

        $this->commands([
            NewsExtractorCommand::class
        ]);
    }

    final public function register(): void
    {
        $this->app->bind(ClientInterface::class, Client::class);
        $this->app->bind(TrendingInterface::class, TrendingClient::class);
        //commands


    }
}
