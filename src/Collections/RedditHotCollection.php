<?php

namespace Cornatul\News\Collections;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class RedditHotCollection extends Collection
{
    public function __construct($items = [])
    {
        parent::__construct($items);
    }

    public function toArray(): array
    {
        return $this->map(function($item){
            return [
                'title' => $item->title,
                'content' => $item->content
            ];
        })->toArray();
    }
}
