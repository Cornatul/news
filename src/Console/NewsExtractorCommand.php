<?php
declare(strict_types=1);
namespace Cornatul\News\Console;

use Cornatul\Feeds\Connectors\FeedlyConnector;
use Cornatul\Feeds\Connectors\NlpConnector;
use Cornatul\Feeds\Requests\FeedlyTopicRequest;
use Cornatul\Feeds\Requests\GetArticleRequest;
use Cornatul\News\Job\FindNewsJob;
use Cornatul\News\Requests\TrendingKeywordsRequest;
use Illuminate\Console\Command;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;

class NewsExtractorCommand extends Command
{

    protected $signature = 'news:extract';

    protected $description = 'Extract all the news for current trending keywords';

    /**
     * @throws \ReflectionException
     * @throws InvalidResponseClassException
     * @throws PendingRequestException
     * @throws \JsonException
     */
    public function handle(): void
    {
        $this->info('Extracting news...');
        $keywords = $this->getTrendingKeywords();
        $newspapers = $keywords->get('newspapers');

        $newspapers->map(function ($newspaper) {
            $this->info("Extracting {$newspaper['title']}...");
            $client = new FindNewsJob($newspaper['title']);
            $response = $client->handle();

        });


    }


    private function getTrendingKeywords(): \Illuminate\Support\Collection
    {
        $connector = new NlpConnector();
        $response = $connector->send(new TrendingKeywordsRequest());
        $newspapers = collect();
        $googleTrends = collect();
        foreach ($response->collect('data')->get('newspaper') as $newspaper) {
            $newspapers->push([
                'title' => $newspaper,
                'content' => $newspaper['content'] ?? "",
                'link' => $newspaper['link'] ??  "",
            ]);
        }
        foreach ($response->collect('data')->get('google') as $google) {
            $googleTrends->push([
                'title' => $google,
                'content' => $google['content'] ?? "",
                'link' => $google['link'] ??  "",
            ]);
        }
        return collect([
            'newspapers' => $newspapers,
            'google' => $googleTrends,
        ]);
    }

}
