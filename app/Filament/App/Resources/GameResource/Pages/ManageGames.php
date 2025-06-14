<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\GameResource\Pages;

use App\Filament\App\Resources\GameResource;
use App\Models\Game;
use App\Services\ResourceService;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Support\Facades\Log;

final class ManageGames extends ManageRecords
{
    protected static string $resource = GameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->after(function (Game $record): void {
                    $record->load('users');

                    // Debug the game and users
                    Log::info('Creating resources for game:', [
                        'game_id' => $record->id,
                        'users' => $record->users->pluck('id')->toArray(),
                    ]);

                    $record->users()->each(function ($user) use ($record): void {
                        $resourceService = new ResourceService($record, $user);

                        // Debug before creating resources
                        Log::info('Creating resources for user:', [
                            'user_id' => $user->id,
                            'game_id' => $record->id,
                        ]);

                        $resourceService->createManyGoods()
                            ->createManyUnits()
                            ->createManyBuildings();

                        // Debug after creating resources
                        $resources = $record->resources()
                            ->where('user_id', $user->id)
                            ->with('resourceable')
                            ->get();

                        Log::info('Created resources:', [
                            'resources' => $resources->toArray(),
                        ]);
                    });
                }),
        ];
    }
}
