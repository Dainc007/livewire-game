<?php

declare(strict_types=1);

namespace App\Enums;

enum UnitType: string
{
    // Civilian Units
    case CITIZEN = 'citizen';
    case WORKER = 'worker';
    case MERCHANT = 'merchant';

    // Military Units
    case SOLDIER = 'soldier';
    case ARCHER = 'archer';
    case CAVALRY = 'cavalry';
    case SIEGE = 'siege';
    case KNIGHT = 'knight';

    public static function getAllCases(): array
    {
        return self::cases();
    }

    public function description(): string
    {
        return match ($this) {
            // Civilian Units
            self::CITIZEN => 'Basic working unit for resource gathering',
            self::WORKER => 'Specialized in constructing buildings',
            self::MERCHANT => 'Generates gold through trade',

            // Military Units
            self::SOLDIER => 'Basic military unit for defense and attack',
            self::ARCHER => 'Ranged military unit',
            self::CAVALRY => 'Fast mounted unit',
            self::SIEGE => 'Heavy siege weapon for attacking buildings',
            self::KNIGHT => 'Elite mounted warrior',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            // Civilian Units
            self::CITIZEN => '👤',
            self::WORKER => '👷',
            self::MERCHANT => '💰',

            // Military Units
            self::SOLDIER => '⚔️',
            self::ARCHER => '🏹',
            self::CAVALRY => '🐎',
            self::SIEGE => '🎯',
            self::KNIGHT => '🛡️',
        };
    }
}
