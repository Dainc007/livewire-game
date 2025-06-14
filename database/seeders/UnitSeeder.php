<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\UnitType;
use App\Models\Unit;
use Illuminate\Database\Seeder;

final class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [];
        foreach (UnitType::getAllCases() as $unitType) {
            $units[] = [
                'name' => $unitType->value,
                'description' => $unitType->description(),
                'icon' => $unitType->icon(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (! empty($units)) {
            Unit::insert($units);
        }
    }
}
