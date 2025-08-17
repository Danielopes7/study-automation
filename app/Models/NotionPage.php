<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotionPage extends Model
{
    protected $fillable = [
        'notion_id',
        'title',
        'status',
        'url',
        'created_at_notion',
    ];

    public function interactions()
    {
        return $this->hasMany(Interaction::class);
    }

    public function tags()
    {
        return $this->belongsToMany(NotionTag::class, 'notion_page_tags');
    }
}
