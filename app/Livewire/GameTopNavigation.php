<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Building;
use App\Models\Game;
use App\Models\Good;
use App\Models\Unit;
use Exception;
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

        try {
            $buildingsIds = $this->game->resources()
                ->where('resourceable_type', Building::class)
                ->where('user_id', Auth::id())
                ->where('value', '>', 0)
                ->pluck('resourceable_id');

            if ($buildingsIds->count() > 0) {
                $this->game->resources()
                    ->where('resourceable_type', Good::class)
                    ->where('user_id', Auth::id())
                    ->whereIn('resourceable_id', $buildingsIds)
                    ->increment('value', 1);
            }

            // Update units
            // $this->game->resources()
            //     ->where('resourceable_type', Unit::class)
            //     ->where('user_id', Auth::id())
            //     ->where('value', '>', 0)
            //     ->increment('value', 1);

            // // Update buildings
            // $this->game->resources()
            //     ->where('resourceable_type', Building::class)
            //     ->where('user_id', Auth::id())
            //     ->where('value', '>', 0)
            //     ->increment('value', 1);

            $this->refreshResources();
        } catch (Exception $e) {

        }
    }

    public function refreshResources(): void
    {
        try {
            $resources = $this->game->resources()
                ->where('user_id', Auth::id())
                ->with('resourceable')
                ->get();
            if ($resources->isEmpty()) {

                return;
            }

            $this->resources = $resources
                ->groupBy(function ($resource) {
                    return mb_strtolower(class_basename($resource->resourceable_type));
                })
                ->map(function ($resources) {
                    return $resources->map(function ($resource) {
                        if (! $resource->resourceable) {

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

        } catch (Exception $e) {

        }
    }
}
