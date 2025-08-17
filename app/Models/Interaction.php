<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    public function notionPage()
    {
        return $this->belongsTo(NotionPage::class);
    }
}
