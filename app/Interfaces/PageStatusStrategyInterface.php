<?php

namespace App\Interfaces;

use App\Models\NotionPage;

interface PageStatusStrategyInterface
{
    public function process(NotionPage $page);

    public function calculatePriority(NotionPage $page): void;
}
