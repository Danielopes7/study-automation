<?php

namespace App\Models;

use App\Enums\NotionPageStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class NotionPage extends Model
{
    protected $fillable = [
        'notion_id',
        'title',
        'status',
        'url',
        'created_at_notion',
        'status_change',
        'priority',
        'repetitions',
        'last_review',
        'next_review',
    ];

    public function interactions()
    {
        return $this->hasMany(Interaction::class);
    }

    public function tags()
    {
        return $this->belongsToMany(NotionTag::class, 'notion_page_tags');
    }
    public function setLastReview()
    {
        $this->last_review = now();
    }

    public function setNextReview()
    {
        //simple spaced repetition algorithm before implementing SM-2
        $intervals = [7, 7, 14, 30];
        $daysToAdd = $intervals[$this->repetitions] ?? 30;
        $this->repetitions = $this->repetitions + 1;

        $weight = NotionPageStatus::from($this->status)->weight();
        
        $daysToAdd *= $weight;

        $this->next_review = now()->addDays($daysToAdd);
    }

    public function needsReview(): bool
    {
        return is_null($this->next_review) || $this->next_review <= now();
    }

    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    public function getIsPriorityToStudyAttribute(): bool
    {
        return $this->status === NotionPageStatus::TO_STUDY->value && $this->daysSinceStatusChange() >= 7 && $this->needsReview();
    }

    public function getIsPriorityToReviewAttribute(): bool
    {
        return $this->status === NotionPageStatus::REVIEWING->value && $this->daysSinceStatusChange() >= 5 && $this->needsReview();
    }

    public function getIsPriorityLearningAttribute(): bool
    {
        return $this->status === NotionPageStatus::STUDYING->value && $this->daysSinceStatusChange() >= 2 && $this->needsReview();
    }

    public function getIsPriorityToSolidAttribute(): bool
    {
        return $this->status === NotionPageStatus::CONSOLIDATED->value && $this->daysSinceStatusChange() >= 30 && $this->needsReview();
    }

    public function daysSinceStatusChange()
    {
        return Carbon::parse($this->status_change ?? $this->created_at_notion)->diffInDays(now());
    }
}
