<?php

declare(strict_types=1);
namespace Cornatul\Crawler\Commands;

use Cornatul\Crawler\Interfaces\CrawlerInterface;
use Cornatul\News\Clients\RedditClient;
use GuzzleHttp\ClientInterface;
use Illuminate\Console\Command;
use Cornatul\Crawler\DTO\CrawlerDTO;
use Cornatul\Crawler\Interfaces\SentimentInterface;

abstract class RedditHotCommand extends Command
{
    /**
     * @var string The console command name.
     */
    protected static $defaultName = 'reddit:hot';

    /**
     * @var string The name and signature of this command.
     */
    protected $signature = 'reddit:hot';

    /**
     * @var string The console command description.
     */
    protected $description = 'This will extract the hot topics from reddit';

    /**
     * Execute the console command.
     * @return void
     */
    final public function handle(): void
    {
        $client = new RedditClient();


    }
}
