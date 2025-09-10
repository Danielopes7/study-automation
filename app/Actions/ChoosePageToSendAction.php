<?php

// App/Actions/ProcessNotionPagesAction.php

namespace App\Actions;

use Illuminate\Support\Facades\Log;
use \Notion as Notion;
use App\Models\NotionPage;
final readonly class ChoosePageToSendAction
{
    public function execute() : NotionPage|null
    {
        $page = NotionPage::where('priority', 1)
                ->orderByRaw('IFNULL(status_change, created_at_notion) ASC')
                ->first();

        return $page;
    }
}
