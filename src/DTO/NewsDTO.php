<?php

namespace Cornatul\News\DTO;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class NewsDTO extends Data
{
    public ?string  $author;

    public array $source;

    public string $title;

    public string $url;

    public string $publishedAt;
}
