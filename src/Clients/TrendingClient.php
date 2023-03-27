<?php

namespace Cornatul\News\Clients;

use Cornatul\Feeds\Connectors\NlpConnector;
use Cornatul\Feeds\DTO\ArticleDto;
use Cornatul\Feeds\Requests\GetArticleRequest;
use Cornatul\News\Connectors\NewsApiConnector;
use Cornatul\News\Connectors\TrendingKeywordsConnector;
use Cornatul\News\DTO\NewsArticleDto;
use Cornatul\News\DTO\NewsDTO;
use Cornatul\News\Interfaces\NewsInterface;
use Cornatul\News\Interfaces\TrendingInterface;
use Cornatul\News\Requests\AllNewsRequest;
use Cornatul\News\Requests\HeadlinesRequest;
use Cornatul\News\Requests\TrendingKeywordsRequest;
use Illuminate\Support\Collection;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;

class TrendingClient implements TrendingInterface
{
    public function find(string $topic): Collection
    {
//        TrendingKeywordsConnector

        return collect();
    }

    /**
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws PendingRequestException
     */
    public function getTrendingKeywords(): Collection
    {
        $newsApiConnector = new TrendingKeywordsConnector();

        $response = $newsApiConnector->send(new TrendingKeywordsRequest());

        $response->collect('data')->each(function ($keyword) use (&$dataArray) {
            $dataArray[] = $keyword;
        });

        return collect($dataArray);
    }
}
