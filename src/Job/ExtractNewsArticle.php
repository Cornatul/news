<?php
declare(strict_types=1);

namespace Cornatul\News\Job;

use Cornatul\News\Clients\GoogleClient;
use Cornatul\News\Clients\NewsClient;
use Cornatul\News\DTO\NewsDTO;

class ExtractNewsArticle
{
    public function __construct(
        private readonly NewsDTO $newsDTO
    )
    {
    }

    public final function handle(): void
    {

    }
}
