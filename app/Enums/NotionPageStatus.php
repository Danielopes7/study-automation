<?php

namespace App\Enums;

enum NotionPageStatus: string
{
    case TO_STUDY = 'to_study';
    case STUDYING = 'studying';
    case REVIEWING = 'reviewing';
    case CONSOLIDATED = 'consolidated';

    public static function fromNotion(string $status): ?self
    {
        return match ($status) {
            'Para Estudar' => self::TO_STUDY,
            'Estudando' => self::STUDYING,
            'Revisar' => self::REVIEWING,
            'Conceitos Sólidos' => self::CONSOLIDATED,
            default => null,
        };
    }
}
