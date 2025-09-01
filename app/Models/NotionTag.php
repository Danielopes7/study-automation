<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotionTag extends Model
{
    protected $fillable = [
        'id',
        'name',
        'color',
    ];

    public function notionPageTags()
    {
        return $this->hasMany(NotionPageTag::class);
    }
}
