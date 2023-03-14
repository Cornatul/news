<?php

namespace Cornatul\News\Clients;

class NewsApiClient implements NewsInterface
{

    /**
     * @method find
     */
    public function find(string $topic, string $language = "en"): NewsDTO
    {
        $dataArray = [];

        try {

            $newsApiConnector = new NewsApiConnector();

            $response = $newsApiConnector->send(new NewsApiTopicRequest($topic));

            return NewsDTO::from($response->json());

        } catch (GuzzleException|\ReflectionException|InvalidResponseClassException|PendingRequestException $exception) {

            logger($exception->getMessage());
        }

        return NewsDTO::from($dataArray);

    }
}
