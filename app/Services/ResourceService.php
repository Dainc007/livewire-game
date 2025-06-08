<?php

namespace App\Services;

use App\Models\Game;
use App\Models\User;

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

    public function createManyGoods()
    {
        $goods = [];
        Good::isActive()->get()->map(fn($good) => $goods[] = [
            'user_id' => $user->id,
            'resourceable_id' => $good->id,
            'resourceable_type' => Good::class,
            'value' => 0,
        ]);
        $record->resources()->createMany($goods);

        return $this;
    }

    public function createManyUnits()
    {
        $units = [];
        Unit::isActive()->get()->map(fn($unit) => $units[] = [
            'user_id' => $user->id,
            'resourceable_id' => $unit->id,
            'resourceable_type' => Unit::class,
            'value' => 0,
        ]);
        $record->resources()->createMany($units);

        return $this;
    }

    public function createManyBuildings()
    {
        $buildings = [];
        Building::isActive()->get()->map(fn($building) => $buildings[] = [
            'user_id' => $user->id,
            'resourceable_id' => $building->id,
            'resourceable_type' => Building::class,
            'value' => 0,
        ]);
        $record->resources()->createMany($buildings);

        return $this;
    }
}
