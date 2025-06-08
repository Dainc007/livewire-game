<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Scope;

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

        /**

     * Scope a query to only include active users.

     */

     #[Scope]
     protected function isActive(Builder $query): void
     {
        $query->where('is_active', 1); 
     }
}
