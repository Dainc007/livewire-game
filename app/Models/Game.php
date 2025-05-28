<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Game extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class)
            ->using(GameUser::class)
            ->withTimestamps();
    }

    public function goods()
    {
        return $this->belongsToMany(Good::class)
            ->using(GameGood::class)
            ->withTimestamps();
    }
}
