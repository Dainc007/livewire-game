<?php

namespace App\Enums;

enum GoodType: string
{
    // Resources
    case GOLD = 'gold';
    case CULTURE = 'culture';
    case SCIENCE = 'science';

    // Materials
    case WOOD = 'wood';
    case STONE = 'stone';
    case IRON = 'iron';
    case CLAY = 'clay';

    // Military
    case SOLDIERS = 'soldiers';
    case SWORDS = 'swords';
    case SHIELDS = 'shields';

    // Population & Food
    case POPULATION = 'population';
    case FOOD = 'food';
    case HAPPINESS = 'happiness';

    public function description(): string
    {
        return match($this) {
            self::GOLD => 'Currency used for various transactions',
            self::CULTURE => 'Cultural influence and development',
            self::SCIENCE => 'Scientific knowledge and research',

            self::WOOD => 'Basic building material',
            self::STONE => 'Durable building material',
            self::IRON => 'Metal used for tools and weapons',
            self::CLAY => 'Material used for pottery and buildings',

            self::SOLDIERS => 'Military units for defense and attack',
            self::SWORDS => 'Weapons for soldiers',
            self::SHIELDS => 'Defensive equipment for soldiers',

            self::POPULATION => 'Citizens of your settlement',
            self::FOOD => 'Sustenance for your population',
            self::HAPPINESS => 'Satisfaction level of your population',
        };
    }

    public function icon(): string
    {
        return match($this) {
            self::GOLD => '💰',
            self::CULTURE => '🎭',
            self::SCIENCE => '🔬',

            self::WOOD => '🪵',
            self::STONE => '🪨',
            self::IRON => '⚒️',
            self::CLAY => '🧱',

            self::SOLDIERS => '⚔️',
            self::SWORDS => '🗡️',
            self::SHIELDS => '🛡️',

            self::POPULATION => '👥',
            self::FOOD => '🍖',
            self::HAPPINESS => '😊',
        };
    }

    public static function getAllCases(): array
    {
        return self::cases();
    }
}
