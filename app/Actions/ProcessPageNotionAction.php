<?php

namespace App\Actions;

use App\Factories\StudyStatusFactory;
use App\Services\NotionPageService;

class ProcessPageNotionAction
{
    public function execute(object $page): array
    {
        $status = $page->getProperty('Status')->getContent()['name'];

        $page_db = app(NotionPageService::class)->savePage($page);

        $strategy = StudyStatusFactory::create($status);
        $strategy->process($page_db);

        return [];
    }
}
