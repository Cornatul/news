<?php

namespace Cornatul\News\DTO;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class NewsDTO extends Data
{
    public string $title;
    public string $author;
    public string $link;
    public string $content;
    public string $image;
    public string $publishedAt;
}
