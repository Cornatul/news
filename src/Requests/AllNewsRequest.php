<?php

namespace Cornatul\News\Requests;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Saloon\CachePlugin\Contracts\Cacheable;
use Saloon\CachePlugin\Traits\HasCaching;
use Saloon\Http\Request;
use Saloon\CachePlugin\Drivers\LaravelCacheDriver;
use Saloon\Enums\Method;

class AllNewsRequest extends Request implements Cacheable
{

    use HasCaching;

    protected Method $method = Method::GET;

    public function __construct(
        protected string $topic,
    ){}

    public function resolveEndpoint(): string
    {
        return '/everything';
    }

    protected function defaultQuery(): array
    {
        return [
            'q' => $this->topic,
            'sortBy' => 'publishedAt',
            'apiKey' => config('news.news-api-key'),
            'language' => 'en',
            'from' => Carbon::now()->subDays(1)->format('Y-m-d'),
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
        return [Method::GET];
    }
}
