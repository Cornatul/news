<?php

namespace Cornatul\News\Interfaces;

use Illuminate\Support\Collection;

interface GoogleInterface
{


    public function getNews(string $keyword, string $language = "en_gb"): Collection;

}
