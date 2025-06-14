<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\BuildingType;
use App\Models\Building;
use Illuminate\Database\Seeder;

final class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buildings = [];
        foreach (BuildingType::getAllCases() as $buildingType) {
            $buildings[] = [
                'name' => $buildingType->value,
                'type' => $buildingType->value,
                'description' => $buildingType->description(),
                'icon' => $buildingType->icon(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (! empty($buildings)) {
            Building::insert($buildings);
        }
    }
}
