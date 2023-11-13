<?php
declare(strict_types=1);
namespace Cornatul\News\DTO;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Normalizers\ModelNormalizer;
use stdClass;

/**
 * @package Cornau\Feeds\DTO
 * @class NewsArticleDto
 *
 */
class NewsArticleDto extends Data
{
    public string $id;
    public string $title;
    public ?string $date;
    public string $text;
    public string $html;
    public string $markdown;
    public string $banner;
    public string $summary;
    public ?array $authors;
    public ?array $keywords;
    public ?array $images;
    public ?array $entities;
    public ?array $sentiment;
    public ?array $social;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->id = uniqid();
    }
}
