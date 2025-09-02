<?php

namespace App\Actions\BuildPromptStrategies;

use App\Interfaces\StudyPromptStrategyInterface;
use App\Models\NotionPage;

class ToStudyStrategy implements StudyPromptStrategyInterface
{
    public function generatePrompt(NotionPage $page): string
    {
        $daysStudying = $page->daysSinceStatusChange();
        
        return "Título: {$page->title}\n" .
               "Conteúdo: " . ($page->content ?: "Sem conteúdo específico") . "\n" .
               "Dias estudando: {$daysStudying} dias\n\n" .
               "Você é um tutor especialista que está acompanhando o processo ativo de aprendizagem deste tema.\n\n" .
               "Sua resposta deve:\n" .
               "- Fornecer uma dica valiosa e específica sobre o conteúdo (máximo 80 palavras)\n" .
               "- Incluir um insight interessante ou conexão com outros conhecimentos\n" .
               "- Sugerir uma técnica de estudo ou abordagem diferente\n" .
               "- Ser prático e aplicável imediatamente\n" .
               "Foque em agregar valor real ao aprendizado em andamento.";
    }
}
