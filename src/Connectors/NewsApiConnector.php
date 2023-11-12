<?php

namespace Cornatul\News\Connectors;

use Illuminate\Support\Facades\Config;
use Saloon\Http\Connector;

class  NewsApiConnector extends Connector
{
    public function resolveBaseUrl(): string
    {
        return 'https://newsapi.org/v2/';
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    protected function defaultQuery(): array
    {
        return [
            'apiKey' => config('news.news-api-key'),
            'sortBy' => 'publishedAt',
        ];

    }
}
