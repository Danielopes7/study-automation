<?php

namespace App\Services;

use Telegram\Bot\Api;
use App\Helpers\TelegramHelper;

class TelegramService
{
    protected $telegram;

    public function __construct(Api $telegram)
    {
        $this->telegram = $telegram;
    }

    public function sendMessage(int|string $chatId, string $text): \Telegram\Bot\Objects\Message
    {
        return $this->telegram->sendMessage([
            'chat_id' => $chatId,
            'text'    => TelegramHelper::formatMarkdown($text),
            'parse_mode' => 'Markdown',
        ]);
    }

    public function getBotInfo(): \Telegram\Bot\Objects\User
    {
        return $this->telegram->getMe();
    }

}
