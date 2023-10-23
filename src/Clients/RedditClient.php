<?php

namespace Cornatul\News\Clients;

use Cornatul\Feeds\Connectors\NlpConnector;
use Cornatul\Feeds\DTO\ArticleDto;
use Cornatul\Feeds\Requests\GetArticleRequest;
use Cornatul\News\Collections\RedditHotCollection;
use Cornatul\News\Connectors\GoogleNewsConnector;
use Cornatul\News\Connectors\NewsApiConnector;
use Cornatul\News\Connectors\RedditConnector;
use Cornatul\News\DTO\NewsArticleDto;
use Cornatul\News\DTO\NewsDTO;
use Cornatul\News\Interfaces\NewsInterface;
use Cornatul\News\Interfaces\RedditInterface;
use Cornatul\News\Requests\AllNewsRequest;
use Cornatul\News\Requests\GoogleNewsRequest;
use Cornatul\News\Requests\HeadlinesRequest;
use Cornatul\News\Requests\RedditRequest;
use Illuminate\Support\Collection;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;

class RedditClient implements RedditInterface
{
    public final function getHot(): RedditHotCollection
    {
        $connection = new RedditConnector();

        $response = $connection->send(
            new RedditRequest()
        );

        if($response->status() !== 200){
            throw new \Exception("Reddit API returned a non 200 response");
        }

        $xml = simplexml_load_string($response->body(), "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);

        return new RedditHotCollection($array['entry']);
    }
}
