<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

final class GameUser extends Pivot
{
    protected $table = 'game_user';

    protected $casts = [
        'goods' => 'array',
        'units' => 'array',
        'buildings' => 'array',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'goods' => 'array',
            'units' => 'array',
            'buildings' => 'array',
        ];
    }
}
