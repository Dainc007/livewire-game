<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Game;
use Livewire\Component;

final class DateCounter extends Component
{
    public Game $game;

    public int $year = 1;

    public int $dayCount = 1;

    public bool $isDay = true;

    public string $season = 'winter';

    public function refreshDate(): void
    {
        if ($this->game->status !== 'running') {
            return;
        }

        $this->isDay = ! $this->isDay;
        $this->dayCount++;

        switch (true) {
            case $this->dayCount <= 81:
                $this->season = 'winter';
                break;
            case $this->dayCount <= 173:
                $this->season = 'spring';
                break;
            case $this->dayCount <= 267:
                $this->season = 'summer';
                break;
            case $this->dayCount <= 356:
                $this->season = 'autumn';
                break;
            case $this->dayCount >= 365:
                $this->dayCount = 1;
                $this->year++;
                $this->season = 'winter';
                break;
        }
    }
}
