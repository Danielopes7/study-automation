<?php

namespace App\Factories;

use App\Actions\BuildPromptStrategies\LearningStrategy;
use App\Actions\BuildPromptStrategies\ReviewingStrategy;
use App\Actions\BuildPromptStrategies\SolidConceptStrategy;
use App\Actions\BuildPromptStrategies\ToStudyStrategy;
use App\Interfaces\StudyPromptStrategyInterface;
use InvalidArgumentException;

class StudyPromptFactory
{
    public static function create(string $status): StudyPromptStrategyInterface
    {
        return match ($status) {
            'to_study' => new ToStudyStrategy(),
            'studying' => new LearningStrategy(),
            'reviewing' => new ReviewingStrategy(),
            'consolidated' => new SolidConceptStrategy(),
            default => throw new InvalidArgumentException("Status '{$status}' não suportado")
        };
    }
}
