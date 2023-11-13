<?php

namespace Cornatul\News\Clients;


use Cornatul\News\Connectors\NLPConnector;
use Cornatul\News\Connectors\NewsApiConnector;
use Cornatul\News\DTO\NewsArticleDto;
use Cornatul\News\DTO\NewsDTO;
use Cornatul\News\Interfaces\NewsInterface;
use Cornatul\News\Interfaces\TrendingInterface;
use Cornatul\News\Requests\AllNewsRequest;
use Cornatul\News\Requests\GoogleNewsRequest;
use Cornatul\News\Requests\GoogleTrendingRequest;
use Cornatul\News\Requests\HeadlinesRequest;
use Cornatul\News\Requests\TrendingKeywordsRequest;
use Cornatul\News\Requests\TrendingNewsRequest;

final class GoogleClient implements NewsInterface
{
    /**
     * @method getNews
     */
    public final function getNews(string $topic, string $language = "en_gb"): \Illuminate\Support\Collection
    {
        $news = collect();
        $connection = new NLPConnector();
        $response = $connection->send(
            new GoogleNewsRequest(
                $topic,
                $language
            )
        );
        if($response->status() !== 200){
            throw new \RuntimeException("Google News API returned a non {$response->status()} response");
        }
        $content = $response->collect('data')->get('response');
        foreach ($content as $article)
        {
            $data = [
                "title" => $article->title,
                "author" => $article->media,
                "link" => $article->link,
                "content" => $article->desc,
                "image" => $article->img,
                "publishedAt" => $article->datetime,
            ];
            $dto = NewsDTO::from($data);
            $news->push($dto);
        }
        return $news;
    }

}
