<?php

namespace App\Actions;
use App\Models\Interaction;
use App\Models\NotionPage;

final readonly class StoreInteractionAction
{

    public function execute(NotionPage $page, string $message)
    {
        Interaction::create([
            'notion_page_id' => $page->id,
            'text' => $message,
            'type' => 'message',
        ]);

        $page->setLastReview();
        $page->setNextReview();
        $page->setPriority(2);
        $page->save();
    }
}
