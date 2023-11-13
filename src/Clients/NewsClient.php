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

final class NewsClient implements NewsInterface
{
    /**
     * @method getNews
     */
    public final function getNews(string $topic, string $language = "en"): Collection
    {
        $dataArray = collect();
        $newsApiConnector = new NewsApiConnector();
        $response = $newsApiConnector->send(new AllNewsRequest($topic));
        if($response->status() !== 200){
            throw new \RuntimeException("News API returned a non {$response->status()} response");
        }
        $response->collect('articles')->each(function ($article) use (&$dataArray) {
            $array = [
                "title" => $article['title'],
                "author" => $article['author'] ?? "",
                "link" => $article['url'],
                "content" => "",
                "image" => "",
                "publishedAt" => $article['publishedAt'],
            ];
            $dto = NewsDTO::from($array);
            $dataArray->push($dto);
        });
        return $dataArray;
    }

}
