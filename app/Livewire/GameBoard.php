<?php

declare(strict_types=1);

namespace App\Livewire;

use Livewire\Component;

final class GameBoard extends Component
{
    public array $map = [];

    public int $selectedField;

    public bool $showModal = false;

    public function mount(): void
    {
        $this->generateMap();
    }

    public function generateMap(): void
    {
        $id = 1;
        $this->map = collect(range(0, 29))->map(function ($col) use (&$id) {
            return collect(range(0, 15))->map(function ($row) use (&$id): array {
                return [
                    'id' => $id++,
                    'classes' => 'hexagon anima success',
                    'icon' => '',
                ];
            })->all();
        })->all();
    }

    public function selectField(int $id): void
    {
        $this->showModal = true;
        $this->selectedField = $id;
    }
}
