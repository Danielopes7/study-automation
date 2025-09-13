<?php

// App/Actions/ProcessNotionPagesAction.php

namespace App\Actions;

use Illuminate\Support\Facades\Log;
use App\Models\NotionPage;
use Prism\Prism\Enums\Provider;
use Prism\Prism\Prism;
use App\Factories\StudyPromptFactory;
use \Notion as Notion;

final readonly class BuildMessageAction
{
    public function execute(NotionPage $notionPage)
    {
        $notionPage->content = Notion::block($notionPage->notion_id)->children()->asTextCollection()->join("\n");
        $strategy = StudyPromptFactory::create($notionPage->status);
        $prompt = $strategy->generatePrompt($notionPage);

        $response = Prism::text()
            ->using(Provider::Anthropic, 'claude-sonnet-4-20250514')
            ->withSystemPrompt('You are a helpful assistant that creates concise study notes based on the provided content. Format the output in Markdown Legacy, using headings, bold text, and lists where appropriate. Keep the response clear and focused on the key points.')
            ->withPrompt($prompt)
            ->asText();

        return $response->text;
    }
}
