<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

final class Unit extends Model
{
    public function gameResources(): MorphMany
    {
        return $this->morphMany(GameResource::class, 'resourceable');
    }

    public function costs(): MorphMany
    {
        return $this->morphMany(Costable::class, 'costable');
    }

    public function goods()
    {
        return $this->morphToMany(Good::class, 'costable')
            ->withPivot('amount')
            ->withTimestamps();
    }

    #[Scope]
    protected function isActive(Builder $query): void
    {
        $query->where('is_active', 1);
    }
}
