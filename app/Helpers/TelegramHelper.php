<?php

namespace App\Helpers;

class TelegramHelper
{
    /**
     * Format text for Telegram using Markdown Legacy mode
     */
    public static function formatMarkdown($text)
    {
        $helper = new self();
        return $helper->formatTelegramMarkdown($text);
    }

    /**
     * Process titles ## -> *title*
     */
    private function processTitles($text)
    {
        $lines = explode("\n", $text);
        $result = [];
        
        foreach ($lines as $line) {
            if (preg_match('/^## (.+)$/', $line, $matches)) {
                $result[] = '*' . trim($matches[1]) . '*';
            } else {
                $result[] = $line;
            }
        }
        
        return implode("\n", $result);
    }

    /**
     * Process bold text **text** -> *text*
     */
    private function processBold($text)
    {
        return preg_replace('/\*\*(.+?)\*\*/', '*$1*', $text);
    }

    /**
     * Process italic text (if any)
     */
    private function processItalic($text)
    {
        return preg_replace('/\*([^*]+)\*/', '_$1_', $text);
    }

    /**
     * Process lists - item -> • item
     */
    private function processLists($text)
    {
        $lines = explode("\n", $text);
        $result = [];
        
        foreach ($lines as $line) {
            if (preg_match('/^- (.+)$/', $line, $matches)) {
                $result[] = '• ' . $matches[1];
            } else {
                $result[] = $line;
            }
        }
        
        return implode("\n", $result);
    }

    /**
     * Main function to format text for Telegram Markdown Legacy mode
     */
    private function formatTelegramMarkdown($text)
    {
        // Remove multiple consecutive line breaks
        $text = preg_replace('/\n{3,}/', "\n\n", $text);
        
        // Process each type of formatting
        $text = $this->processTitles($text);
        $text = $this->processBold($text);
        $text = $this->processLists($text);
        // $text = $this->processItalic($text);
        
        return $text;
    }
}