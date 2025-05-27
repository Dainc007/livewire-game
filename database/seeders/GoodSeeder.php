<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Good;
use App\Enums\GoodType;

class GoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing good names to avoid duplicates
        $existingGoods = Good::pluck('name')->toArray();

        // Create goods data from enum
        $goods = [];

        foreach (GoodType::getAllCases() as $goodType) {
            // Skip if good already exists
            if (in_array($goodType->value, $existingGoods)) {
                continue;
            }

            $goods[] = [
                'name' => $goodType->value,
                'description' => $goodType->description(),
                'icon' => $goodType->icon(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert all new goods at once if there are any
        if (!empty($goods)) {
            Good::insert($goods);
        }
    }
}
