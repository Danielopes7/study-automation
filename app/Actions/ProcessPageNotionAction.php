<?php

namespace App\Actions;

use App\Factories\StudyStatusFactory;
use App\Services\NotionPageService;

final readonly class ProcessPageNotionAction
{
    //2 functions: save page to db, apply strategy
    public function execute(object $page): void
    {
        $status = $page->getProperty('Status')->getContent()['name'];

        $page_db = app(NotionPageService::class)->savePage($page);

        $strategy = StudyStatusFactory::create($status);
        $strategy->process($page_db);

    }
}
