<?php

namespace Cornatul\News\Clients;

use Cornatul\Feeds\Connectors\NlpConnector;
use Cornatul\Feeds\DTO\ArticleDto;
use Cornatul\Feeds\Requests\GetArticleRequest;
use Cornatul\News\Connectors\NewsApiConnector;
use Cornatul\News\DTO\NewsArticleDto;
use Cornatul\News\DTO\NewsDTO;
use Cornatul\News\Interfaces\NewsInterface;
use Cornatul\News\Requests\AllNewsRequest;
use Cornatul\News\Requests\HeadlinesRequest;
use Illuminate\Support\Collection;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;

class NewsApiClient implements NewsInterface
{

    /**
     * @method find
     */
    public function allNews(string $topic): Collection
    {
        $dataArray = [];

        try {

            $newsApiConnector = new NewsApiConnector();

            $response = $newsApiConnector->send(new AllNewsRequest($topic));

            $response->collect('articles')->each(function ($article) use (&$dataArray) {
                $dataArray[] = NewsDTO::from($article);
            });

            return collect($dataArray);

        } catch (GuzzleException|\ReflectionException|InvalidResponseClassException|PendingRequestException $exception) {

            logger($exception->getMessage());
        }

        return collect(NewsDTO::from($dataArray));

    }

    //generate the headlines request
    public function headlines(string $topic): Collection
    {
        $dataArray = [];

        try {

            $newsApiConnector = new NewsApiConnector();

            $response = $newsApiConnector->send(new HeadlinesRequest($topic));

            $response->collect('articles')->each(function ($article) use (&$dataArray) {
                $dataArray[] = NewsDTO::from($article);
            });


            return collect($dataArray);

        } catch (GuzzleException|\ReflectionException|InvalidResponseClassException|PendingRequestException $exception) {

            logger($exception->getMessage());

        }

        return collect(NewsDTO::from($dataArray));

    }


    /**
     * @throws \ReflectionException
     * @throws InvalidResponseClassException
     * @throws PendingRequestException
     */
    public function extractArticle(string $encodedUrl):NewsArticleDto
    {
        $url = base64_decode($encodedUrl);

        $connector = new NlpConnector();

        $response = collect($connector->send(new GetArticleRequest($url))->collect());

        $response->put('data', collect($response->get('data'))->put('id',$url));

        return  NewsArticleDto::from($response->get('data'));

    }
}
