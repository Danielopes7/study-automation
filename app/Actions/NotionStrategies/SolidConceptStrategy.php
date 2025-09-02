<?php

namespace App\Actions\NotionStrategies;

use App\Interfaces\PageStatusStrategyInterface;
use App\Models\NotionPage;

class SolidConceptStrategy implements PageStatusStrategyInterface
{
    public function process(NotionPage $page)
    {
        $this->calculatePriority($page);
    }

    public function calculatePriority(NotionPage $page): void
    {
        $page->priority = 2;

        if ($page->is_priority_to_solid) {
            $page->priority = 1;
        }

        $page->save();
    }
}
