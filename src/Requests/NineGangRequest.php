<?php

namespace Cornatul\News\Requests;

/**
 *
 * @author Stefan aka Cornatul <https://github.com/cornatul>
 * @package Cornatul\News
 * @license MIT
 * @link https://github.com/cornatul/news#
 * @since 1.0.0
 * @version 1.0.2
 * @copyright Copyright (c) 2020, Stefan Corn
 * @todo Rename this to HeadlinesRequest
 */
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Saloon\CachePlugin\Contracts\Cacheable;
use Saloon\CachePlugin\Traits\HasCaching;
use Saloon\Http\Request;
use Saloon\Enums\Method;
use Saloon\CachePlugin\Contracts\Driver;
use Saloon\CachePlugin\Drivers\LaravelCacheDriver;
class NineGangRequest extends Request implements Cacheable
{

    use HasCaching;

    protected Method $method = Method::GET;


    public function resolveEndpoint(): string
    {
        return '/hot';
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
