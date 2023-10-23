<?php

namespace Cornatul\News\Requests;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Saloon\CachePlugin\Contracts\Cacheable;
use Saloon\CachePlugin\Traits\HasCaching;
use Saloon\Contracts\Body\HasBody;
use Saloon\Http\Request;
use Saloon\CachePlugin\Drivers\LaravelCacheDriver;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

class GoogleNewsRequest extends Request implements Cacheable, HasBody
{

    use HasCaching;

    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected string $keyword,
        protected string $language = "en_gb"
    ){}

    public function resolveEndpoint(): string
    {
        return '/google-news';
    }

    protected function defaultBody(): array
    {
        return [
            'keyword' => $this->keyword,
            'language' => $this->language,
        ];
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    public function resolveCacheDriver(): LaravelCacheDriver
    {
        return new LaravelCacheDriver(Cache::store('file'));
    }

    public function cacheExpiryInSeconds(): int
    {
        return 3600; // One Hour
    }

    protected function getCacheableMethods(): array
    {
        return [Method::POST];
    }
}
