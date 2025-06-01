<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Game;
use Carbon\Carbon;
use Livewire\Component;

final class Timer extends Component
{
    public Game $game;

    public Carbon $time;

    public function mount(): void
    {
        $this->time = Carbon::createFromTimeString('00:00:00');
    }

    public function refreshTimer(): void
    {
        if ($this->game->status === 'running') {
            $this->time = $this->time->addSecond();
        }
    }

    public function updateGameStatus(string $status): void
    {
        $this->game->status = $status;
        $this->game->save();
    }
}
