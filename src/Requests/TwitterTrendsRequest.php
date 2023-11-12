<?php

namespace Cornatul\News\Requests;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Saloon\CachePlugin\Contracts\Cacheable;
use Saloon\CachePlugin\Traits\HasCaching;
use Saloon\Http\Request;
use Saloon\CachePlugin\Drivers\LaravelCacheDriver;
use Saloon\Enums\Method;

class TwitterTrendsRequest extends Request implements Cacheable
{

    use HasCaching;

    protected Method $method = Method::GET;

    public function __construct(protected readonly string $country = "United Kingdom")
    {
    }


    public function resolveEndpoint(): string
    {
        return '/' . Str::slug($this->country);
    }

    protected function defaultQuery(): array
    {
        return [];
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
        return [Method::GET];
    }
}
