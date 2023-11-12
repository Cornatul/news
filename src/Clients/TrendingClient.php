<?php

namespace Cornatul\News\Clients;

use Cornatul\Feeds\Connectors\NlpConnector;
use Cornatul\Feeds\DTO\ArticleDto;
use Cornatul\Feeds\Requests\GetArticleRequest;
use Cornatul\News\Collections\RedditHotCollection;
use Cornatul\News\Connectors\NewsApiConnector;
use Cornatul\News\Connectors\RedditConnector;
use Cornatul\News\Connectors\TrendingKeywordsConnector;
use Cornatul\News\Connectors\TrendingNewsConnector;
use Cornatul\News\Connectors\TwitterTrendsConnector;
use Cornatul\News\DTO\NewsArticleDto;
use Cornatul\News\DTO\NewsDTO;
use Cornatul\News\Interfaces\NewsInterface;
use Cornatul\News\Interfaces\TrendingInterface;
use Cornatul\News\Requests\AllNewsRequest;
use Cornatul\News\Requests\HeadlinesRequest;
use Cornatul\News\Requests\RedditRequest;
use Cornatul\News\Requests\TrendingKeywordsRequest;
use Cornatul\News\Requests\TrendingNewsRequest;
use Cornatul\News\Requests\TwitterTrendsRequest;
use Cornatul\Social\DTO\TwitterTrendingDTO;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Symfony\Component\DomCrawler\Crawler;

class TrendingClient implements TrendingInterface
{

    private array $structure = [
        'title',
        'content',
        'link',
    ];
    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
    }

    /**
     * @throws \Exception
     */
    public function getTrends(): Collection
    {
        //@todo add here the newspapers , google trends and other sources
        return new Collection([
            'reddit' => $this->getRedditTrends(),
            'twitter' => $this->getTwitterTrends(),
        ]);
    }



    private function getRedditTrends(): Collection
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
        $response = collect();
        foreach ($array['entry'] as $item) {
            $response->push([
                'title' => $item['title'],
                'content' => $item['content'],
                'link' => $item['link']['@attributes']['href'],
            ]);
        }

        return ($response);
    }


    private function getTwitterTrends(): Collection
    {
        $connector = new TwitterTrendsConnector();
        $request = $connector->send(new TwitterTrendsRequest());
        $content  = ($request->body());
        $crawler = new Crawler($content);
        $trends = $crawler->filter('.trend-card__list li a')
            ->each(function (Crawler $node) {
            return [
                 'title' => $node->text(),
                 'url' => $node->attr('href'),
                 'content' => $node->text(),
            ];
        });

        return collect($trends);
    }
}
