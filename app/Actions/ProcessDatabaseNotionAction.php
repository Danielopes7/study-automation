<?php

// App/Actions/ProcessNotionPagesAction.php

namespace App\Actions;

use Illuminate\Support\Facades\Log;
use \Notion as Notion;

final readonly class ProcessDatabaseNotionAction
{
    public function execute(string $databaseId): array
    {
        try {
            $pageCollection = Notion::database($databaseId)->query();
            
            $collectionOfPages = $pageCollection->asCollection();
            
            foreach ($collectionOfPages as $page) {
                Log::info('processando : '.$page->getTitle());
                app(ProcessPageNotionAction::class)->execute($page);
            }

            $page = app(ChoosePageToSendAction::class)->execute();
            
            if ($page){
                $message = app(BuildMessageAction::class)->execute($page);
            }

        } catch (\Exception $e) {
            Log::error('Erro ao processar páginas do Notion: '.$e->getMessage());
            $results['details'][] = [
                'page_id' => null,
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }

        Log::info('Processamento concluído');

        return [];
    }
}
