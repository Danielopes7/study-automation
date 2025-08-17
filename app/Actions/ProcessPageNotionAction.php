<?php

namespace App\Actions;

use App\Factories\StudyStatusFactory;
use App\Services\NotionPageService;

class ProcessPageNotionAction
{
    public function execute(object $page): array
    {
        $status = $page->getProperty('Status')->getContent()['name'];

        app(NotionPageService::class)->savePage($page); 

        // $strategy = StudyStatusFactory::create($status);
        // $result = $strategy->process($page);

        return [];
    }
}
