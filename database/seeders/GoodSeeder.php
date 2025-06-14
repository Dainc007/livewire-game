<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\GoodType;
use App\Models\Good;
use Illuminate\Database\Seeder;

final class GoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $goods = [];
        foreach (GoodType::getAllCases() as $goodType) {
            $goods[] = [
                'name' => $goodType->value,
                'description' => $goodType->description(),
                'icon' => $goodType->icon(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (! empty($goods)) {
            Good::insert($goods);
        }
    }
}
