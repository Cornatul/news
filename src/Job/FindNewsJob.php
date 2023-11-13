<?php
declare(strict_types=1);

namespace Cornatul\News\Job;

use Cornatul\News\Clients\GoogleClient;
use Cornatul\News\Clients\NewsClient;

class FindNewsJob
{
    private array $clients =  [
        NewsClient::class,
        GoogleClient::class,
    ];
    public function __construct(
        private readonly string $keyword
    )
    {
    }

    public final function handle(): void
    {

        foreach ($this->clients as $client) {
            $client = new $client();
            $response = $client->getNews($this->keyword);
            dd($response);
        }

    }
}
