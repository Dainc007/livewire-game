<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Game;
use App\Models\Good;
use Livewire\Component;

final class GameNavigation extends Component
{
    public Game $game;


    public function mount(?Game $game = null): void 
    {
        $this->game = $game ?? (function() {
            $game = new Game(['status' => 'lobbying']);
            $game->save();
            return $game;
        })();
    }

    public function updateGoods(): void
    {
        //
    }
}
