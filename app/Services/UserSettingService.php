<?php 

namespace App\Services;

use App\Models\UserSetting;

class UserSettingService
{
    private UserSetting $settings;

    public function __construct(int $userId)
    {
        $this->settings = UserSetting::firstOrCreate(['user_id' => $userId]);
    }

    public function getRandomnessLevel(): int
    {
        return $this->settings->randomness_level;
    }

    public function getStrategyWeights(): array
    {
        return [
            'toLearn' => $this->settings->strategy_to_learn,
            'Learning' => $this->settings->strategy_learning,
            'Reviewing' => $this->settings->strategy_reviewing,
            'SolidConcept' => $this->settings->strategy_solid_concept
        ];
    }

    public function getMaxNotifications(): int
    {
        return $this->settings->max_notifications_per_day;
    }
}
