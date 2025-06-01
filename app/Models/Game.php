<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Game extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class)
            ->using(GameUser::class)
            ->withTimestamps();
    }

    public function games()
    {
        return $this->belongsToMany(self::class)
            ->using(GameUser::class)
            ->withTimestamps();
    }

    public function resources(): HasMany
    {
        return $this->hasMany(GameResource::class);
    }
}
