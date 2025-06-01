<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\GameResource\Pages;

use App\Filament\App\Resources\GameResource;
use App\Models\Building;
use App\Models\Game;
use App\Models\Good;
use App\Models\Unit;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

final class ManageGames extends ManageRecords
{
    protected static string $resource = GameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->after(function (Game $record): void {
                    $record->load('users');
                    $record->users()->each(function ($user) use ($record): void {
                        Good::all()->map(fn($good) => $record->resources()->create([
                            'user_id' => $user->id,
                            'resourceable_id' => $good->id,
                            'resourceable_type' => Good::class,
                            'value' => 0,
                        ]));
                        Unit::all()->map(fn($unit) => $record->resources()->create([
                            'user_id' => $user->id,
                            'resourceable_id' => $unit->id,
                            'resourceable_type' => Unit::class,
                            'value' => 0,
                        ]));
                        Building::all()->map(fn($building) => $record->resources()->create([
                            'user_id' => $user->id,
                            'resourceable_id' => $building->id,
                            'resourceable_type' => Building::class,
                            'value' => 0,
                        ]));
                    });
                }),
        ];
    }
}
