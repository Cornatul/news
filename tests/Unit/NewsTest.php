<?php

namespace Cornatul\News\Tests\Unit;

use App\Models\User;
use Cornatul\Feeds\Clients\FeedlyClient;
use Cornatul\Feeds\DTO\FeedDto;
use Cornatul\Feeds\Repositories\Contracts\ArticleRepositoryInterface;
use Cornatul\Feeds\Contracts\FeedFinderInterface;
use Cornatul\Feeds\Models\Article;
use Cornatul\Feeds\Models\Feed;
use Cornatul\Feeds\Repositories\Contracts\FeedRepositoryInterface;
use Cornatul\News\DTO\NewsDTO;
use Cornatul\News\Interfaces\NewsInterface;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Mockery;


class NewsTest extends \Cornatul\News\Tests\TestCase
{


    public function test_news_headlines(): void
    {
        //generate a test for the news interface

        $news = Mockery::mock()->makePartial('Cornatul\News\Interfaces\NewsInterface');

        $news->expects('headlines')->andReturns(new NewsDTO());

        $this->assertInstanceOf(NewsDTO::class, $news->headlines('business'));
    }

    public function test_can_get_all_news():void
    {
        $news = Mockery::mock()->makePartial('Cornatul\News\Interfaces\NewsInterface');
        $news->expects('allNews')->andReturns(new NewsDTO());
        $this->assertInstanceOf(NewsDTO::class, $news->allNews('business'));
    }


    public function test_can_get_keywords()
    {
        $news = Mockery::mock()->makePartial('Cornatul\News\Interfaces\TrendingInterface');
        $news->expects('getTrendingKeywords')
            ->times(3)
            ->andReturn(new Collection([1,2,3,4,5]));
        $this->assertInstanceOf(Collection::class, $news->getTrendingKeywords());
        //implement even a check for the collection to be of length 5
        $this->assertCount(5, $news->getTrendingKeywords());
        $this->assertContains(1, $news->getTrendingKeywords());

    }


    public function test_can_get_google_news()
    {
        $news = Mockery::mock()->makePartial('Cornatul\News\Interfaces\TrendingInterface');

        $news->expects('find')
            ->with('business')
            ->times(3)
            ->andReturns(new Collection([
                "keyword" => "business",
                "response" => []
            ]));
        $this->assertInstanceOf(Collection::class, $news->find('business'));
        $this->assertContains('business', $news->find('business'));
        $this->assertArrayHasKey('keyword', $news->find('business')->toArray());

    }

}
