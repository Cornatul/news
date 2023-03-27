<?php

namespace Cornatul\News\Clients;

use Cornatul\Feeds\Connectors\NlpConnector;
use Cornatul\Feeds\DTO\ArticleDto;
use Cornatul\Feeds\Requests\GetArticleRequest;
use Cornatul\News\Connectors\NewsApiConnector;
use Cornatul\News\Connectors\TrendingKeywordsConnector;
use Cornatul\News\Connectors\TrendingNewsConnector;
use Cornatul\News\DTO\NewsArticleDto;
use Cornatul\News\DTO\NewsDTO;
use Cornatul\News\Interfaces\NewsInterface;
use Cornatul\News\Interfaces\TrendingInterface;
use Cornatul\News\Requests\AllNewsRequest;
use Cornatul\News\Requests\HeadlinesRequest;
use Cornatul\News\Requests\TrendingKeywordsRequest;
use Cornatul\News\Requests\TrendingNewsRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;

class TrendingClient implements TrendingInterface
{
    /**
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws PendingRequestException
     */
    public function find(string $topic): Collection
    {

        $key = $topic;

        $data = Cache::get($key);

        if(!$data)
        {
            $newsApiConnector = new TrendingNewsConnector();

            $response = $newsApiConnector->send(new TrendingNewsRequest($topic));

            $data =  collect($response->collect('data')->toArray()["response"]);

            Cache::put($key, $data, $minutes = 60); // cache for 60 minutes

        }

        return $data;
    }

    /**
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws PendingRequestException
     */
    public function getTrendingKeywords(): Collection
    {

        $key = "trendingKeywords";

        $data = Cache::get($key);

        if (!$data){
            $newsApiConnector = new TrendingKeywordsConnector();

            $response = $newsApiConnector->send(new TrendingKeywordsRequest());

            $response->collect('data')->each(function ($keyword) use (&$dataArray) {
                $dataArray[] = $keyword;
            });

            $data =  collect($dataArray);

            Cache::put($key, $data, $minutes = 60); // cache for 60 minutes
        }
        return $data;
    }
}
