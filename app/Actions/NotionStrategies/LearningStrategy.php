<?php

namespace App\Actions\NotionStrategies;

use App\Interfaces\PageStatusStrategyInterface;

class LearningStrategy implements PageStatusStrategyInterface
{
    public function process($page): array
    {
        return [];
    }
}
