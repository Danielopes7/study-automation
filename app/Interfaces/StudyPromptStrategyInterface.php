<?php

namespace App\Interfaces;

use App\Models\NotionPage;

interface StudyPromptStrategyInterface
{
    public function generatePrompt(NotionPage $page): string;
}
