<?php

namespace Cornatul\News\Tests\Unit;

use App\Models\User;
use Cornatul\Feeds\Clients\FeedlyClient;
use Cornatul\Feeds\DTO\FeedDto;
use Cornatul\Feeds\Repositories\Interfaces\ArticleRepositoryInterface;
use Cornatul\Feeds\Interfaces\FeedFinderInterface;
use Cornatul\Feeds\Models\Article;
use Cornatul\Feeds\Models\Feed;
use Cornatul\Feeds\Repositories\Interfaces\FeedRepositoryInterface;
use Cornatul\News\DTO\NewsDTO;
use Cornatul\News\Interfaces\NewsInterface;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
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

}
