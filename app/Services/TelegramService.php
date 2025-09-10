<?php

namespace App\Services;

use Telegram\Bot\Api;

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
            'text'    => $text,
        ]);
    }

    public function getBotInfo(): \Telegram\Bot\Objects\User
    {
        return $this->telegram->getMe();
    }

    public function markdownParaTelegram(string $text): string {
        // Negrito com * em vez de **
        $text = preg_replace('/\\(.?)\\/u', '$1*', $text);
        // Remover colchetes especiais
        $text = preg_replace('/\x{3010}.*?\x{3011}/u', '', $text);
        
        // Remover espaços invisíveis problemáticos
        $text = preg_replace('/[\x{2009}\x{202F}\x{00A0}\x{200B}]/u', ' ', $text);
        
        // Substituir aspas tipográficas por aspas padrão
        // Aspas duplas: " " ? ? « » ? ? ? ? ? ? ?
        $text = preg_replace('/[\x{201C}\x{201D}\x{201E}\x{201F}\x{00AB}\x{00BB}\x{2033}\x{2036}\x{275D}\x{275E}\x{301D}\x{301E}\x{FF02}]/u', '"', $text);
        
        // Aspas simples: ' ' ? ? ? ? ? ? ?
        $text = preg_replace('/[\x{2018}\x{2019}\x{201A}\x{201B}\x{2032}\x{2035}\x{275B}\x{275C}\x{FF07}]/u', "'", $text);
    
        
        // Remover travessão (?)
        $text = preg_replace('/\x{2014}/u', '', $text);
        
        // Substituir divisores "---" por linha visual
        $text = preg_replace('/---/', "\n_____\n", $text);

        // Substituir bullet point ? por quebra com hífen
        $text = preg_replace('/\x{2022}/u', "\n- ", $text);
        
        // Corrigir quebras de linha literais (\n)
        $text = str_replace('\\n', "\n", $text);
        
        // Quebra antes de listas numeradas (1., 2., etc.)
        $text = preg_replace('/(^|\s)(\d+\.)/m', '$1' . "\n" . '$2', $text);
        
        // Remover todos os caracteres "#"
        $text = str_replace('#', '', $text);
        
        // Normalizar múltiplas quebras de linha
        $text = preg_replace("/\n{3,}/", "\n\n", $text);
        
        // Remover espaços extras no início e fim
        $text = trim($text);
        return $text;
    }
}
