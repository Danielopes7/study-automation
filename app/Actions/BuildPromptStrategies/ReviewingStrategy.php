<?php

namespace App\Actions\BuildPromptStrategies;

use App\Interfaces\StudyPromptStrategyInterface;
use App\Models\NotionPage;

class ReviewingStrategy implements StudyPromptStrategyInterface
{
    public function generatePrompt(NotionPage $page): string
    {
        $daysReviewing = $page->daysSinceStatusChange();
        $lastScore = $page->last_review_score ?? 'N/A';
        
        return "Título: {$page->title}\n" .
               "Conteúdo: " . ($page->content ?: "Sem conteúdo específico") . "\n" .
               "Tempo em revisão: {$daysReviewing} dias\n" .
            // TODO "Última pontuação: {$lastScore}/5\n\n" .
            //    "Você é um avaliador pedagógico especializado em identificar gaps de conhecimento.\n\n" .
            //    "Sua resposta deve conter:\n" .
            //    "- 1 questão desafiadora sobre o tema (múltipla escolha ou discursiva)\n" .
            //    "- 1 dica de revisão específica baseada no conteúdo\n" .
            //    "- Foco nos pontos mais críticos/esquecíveis do tema\n" .
            //    "- Linguagem clara e objetiva (máximo 120 palavras)\n" .
            //    "- Se a última pontuação foi baixa, adapte a dificuldade\n\n" .
               "Objetivo: testar retenção e reforçar pontos fracos.";
    }
}
