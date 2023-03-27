<?php
declare(strict_types=1);
namespace Cornatul\News\Http\Controllers;

use Cornatul\Feeds\Classes\Parser;
use Cornatul\Feeds\DTO\FeedDto;
use Cornatul\Feeds\Interfaces\FeedFinderInterface;
use Cornatul\Feeds\Jobs\FeedExtractor;
use Cornatul\Feeds\Jobs\FeedImporter;
use Cornatul\Feeds\Models\Feed;
use Cornatul\News\Interfaces\NewsInterface;
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


    private TrendingInterface $trending;

    public function __construct(TrendingInterface $trending)
    {
        $this->middleware('auth');
        $this->trending = $trending;
    }

    public function index(NewsInterface $news, string $topic = "business"): ViewContract
    {
        $news_api = $news->headlines($topic);

        $google_news = $this->trending->find($topic);

        $trending = ($this->trending->getTrendingKeywords())->first();

//        dd($google_news);

        return view('news::index', compact('news_api', 'google_news', 'trending','topic'));
    }

    public function topic(NewsInterface $news, string $topic = "business"): ViewContract
    {
        $news_api = $news->allNews($topic);

        $google_news = $this->trending->find($topic);

        $trending = ($this->trending->getTrendingKeywords())->first();




        return view('news::index', compact('news_api', 'google_news', 'trending','topic'));
    }

    public function show(NewsInterface $news, string $url): ViewContract
    {
        $article = $news->extractArticle($url);

        return view('news::show', compact('article'));

    }

}
