<?php

declare(strict_types=1);

namespace App\Enums;

enum FieldType: string
{
    case GRASS = 'grass';
    case WATER = 'water';
    case MOUNTAIN = 'mountain';
    case FOREST = 'forest';
    case DESERT = 'desert';
    case SWAMP = 'swamp';
    case TUNDRA = 'tundra';

    public static function getAllCases(): array
    {
        return self::cases();
    }

    public function description(): string
    {
        return match ($this) {
            self::GRASS => 'Fertile plains suitable for farming',
            self::WATER => 'Rivers and lakes providing water resources',
            self::MOUNTAIN => 'Rocky terrain rich in minerals',
            self::FOREST => 'Dense woodland providing timber',
            self::DESERT => 'Arid lands with hidden treasures',
            self::SWAMP => 'Wetlands with unique resources',
            self::TUNDRA => 'Frozen lands with scarce resources',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::GRASS => '🌿',
            self::WATER => '💧',
            self::MOUNTAIN => '⛰️',
            self::FOREST => '🌲',
            self::DESERT => '🏜️',
            self::SWAMP => '🌾',
            self::TUNDRA => '🧊',
        };
    }

    public function cssClasses(): string
    {
        return match ($this) {
            self::GRASS => 'hexagon anima field-grass',     // Green
            self::WATER => 'hexagon anima field-water',     // Blue
            self::MOUNTAIN => 'hexagon anima field-mountain', // Orange/Yellow
            self::FOREST => 'hexagon anima field-forest',   // Green
            self::DESERT => 'hexagon anima field-desert',   // Sandy/Brown
            self::SWAMP => 'hexagon anima field-swamp',     // Dark Green/Brown
            self::TUNDRA => 'hexagon anima field-tundra',   // Light Blue/White
        };
    }
} 