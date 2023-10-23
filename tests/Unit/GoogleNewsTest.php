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


class GoogleNewsTest extends \Cornatul\News\Tests\TestCase
{


    public function test_can_get_news(): void
    {
        //generate a test for the news interface

        $news = Mockery::mock()->makePartial('Cornatul\News\Interfaces\GoogleInterface');

        $news->expects('getNews')->andReturns(new Collection());

        $this->assertInstanceOf(Collection::class, $news->getNews('business'));
    }

}
