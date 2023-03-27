<?php

namespace Cornatul\News\Interfaces;

use Illuminate\Support\Collection;

interface TrendingInterface
{

    /**
     * @method find
     */
    public function find(string $topic): Collection;

    /**
     * @method getTrendingKeywords
     */
    public function getTrendingKeywords(): Collection;
}
