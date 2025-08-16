<?php

namespace App\Actions\NotionStrategies;

use App\Interfaces\PageStatusStrategyInterface;

class ToStudyStrategy implements PageStatusStrategyInterface
{
    public function process($page): array
    {
        return [];
    }
}
