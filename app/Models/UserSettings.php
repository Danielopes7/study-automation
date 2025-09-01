<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    protected $fillable = [
        'user_id',
        'randomness_level',
        'strategy_to_learn',
        'strategy_learning',
        'strategy_reviewing',
        'strategy_solid_concept',
        'max_notifications_per_day',
    ];

    protected $casts = [
        'randomness_level' => 'integer',
        'strategy_to_learn' => 'integer',
        'strategy_learning' => 'integer',
        'strategy_reviewing' => 'integer',
        'strategy_solid_concept' => 'integer',
        'max_notifications_per_day' => 'integer',
    ];
}
