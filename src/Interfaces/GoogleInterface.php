<?php

namespace Cornatul\News\Interfaces;

use Cornatul\News\Collections\GoogleNewsCollection;
use Illuminate\Support\Collection;

interface GoogleInterface
{
    public function getNews(string $keyword, string $language = "en_gb"): GoogleNewsCollection;

    public function getTrends(): Collection;

}
