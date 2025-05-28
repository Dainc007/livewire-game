<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Good extends Model
{
    public function games()
    {
        return $this->belongsToMany(Game::class)
            ->using(GameGood::class)
            ->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->using(GameGood::class)
            ->withTimestamps();
    }
}
