<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

final class Building extends Model
{
    public function gameResources(): MorphMany
    {
        return $this->morphMany(GameResource::class, 'resourceable');
    }
}
