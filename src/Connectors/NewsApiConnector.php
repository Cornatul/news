<?php

namespace Cornatul\News\Connectors;

use Saloon\Http\Connector;

class NewsApiConnector extends Connector
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
            'apiKey' => 'c29a123962034057aac547e7321be062',
            'sortBy' => 'publishedAt',
        ];
    }
}
