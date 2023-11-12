<?php

namespace Cornatul\News\Connectors;

use Illuminate\Support\Facades\Config;
use Saloon\Http\Connector;

class TwitterTrendsConnector extends Connector
{
    public function resolveBaseUrl(): string
    {
        return "https://trends24.in/" ?? "";
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/xhtml+xml',
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
        ];
    }

}
