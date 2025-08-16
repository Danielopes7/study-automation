<?php

namespace App\Actions\NotionStrategies;

use App\Interfaces\PageStatusStrategyInterface;

class SolidConceptStrategy implements PageStatusStrategyInterface
{
    public function process($page): array
    {
        return [];
    }
}
