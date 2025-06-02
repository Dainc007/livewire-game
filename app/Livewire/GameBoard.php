<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Game;
use App\Services\MapGenerationService;
use Filament\Widgets\Widget;

final class GameBoard extends Widget
{
    public array $map = [];

    public Game $game;

    protected static string $view = 'livewire.game-board';

    protected static ?string $title = 'Game Board';

    protected static ?string $description = 'Game Board';

    protected string|int|array $columnSpan = 'full';

    public function mount(): void
    {
        $this->loadMap();
    }

    public function loadMap(): void
    {
        $this->map = (new MapGenerationService())->generateMapForGame($this->game);
    }

    public function triggerBuildModal($fieldId): void
    {
        $this->dispatch('open-build-modal', fieldId: $fieldId);
    }
}
