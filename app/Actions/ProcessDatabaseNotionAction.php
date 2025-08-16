<?php

// App/Actions/ProcessNotionPagesAction.php

namespace App\Actions;

use Illuminate\Support\Facades\Log;
use Notion;

final readonly class ProcessDatabaseNotionAction
{
    public function execute(string $databaseId, ProcessNotionPagesAction $processNotionPagesAction): array
    {
        try {
            $pageCollection = Notion::database($databaseId)->query();

            $collectionOfPages = $pageCollection->asCollection();

            foreach ($collectionOfPages as $page) {
                $processNotionPagesAction->execute($page);
            }
        } catch (\Exception $e) {
            Log::error('Erro ao processar páginas do Notion: '.$e->getMessage());
            $results['details'][] = [
                'page_id' => null,
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }

        Log::info('Processamento concluído', $results);

        return $results;
    }
}
