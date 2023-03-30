<?php

namespace Cornatul\News\Interfaces;

use Illuminate\Support\Collection;

interface TrendingInterface
{
    public function find(string $topic): Collection;

    /**
     * @method getTrendingKeywords
     */
    public function getNewsTrendingKeywords(): Collection;

    public function getGGoogleTrendingKeywords(): Collection;

    public function getTwitterTrendingKeywords(): Collection;
}
