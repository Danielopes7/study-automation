<?php

// App/Factories/StudyStatusFactory.php

namespace App\Factories;

use App\Actions\NotionStrategies\LearningStrategy;
use App\Actions\NotionStrategies\ReviewingStrategy;
use App\Actions\NotionStrategies\SolidConceptStrategy;
use App\Actions\NotionStrategies\ToStudyStrategy;
use App\Interfaces\PageStatusStrategyInterface;
use InvalidArgumentException;

class StudyStatusFactory
{
    public static function create(string $status): PageStatusStrategyInterface
    {
        return match ($status) {
            'Para Estudar' => new ToStudyStrategy(),
            'Estudando' => new LearningStrategy(),
            'Revisando' => new ReviewingStrategy(),
            'Conceito Sólido' => new SolidConceptStrategy(),
            default => throw new InvalidArgumentException("Status '{$status}' não suportado")
        };
    }
}
