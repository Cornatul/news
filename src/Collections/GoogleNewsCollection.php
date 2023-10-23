<?php

namespace Cornatul\News\Collections;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class GoogleNewsCollection extends Collection
{
    public function __construct($items = [])
    {
        parent::__construct($items);
    }

    public function toArray()
    {
        return $this->map(function($item){
            return [
                'title' => $item->title,
                'description' => $item->description,
                'url' => $item->url,
                'image' => $item->image,
                'published_at' => $item->published_at,
                'source' => $item->source,
            ];
        })->toArray();
    }
}
