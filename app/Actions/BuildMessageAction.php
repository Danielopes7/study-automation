<?php

// App/Actions/ProcessNotionPagesAction.php

namespace App\Actions;

use Illuminate\Support\Facades\Log;
use App\Models\NotionPage;
use Prism\Prism\Enums\Provider;
use Prism\Prism\Prism;
use App\Factories\StudyPromptFactory;

final readonly class BuildMessageAction
{
    public function execute(NotionPage $notionPage)
    {
        $strategy = StudyPromptFactory::create($notionPage->status);
        $prompt = $strategy->generatePrompt($notionPage);

        $response = Prism::text()
            ->using(Provider::Anthropic, 'claude-sonnet-4-20250514')
            ->withPrompt($prompt)
            ->asText();

        return $response->text;
    }
}
