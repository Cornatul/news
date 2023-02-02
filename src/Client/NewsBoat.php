<?php

namespace UnixDevil\NewsBoat\Client;

use GuzzleHttp\ClientInterface;
use JsonException;
use UnixDevil\NewsBoat\Interfaces\AllNewsInterface;
use UnixDevil\NewsBoat\Interfaces\HeadlinesInterface;
use UnixDevil\NewsBoat\Interfaces\NewsConfigInterface;
use UnixDevil\NewsBoat\Interfaces\NewsInterface;
use UnixDevil\NewsBoat\Interfaces\TrendingTermsInterface;
use UnixDevil\NewsBoat\Manager\NewsConfig;


class NewsBoat implements NewsInterface
{
    private ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function getNews(string $category , string $country): array
    {
        try {
            $response = $this->client->get(NewsConfig::getNewsEndpoint() . "&category={$category}&country={$country}");
            return json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);
        }catch (JsonException $exception){
            return [];
        }
    }


    /**
     * @throws JsonException
     */
    public function getTrendingTerms(): array
    {
        try{

            $response = $this->client->get(NewsConfig::getTrendingTermsEndpoint());
            return json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);

        }catch (\Exception $e){
            return [];
        }
    }

    public function searchNews(string $query): array
    {
        // TODO: Implement searchNews() method.
        // TODO: Implement Search News Endpoint
        return [];
    }


}
