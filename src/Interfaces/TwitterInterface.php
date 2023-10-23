<?php

namespace Cornatul\News\Interfaces;

use Illuminate\Support\Collection;

interface TwitterInterface
{
    public function getTrends(): Collection;
}
