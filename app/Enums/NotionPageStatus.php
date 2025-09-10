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

    public function weight(): int
    {
        return match($this) {
            self::TO_STUDY      => 2,
            self::STUDYING      => 1,
            self::REVIEWING     => 1,
            self::CONSOLIDATED  => 4,
        };
    }
}
