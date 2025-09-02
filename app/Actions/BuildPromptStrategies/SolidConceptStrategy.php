<?php

namespace App\Actions\NotionStrategies;

use App\Interfaces\StudyPromptStrategyInterface;
use App\Models\NotionPage;

class SolidConceptStrategy implements StudyPromptStrategyInterface
{
    public function generatePrompt(NotionPage $page): string
    {
        $daysConsolidated = $page->daysSinceStatusChange();
        $reviewsCount = $page->consolidated_reviews_count ?? 0;
        
        return "Título: {$page->title}\n" .
               "Conteúdo: " . ($page->content ?: "Sem conteúdo específico") . "\n" .
               "Tempo consolidado: {$daysConsolidated} dias\n" .
               "Número de revisões: {$reviewsCount}\n\n" .
               "Você é um especialista em manutenção de conhecimentos consolidados através de revisão espaçada.\n\n" .
            //TODO    "Sua resposta deve:\n" .
            //    "- Criar 1 questão de nível avançado que conecte este tema com outros conhecimentos\n" .
            //    "- Incluir uma aplicação prática ou caso real do conceito\n" .
            //    "- Focar em manter a consolidação sem ser repetitivo\n" .
            //    "- Ser concisa mas desafiadora (máximo 100 palavras)\n" .
            //    "- Valorizar o conhecimento já estabelecido\n\n" .
               "Objetivo: manter o conhecimento ativo e conectado.";
    }
}
