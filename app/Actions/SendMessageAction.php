<?php

namespace App\Actions;
use App\Services\TelegramService;

final readonly class SendMessageAction
{
    protected TelegramService $service;

    public function __construct(TelegramService $service)
    {
        $this->service = $service;
    }
    public function execute(int|string $chat_id, string $message)
    {
        return $this->service->sendMessage($chat_id, $message);
    }
}
