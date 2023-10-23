<?php

namespace Cornatul\News\Connectors;

use Illuminate\Support\Facades\Config;
use Saloon\Http\Connector;

class TrendingNewsConnector extends Connector
{
    public final function resolveBaseUrl(): string
    {
        return config('news.news-api-url');
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

}
