<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Game;

use App\Models\Good;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

final class GameTopNavigation extends Widget
{
    public Game $game;

    public $resources;

    protected static string $view = 'livewire.game-top-navigation';

    protected string|int|array $columnSpan = 'full';

    public function mount(Game $game): void
    {
        $this->game = $game;
        $this->refreshResources();
    }

    public function updateGoods(): void
    {
        if ($this->game->status !== 'running') {
          return;
        }

        $this->game->resources()
            ->where('resourceable_type', Good::class)
            ->where('user_id', Auth::id())
            ->increment('value', 1);
        $this->refreshResources();
    }

    public function refreshResources(): void
    {
        $this->resources = $this->game->resources()
            ->where('user_id', Auth::id())
            ->with('resourceable')
            ->get()
            ->groupBy(function ($resource) {
                return strtolower(class_basename($resource->resourceable_type));
            })
            ->map(function ($resources) {
                return $resources->map(function ($resource) {
                    return (object) [
                        'id' => $resource->resourceable_id,
                        'value' => $resource->value,
                        'name' => $resource->resourceable->name,
                        'icon' => $resource->resourceable->icon,
                    ];
                });
            });
    }
}
