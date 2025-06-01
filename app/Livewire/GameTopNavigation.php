<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Building;
use App\Models\Game;
use App\Models\Unit;
use App\Models\User;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;
use App\Models\Good;

final class GameTopNavigation extends Widget
{
    public Game $game;

    public $user;

    protected static string $view = 'livewire.game-top-navigation';

    protected string|int|array $columnSpan = 'full';

    public function mount(Game $game): void
    {
        $this->game = $game;
        $this->user = $this->game->resources()
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

    public function updateGoods(): void
    {
        //
    }
}
