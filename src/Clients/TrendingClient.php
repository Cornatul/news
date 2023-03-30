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
use Cornatul\Social\DTO\TwitterTrendingDTO;
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
        try{

            $newsApiConnector = new TrendingNewsConnector();

            $response = $newsApiConnector->send(new TrendingNewsRequest($topic));

            $response = $response->getPsrResponse()->getBody()->getContents();

            $response = json_decode($response, true, 512, JSON_THROW_ON_ERROR);



            return collect($response["data"]['response']);

        }catch (\Exception $exception) {

            logger()->error($exception->getMessage());

            return collect([]);

        }

    }

    /**
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws PendingRequestException
     * @throws \JsonException
     */
    public function getNewsTrendingKeywords(): Collection
    {

        $newsApiConnector = new TrendingKeywordsConnector();

        $response = $newsApiConnector->send(new TrendingKeywordsRequest());

        $response = $response->getPsrResponse()->getBody()->getContents();

        $response = json_decode($response, true, 512, JSON_THROW_ON_ERROR);

        $response = collect($response["data"]);

        return collect($response->get("newspaper"));
    }

    /**
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws PendingRequestException
     * @throws \JsonException
     */
    public function getGGoogleTrendingKeywords(): Collection
    {
        $newsApiConnector = new TrendingKeywordsConnector();

        $response = $newsApiConnector->send(new TrendingKeywordsRequest());

        $response = json_decode($response, true, 512, JSON_THROW_ON_ERROR);

        $response = collect($response["data"]);

        return collect($response->get("google"));
    }

    /**
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws PendingRequestException
     * @throws \JsonException
     */
    public function getTwitterTrendingKeywords(): Collection
    {
        $newsApiConnector = new TrendingKeywordsConnector();

        $response = $newsApiConnector->send(new TrendingKeywordsRequest());

        $response = json_decode($response, true, 512, JSON_THROW_ON_ERROR);

        $response = collect($response["data"]["twitter"]);

        return collect($response->first()["trends"])->each(function ($item) {
           return TwitterTrendingDTO::from($item);
        });
    }


}
