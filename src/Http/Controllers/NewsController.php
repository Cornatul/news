<?php
declare(strict_types=1);
namespace Cornatul\News\Http\Controllers;

use Cornatul\Feeds\Classes\Parser;
use Cornatul\Feeds\DTO\FeedDto;
use Cornatul\Feeds\Contracts\FeedFinderInterface;
use Cornatul\Feeds\Jobs\FeedExtractor;
use Cornatul\Feeds\Jobs\FeedImporter;
use Cornatul\Feeds\Models\Feed;
use Cornatul\News\Interfaces\GoogleInterface;
use Cornatul\News\Interfaces\NewsInterface;
use Cornatul\News\Interfaces\RedditInterface;
use Cornatul\News\Interfaces\TrendingInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\View\View as ViewContract;
use imelgrat\OPML_Parser\OPML_Parser;
class NewsController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected NewsInterface $news;

    protected GoogleInterface $google;

    protected RedditInterface $reddit;

    public function __construct(NewsInterface $news, GoogleInterface $google, RedditInterface $reddit)
    {
        $this->middleware('auth');
        $this->news = $news;
        $this->google = $google;
        $this->reddit = $reddit;
    }


    public final function index(string $topic = "business"): ViewContract
    {
        $google_news = $this->google->getNews($topic);

        $google_trends = $this->google->getTrends();

        $reddit_news = $this->reddit->getHot();

        dd($google_news, $reddit_news, $google_trends);

        return view('news::index', compact('news_api', 'google_news','topic'));
    }

    public function topic(NewsInterface $news, TrendingInterface $trending,string $topic = "business"): ViewContract
    {
        $news_api = $news->allNews($topic);

        $google_news = $trending->find($topic);


        return view('news::index', compact('news_api', 'google_news','topic'));
    }


    public function extract(NewsInterface $news, string $url): ViewContract
    {
        $article = $news->extractArticle($url);

        return view('news::extract', compact('article'));

    }


    public function trending(NewsInterface $news, TrendingInterface $trending): ViewContract
    {
        $google = $trending->getGGoogleTrendingKeywords();
        $newspapers = $trending->getNewsTrendingKeywords();
        $twitter = $trending->getTwitterTrendingKeywords();

        return view('news::trending', compact('google', 'newspapers', 'twitter'));

    }

}
