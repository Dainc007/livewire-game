<?php

namespace App\Livewire;

use App\Models\Game;
use Carbon\Carbon;
use Livewire\Component;

class Timer extends Component
{
    public Game $game;
    public $time;

    public function render()
    {
        return view('livewire.timer');
    }

    public function mount()
    {
        $this->time = Carbon::createFromTimeString('00:00:00');
    }

    public function refreshTimer()
    {
        if($this->game->status === 'running') {
            $this->time = $this->time->addSecond();
        }
    }

    public function updateGameStatus(string $status)
    {
        $this->game->update(['status' => $status]);
    }
}
