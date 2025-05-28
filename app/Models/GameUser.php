<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GameUser extends Pivot
{
    protected $table = 'game_user';

    protected $fillable = [
        'game_id',
        'user_id',
        'goods',
        'units',
        'buildings',
    ];

    protected $casts = [
        'goods' => 'array',
        'units' => 'array',
        'buildings' => 'array',
    ];

    protected function casts(): array
    {
        return [
            'goods' => 'array',
            'units' => 'array',
            'buildings' => 'array',
        ];
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
