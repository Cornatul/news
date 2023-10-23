<?php

namespace Cornatul\News\Interfaces;

use Cornatul\News\Collections\RedditHotCollection;
use Illuminate\Support\Collection;

interface RedditInterface
{


    public function getHot(): RedditHotCollection;

}
