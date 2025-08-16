<?php

namespace App\Actions\NotionStrategies;

use App\Interfaces\PageStatusStrategyInterface;

class ReviewingStrategy implements PageStatusStrategyInterface
{
    public function process($page): array
    {
        return [];
    }
}
