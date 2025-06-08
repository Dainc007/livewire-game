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
                        $resourceService = new ResourceService($record, $user);
                        $resourceService->createManyGoods()
                            ->createManyUnits()
                            ->createManyBuildings();
                    });
                }),
        ];
    }
}
