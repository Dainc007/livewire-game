<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

final class Good extends Model
{
    public function games()
    {
        return $this->belongsToMany(Game::class)
            ->using(self::class)
            ->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->using(self::class)
            ->withTimestamps();
    }

    public function gameResources(): MorphMany
    {
        return $this->morphMany(GameResource::class, 'resourceable');
    }
}
