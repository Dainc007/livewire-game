<?php

namespace App\Livewire;

use App\Models\Game;
use Livewire\Component;

class DateCounter extends Component
{
    public Game $game;
    public $year = 1;
    public $dayCount = 1;
    public $isDay = true;
    public $season = 'winter';

    public function render()
    {
        return view('livewire.date-counter');
    }

    public function refreshDate()
    {
        if($this->game->status !== 'running') return;

        $this->isDay = ! $this->isDay;
        $this->dayCount++;

        switch ($this->dayCount)
            {
            case $this->dayCount > 90:
                $this->season = 'winter';
                break;
            case $this->dayCount > 180:
                $this->season = 'spring';
                break;
            case $this->dayCount > 270:
                $this->season = 'summer';
                case $this->dayCount > 360:
                    $this->dayCount = 1;
    }
}
}
