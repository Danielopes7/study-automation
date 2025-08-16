<?php

namespace App\Interfaces;

interface PageStatusStrategyInterface
{
    /**
     * Processa uma página do Notion
     *
     * @param  mixed  $page  Página do Notion
     * @return array ['message' => string, 'data' => mixed]
     */
    public function process($page): array;
}
