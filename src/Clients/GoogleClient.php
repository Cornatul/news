<?php

namespace Cornatul\News\Clients;

use Cornatul\Feeds\Connectors\NlpConnector;
use Cornatul\Feeds\DTO\ArticleDto;
use Cornatul\Feeds\Requests\GetArticleRequest;
use Cornatul\News\Collections\GoogleNewsCollection;
use Cornatul\News\Connectors\GoogleNewsConnector;
use Cornatul\News\Connectors\NewsApiConnector;
use Cornatul\News\Connectors\TrendingKeywordsConnector;
use Cornatul\News\Connectors\TrendingNewsConnector;
use Cornatul\News\DTO\NewsArticleDto;
use Cornatul\News\DTO\NewsDTO;
use Cornatul\News\Interfaces\GoogleInterface;
use Cornatul\News\Interfaces\NewsInterface;
use Cornatul\News\Interfaces\TrendingInterface;
use Cornatul\News\Requests\AllNewsRequest;
use Cornatul\News\Requests\GoogleNewsRequest;
use Cornatul\News\Requests\GoogleTrendingRequest;
use Cornatul\News\Requests\HeadlinesRequest;
use Cornatul\News\Requests\TrendingKeywordsRequest;
use Cornatul\News\Requests\TrendingNewsRequest;
use Cornatul\Social\DTO\TwitterTrendingDTO;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;

class GoogleClient implements GoogleInterface
{
    /**
     * @method getNews
     * @throws \ReflectionException
     * @throws InvalidResponseClassException
     * @throws PendingRequestException
     * @throws \Exception
     */
    public final function getNews(string $keyword, string $language = "en_gb"):GoogleNewsCollection
    {
        $connection = new GoogleNewsConnector();

        $response = $connection->send(
            new GoogleNewsRequest(
                $keyword,
                $language
            )
        );

        if($response->status() !== 200){
            throw new \Exception("Google News API returned a non {$response->status()} response");
        }
        $content = json_decode($response->body());

        return new GoogleNewsCollection($content->data->response);
    }


    /**
     * @method getTrends
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws PendingRequestException
     * @throws \Exception
     */
    public final function getTrends(): Collection
    {
        $connection = new GoogleNewsConnector();

        $response = $connection->send(
            new GoogleTrendingRequest()
        );

        if($response->status() !== 200){
            throw new \Exception("Google Trends API returned a non 200 response");
        }

        $content = json_decode($response->body());

        return collect($content->data->google);
    }
}
