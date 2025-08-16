<?php

namespace App\Actions;

use App\Factories\StudyStatusFactory;

class ProcessNotionPagesAction
{
    public function execute(object $page): array
    {
        $status = $page->getProperty('Status')->getContent()['name'];

        $strategy = StudyStatusFactory::create($status);
        $result = $strategy->process($page);

        return $result;
    }
}
