<?php

namespace Cornatul\News\Collections;

use Cornatul\News\Interfaces\OutputInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;


/**
 * @todo implement this to output interface
 */
class GoogleNewsCollection extends BaseCollections implements OutputInterface
{
    private string $title;

    private string $description;

    private string $link;


    public function __construct($items = [])
    {
        parent::__construct($items);
    }


    public function getTitle(): string
    {
        // TODO: Implement getTitle() method.
    }

    public function getDescription(): string
    {
        // TODO: Implement getDescription() method.
    }

    public function getLink(): string
    {
        // TODO: Implement getLink() method.
    }
}
