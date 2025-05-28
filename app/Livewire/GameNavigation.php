<?php

namespace App\Livewire;

use App\Models\Game;
use App\Models\Good;
use Livewire\Component;

class GameNavigation extends Component
{
    public Game $game;
    public $resources = [];
    public $goods = [];
    public $currentTime = '00:00:00';

    public function mount()
    {
        $this->game = new Game(['status' => 'lobbying']);
        $this->game->save();
        $this->goods = Good::all();
    }

    public function render()
    {
        return view('livewire.game-navigation');
    }
}
