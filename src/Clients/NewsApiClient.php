<?php

namespace Cornatul\News\Clients;

use Cornatul\News\Connectors\NewsApiConnector;
use Cornatul\News\Interfaces\NewsInterface;
use Cornatul\News\Requests\AllNewsRequests;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;

class NewsApiClient implements NewsInterface
{

    /**
     * @method find
     */
    public function find(string $topic): NewsDTO
    {
        $dataArray = [];

        try {

            $newsApiConnector = new NewsApiConnector();

            $response = $newsApiConnector->send(new AllNewsRequests($topic));

            return NewsDTO::from($response->json());

        } catch (GuzzleException|\ReflectionException|InvalidResponseClassException|PendingRequestException $exception) {

            logger($exception->getMessage());
        }

        return NewsDTO::from($dataArray);

    }
}
