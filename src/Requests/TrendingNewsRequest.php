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
use Saloon\CachePlugin\Contracts\Driver;
use Saloon\Traits\Body\HasJsonBody;

class TrendingNewsRequest extends Request implements Cacheable, HasBody
{

    use HasCaching;

    use HasJsonBody;

    protected Method $method = Method::POST;
    public function __construct(
        protected string $keyword,
    ){}



    public function resolveEndpoint(): string
    {
        return '/google-news';
    }

    protected function defaultBody(): array
    {
        return [
            'keyword' => $this->keyword,
            'language' => 'en',
        ];
    }

    public function resolveCacheDriver(): Driver
    {
        return new LaravelCacheDriver(Cache::store('file'));
    }

    public function cacheExpiryInSeconds(): int
    {
        return 10; // One Hour
    }

    protected function getCacheableMethods(): array
    {
        return [Method::GET, Method::POST];
    }
}
