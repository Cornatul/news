<?php

namespace Cornatul\News\Connectors;

use Illuminate\Support\Facades\Config;
use Saloon\Http\Connector;

class RedditConnector extends Connector
{
    public function resolveBaseUrl(): string
    {
        return "https://www.reddit.com" ?? "";
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/xml',
            'Accept' => 'application/xml',
        ];
    }

}
