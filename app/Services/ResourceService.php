<?php

namespace App\Services;

use App\Models\Game;
use App\Models\User;
use App\Models\Good;
use App\Models\Unit;
use App\Models\Building;
use Illuminate\Support\Facades\Log;

class ResourceService
{

    /**
     * Create a new class instance.
     */
    public function __construct(
        protected Game $record,
        protected User $user,
    )
    {
    }

    public function createManyGoods(): static
    {
        $goods = [];
        Good::isActive()->get()->each(function($good) use (&$goods) {
            $goods[] = [
                'game_id' => $this->record->id,
                'user_id' => $this->user->id,
                'resourceable_id' => $good->id,
                'resourceable_type' => Good::class,
                'value' => 0,
            ];
        });

        Log::info('Creating goods:', ['goods' => $goods]);
        $this->record->resources()->createMany($goods);

        return $this;
    }

    public function createManyUnits()
    {
        $units = [];
        Unit::isActive()->get()->each(function($unit) use (&$units) {
            $units[] = [
                'game_id' => $this->record->id,
                'user_id' => $this->user->id,
                'resourceable_id' => $unit->id,
                'resourceable_type' => Unit::class,
                'value' => 0,
            ];
        });

        Log::info('Creating units:', ['units' => $units]);
        $this->record->resources()->createMany($units);

        return $this;
    }

    public function createManyBuildings()
    {
        $buildings = [];
        Building::isActive()->get()->each(function($building) use (&$buildings) {
            $buildings[] = [
                'game_id' => $this->record->id,
                'user_id' => $this->user->id,
                'resourceable_id' => $building->id,
                'resourceable_type' => Building::class,
                'value' => 0,
            ];
        });

        Log::info('Creating buildings:', ['buildings' => $buildings]);
        $this->record->resources()->createMany($buildings);

        return $this;
    }
}
