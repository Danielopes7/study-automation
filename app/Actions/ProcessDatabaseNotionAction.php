<?php

// App/Actions/ProcessNotionPagesAction.php

namespace App\Actions;

use Illuminate\Support\Facades\Log;
use \Notion as Notion;

final readonly class ProcessDatabaseNotionAction
{
    public function execute(string $databaseId): array
    {
        $pageCollection = Notion::database($databaseId)->query();
        
        $collectionOfPages = $pageCollection->asCollection();
        
        foreach ($collectionOfPages as $page) {
            Log::info('processando : '.$page->getTitle());
            app(ProcessPageNotionAction::class)->execute($page);
        }
        
        return [];
    }
}
