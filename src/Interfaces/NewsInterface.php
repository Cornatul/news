<?php

namespace Cornatul\News\Interfaces;


use Cornatul\Feeds\DTO\ArticleDto;
use Cornatul\News\DTO\NewsArticleDto;
use Cornatul\News\DTO\NewsDTO;
use Illuminate\Support\Collection;

interface NewsInterface
{
    public function getNews(string $topic, string $language): Collection;

}
