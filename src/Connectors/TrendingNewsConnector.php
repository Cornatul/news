<?php

namespace Cornatul\News\Connectors;

use Illuminate\Support\Facades\Config;
use Saloon\Http\Connector;

class TrendingNewsConnector extends Connector
{
    public function resolveBaseUrl(): string
    {
        return 'https:/v1.nlpapi.org/';
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
        ];

    }
}
