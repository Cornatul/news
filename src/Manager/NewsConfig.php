<?php

namespace UnixDevil\NewsBoat\Manager;
use Illuminate\Support\Facades\Config;
class NewsConfig
{
    public static function getNewsEndpoint(): string
    {
        return Config::get('news-boat.news-endpoint');
    }

    public static function getTrendingTermsEndpoint(): string
    {
        return Config::get('news-boat.trending-terms-endpoint');
    }

}
