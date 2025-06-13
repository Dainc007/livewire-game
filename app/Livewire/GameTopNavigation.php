<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Game;
use App\Models\Good;
use App\Models\Unit;
use App\Models\Building;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

        try {
            // Update goods
            $this->game->resources()
                ->where('resourceable_type', Good::class)
                ->where('user_id', Auth::id())
                ->increment('value', 1);

            // Update units
            $this->game->resources()
                ->where('resourceable_type', Unit::class)
                ->where('user_id', Auth::id())
                ->where('value', '>', 0)
                ->increment('value', 1);

            // Update buildings
            $this->game->resources()
                ->where('resourceable_type', Building::class)
                ->where('user_id', Auth::id())
                ->where('value', '>', 0)
                ->increment('value', 1);

            $this->refreshResources();
        } catch (\Exception $e) {
            Log::error('Error updating resources:', [
                'error' => $e->getMessage(),
                'game_id' => $this->game->id,
                'user_id' => Auth::id()
            ]);
        }
    }

    public function refreshResources(): void
    {
        try {
            $resources = $this->game->resources()
                ->where('user_id', Auth::id())
                ->with('resourceable')
                ->get();

            // Debug the raw resources
            Log::info('Raw resources:', [
                'game_id' => $this->game->id,
                'user_id' => Auth::id(),
                'resources' => $resources->toArray()
            ]);

            if ($resources->isEmpty()) {
                Log::warning('No resources found for game:', [
                    'game_id' => $this->game->id,
                    'user_id' => Auth::id()
                ]);
                return;
            }

            $this->resources = $resources
                ->groupBy(function ($resource) {
                    return strtolower(class_basename($resource->resourceable_type));
                })
                ->map(function ($resources) {
                    return $resources->map(function ($resource) {
                        if (!$resource->resourceable) {
                            Log::warning('Resourceable not found:', [
                                'resource_id' => $resource->id,
                                'resourceable_type' => $resource->resourceable_type,
                                'resourceable_id' => $resource->resourceable_id
                            ]);
                            return null;
                        }

                        return (object) [
                            'id' => $resource->resourceable_id,
                            'value' => $resource->value,
                            'name' => $resource->resourceable->name,
                            'icon' => $resource->resourceable->icon,
                        ];
                    })->filter();
                });

            // Debug the grouped resources
            Log::info('Grouped resources:', [
                'game_id' => $this->game->id,
                'user_id' => Auth::id(),
                'resources' => $this->resources->toArray()
            ]);
        } catch (\Exception $e) {
            Log::error('Error refreshing resources:', [
                'error' => $e->getMessage(),
                'game_id' => $this->game->id,
                'user_id' => Auth::id()
            ]);
        }
    }
}
