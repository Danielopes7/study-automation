<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class NotionPageTag extends Pivot
{
    protected $table = 'notion_page_tags';

    public function notionPage()
    {
        return $this->belongsTo(NotionPage::class);
    }

    public function notionTag()
    {
        return $this->belongsTo(NotionTag::class);
    }
}
