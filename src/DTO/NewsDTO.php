<?php

namespace Cornatul\News\DTO;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class NewsDTO extends Data
{
    #[MapInputName('articles')]
    public array $articles;

    public string $author;
    public string $title;
    public string $description;
    public string $url;
    public string $urlToImage;
    public string $publishedAt;
    public string $content;
}
