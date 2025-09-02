<?php

namespace App\Services;

use App\Enums\NotionPageStatus;
use App\Models\NotionPage;
use App\Models\NotionTag;
use Illuminate\Support\Facades\DB;

class NotionPageService
{
    public function savePage(object $page): NotionPage
    {
        return DB::transaction(function () use ($page) {
            $statusNotion = $page->getProperty('Status')->getContent()['name'];
            $statusPage = NotionPageStatus::fromNotion($statusNotion);
            $notionPage = NotionPage::where('notion_id', $page->getId())->first();

            $pageArray = [
                'notion_id' => $page->getId(),
                'title' => $page->getTitle(),
                'url' => $page->getUrl(),
                'status' => $statusPage->value,
                'created_at_notion' => $page->getCreatedTime(),
            ];

            if ($notionPage && $notionPage->status !== $statusPage->value) {
                $pageArray['status_change'] = now();
            }

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

            return $notionPage;
        });
    }
}
