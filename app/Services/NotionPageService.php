<?php

namespace App\Services;

use App\Models\NotionPage;
use App\Models\NotionTag;
use App\Models\NotionPageTag;
use Illuminate\Support\Facades\DB;
use App\Enums\NotionPageStatus;

class NotionPageService
{
    public function savePage(object $page): array
    {
        DB::transaction(function () use ($page) {

            $pageArray = [
                "notion_id" => $page->getId(),
                "title" => $page->getTitle(),
                "url" => $page->getUrl(),
                "status" => NotionPageStatus::fromNotion($page->getProperty('Status')->getContent()['name']),
                "created_at_notion" => $page->getCreatedTime(), //converter Carbon
            ];

            $notionPage = NotionPage::updateOrCreate(['notion_id' => $pageArray['notion_id']], $pageArray);
            $tagsCollection = collect($page->getProperty('Tags')->getContent())->map(function ($tag) {
                return [
                    'notion_id' => $tag->getId(),
                    'name' => $tag->getName(),
                    'color' => $tag->getColor(),
                ];
            });

            if ($tagsCollection->isNotEmpty()) {
                NotionTag::upsert($tagsCollection->toArray(), ['notion_id'], ['name', 'color']);
                $notionIds = $tagsCollection->pluck('notion_id')->all();
                $tagIds = NotionTag::whereIn('notion_id', $notionIds)->pluck('id')->all();
                $notionPage->tags()->syncWithoutDetaching($tagIds);
            }
        });
    
        return [
            'id' => $page->getId(),
            'status' => 'saved',
            'message' => 'Page saved successfully.',
        ];
    }
}
