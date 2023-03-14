<?php

namespace Cornatul\News\Requests;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Saloon\CachePlugin\Contracts\Cacheable;
use Saloon\CachePlugin\Traits\HasCaching;
use Saloon\Http\Request;
use Saloon\Enums\Method;
use Saloon\CachePlugin\Contracts\Driver;
use Saloon\CachePlugin\Drivers\LaravelCacheDriver;
class TopHeadlinesRequest extends Request implements Cacheable
{

    use HasCaching;

    protected Method $method = Method::GET;

    /**
     * @param string $category
     * @values 'business', 'entertainment', 'general', 'health', 'science', 'sports', 'technology'
     */
    public function __construct(
        protected string $category,
    ){}

    public function resolveEndpoint(): string
    {
        return '/top-headlines';
    }

    protected function defaultQuery(): array
    {
        return [
            'category' => $this->category,
            'country' => 'gb',
            'apiKey' => 'c29a123962034057aac547e7321be062',
        ];
    }

    public function resolveCacheDriver(): Driver
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
