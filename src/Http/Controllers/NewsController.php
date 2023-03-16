<?php
declare(strict_types=1);
namespace Cornatul\News\Http\Controllers;

use Cornatul\Feeds\Classes\Parser;
use Cornatul\Feeds\DTO\FeedDto;
use Cornatul\Feeds\Interfaces\ArticleRepositoryInterface;
use Cornatul\Feeds\Interfaces\FeedFinderInterface;
use Cornatul\Feeds\Interfaces\FeedRepositoryInterface;
use Cornatul\Feeds\Jobs\FeedExtractor;
use Cornatul\Feeds\Jobs\FeedImporter;
use Cornatul\Feeds\Models\Feed;
use Cornatul\News\Interfaces\NewsInterface;
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
use Illuminate\View\View;
use Illuminate\Contracts\View\View as ViewContract;
use imelgrat\OPML_Parser\OPML_Parser;
class NewsController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(NewsInterface $news): ViewContract
    {
        $items = $news->headlines('technology');

        return view('news::index', compact('items'));
    }

    //generate a function to read the article
    public function show(NewsInterface $news, string $url): ViewContract
    {

        //todo fix this
        $article = $news->extractArticle($url);

        return view('news::show', compact('article'));

    }

}
