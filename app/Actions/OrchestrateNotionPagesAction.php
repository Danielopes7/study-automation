<?php

namespace App\Actions;
use Illuminate\Support\Facades\Log;

final readonly class OrchestrateNotionPagesAction
{
    public function __construct(
        private ProcessDatabaseNotionAction $processDatabaseAction,
        private ChoosePageToSendAction $choosePageAction,
        private BuildMessageAction $buildMessageAction,
        private SendMessageAction $sendMessageAction,
        private StoreInteractionAction $storeInteractionAction,
    ) {}

    public function execute(string $databaseId): void
    {
        $this->processDatabaseAction->execute($databaseId);

        $page = $this->choosePageAction->execute();

        if ($page) {
            $message = $this->buildMessageAction->execute($page);
            
            $this->sendMessageAction->execute(ENV("CHAT_ID"), $message);

            $this->storeInteractionAction->execute($page, $message);
        }

        Log::info('Processamento concluido  = ' . $page?->id ?? 'no page' );
    }
}