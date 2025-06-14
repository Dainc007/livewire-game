<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

final class Costable extends Model
{
    public function good(): BelongsTo
    {
        return $this->belongsTo(Good::class);
    }

    public function costable(): MorphTo
    {
        return $this->morphTo();
    }
}
