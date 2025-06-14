<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Building;
use App\Models\Good;
use Illuminate\Database\Seeder;

final class BuildingCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wood = Good::where('name', 'wood')->first();
        $gold = Good::where('name', 'gold')->first();

        if (! $wood || ! $gold) {
            return;
        }

        Building::all()->each(function (Building $building) use ($wood, $gold) {
            // Add wood cost
            $building->goods()->attach($wood->id, [
                'amount' => rand(1, 10),
            ]);

            // Add gold cost
            $building->goods()->attach($gold->id, [
                'amount' => rand(1, 10),
            ]);
        });
    }
}
