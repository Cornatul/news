<?php

namespace Cornatul\News\Clients;

use Cornatul\News\Connectors\NewsApiConnector;
use Cornatul\News\DTO\NewsDTO;
use Cornatul\News\Interfaces\NewsInterface;
use Cornatul\News\Requests\AllNewsRequest;
use Cornatul\News\Requests\TopHeadlinesRequest;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;

class NewsApiClient implements NewsInterface
{

    /**
     * @method find
     */
    public function allNews(string $topic): NewsDTO
    {
        $dataArray = [];

        try {

            $newsApiConnector = new NewsApiConnector();

            $response = $newsApiConnector->send(new AllNewsRequest($topic));


            return NewsDTO::from($response->json());

        } catch (GuzzleException|\ReflectionException|InvalidResponseClassException|PendingRequestException $exception) {

            logger($exception->getMessage());
        }

        return NewsDTO::from($dataArray);

    }

    //generate the headlines request
    public function headlines(string $topic): NewsDTO
    {
        $dataArray = [];

        try {

            $newsApiConnector = new NewsApiConnector();

            $response = $newsApiConnector->send(new TopHeadlinesRequest($topic));

            return NewsDTO::from($response->json());

        } catch (GuzzleException|\ReflectionException|InvalidResponseClassException|PendingRequestException $exception) {

            logger($exception->getMessage());
        }

        return NewsDTO::from($dataArray);

    }
}
