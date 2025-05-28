<?php

declare(strict_types=1);

namespace App\Enums;

enum BuildingType: string
{
    // Core Buildings
    case CITY_HALL = 'city_hall';
    case HOUSE = 'house';
    case GRANARY = 'granary';
    case MARKET = 'market';

    // Resource Buildings
    case MINE = 'mine';
    case LUMBER_MILL = 'lumber_mill';
    case FARM = 'farm';
    case QUARRY = 'quarry';

    // Military Buildings
    case BARRACKS = 'barracks';
    case ARCHERY_RANGE = 'archery_range';
    case STABLE = 'stable';
    case SIEGE_WORKSHOP = 'siege_workshop';
    case WALLS = 'walls';

    // Cultural Buildings
    case LIBRARY = 'library';
    case THEATER = 'theater';
    case TEMPLE = 'temple';
    case UNIVERSITY = 'university';

    // Production Buildings
    case BLACKSMITH = 'blacksmith';
    case WORKSHOP = 'workshop';
    case POTTERY = 'pottery';

    public static function getAllCases(): array
    {
        return self::cases();
    }

    public function description(): string
    {
        return match ($this) {
            // Core Buildings
            self::CITY_HALL => 'Main administrative building',
            self::HOUSE => 'Provides housing for citizens',
            self::GRANARY => 'Stores food and increases food production',
            self::MARKET => 'Enables trade and generates gold',

            // Resource Buildings
            self::MINE => 'Extracts iron and stone',
            self::LUMBER_MILL => 'Processes wood from forests',
            self::FARM => 'Produces food for your population',
            self::QUARRY => 'Extracts stone from mountains',

            // Military Buildings
            self::BARRACKS => 'Trains basic military units',
            self::ARCHERY_RANGE => 'Trains archers',
            self::STABLE => 'Trains cavalry units',
            self::SIEGE_WORKSHOP => 'Produces siege weapons',
            self::WALLS => 'Defensive structure for your city',

            // Cultural Buildings
            self::LIBRARY => 'Generates science and knowledge',
            self::THEATER => 'Produces culture and entertainment',
            self::TEMPLE => 'Increases happiness and faith',
            self::UNIVERSITY => 'Advanced research and education',

            // Production Buildings
            self::BLACKSMITH => 'Produces weapons and tools',
            self::WORKSHOP => 'Crafts various items',
            self::POTTERY => 'Produces clay-based goods',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            // Core Buildings
            self::CITY_HALL => '🏛️',
            self::HOUSE => '🏠',
            self::GRANARY => '🌾',
            self::MARKET => '🏪',

            // Resource Buildings
            self::MINE => '⛏️',
            self::LUMBER_MILL => '🪵',
            self::FARM => '🌱',
            self::QUARRY => '⛰️',

            // Military Buildings
            self::BARRACKS => '⚔️',
            self::ARCHERY_RANGE => '🏹',
            self::STABLE => '🐎',
            self::SIEGE_WORKSHOP => '🎯',
            self::WALLS => '🏰',

            // Cultural Buildings
            self::LIBRARY => '📚',
            self::THEATER => '🎭',
            self::TEMPLE => '⛪',
            self::UNIVERSITY => '🎓',

            // Production Buildings
            self::BLACKSMITH => '⚒️',
            self::WORKSHOP => '🔨',
            self::POTTERY => '🏺',
        };
    }
}
