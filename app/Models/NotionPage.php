<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Enums\NotionPageStatus;
class NotionPage extends Model
{
    protected $fillable = [
        'notion_id',
        'title',
        'status',
        'url',
        'created_at_notion',
        'status_change',
        'priority'
    ];

    public function interactions()
    {
        return $this->hasMany(Interaction::class);
    }

    public function tags()
    {
        return $this->belongsToMany(NotionTag::class, 'notion_page_tags');
    }

    public function getIsPriorityForStudyAttribute(): bool
    {
        return $this->status === NotionPageStatus::TO_STUDY && $this->daysSinceStatusChange() >= 7;
    }

    public function daysSinceStatusChange(){
        return Carbon::parse($this->status_change)->diffInDays(now());
    }
}
