<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    protected $fillable = [
        'notion_page_id',
        'text',
        'type',
    ];
    public function notionPage()
    {
        return $this->belongsTo(NotionPage::class);
    }
}
