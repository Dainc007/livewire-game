<?php

declare(strict_types=1);

namespace App\Filament\Resources\BuildingResource\Pages;

use App\Filament\Resources\BuildingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

final class ListBuildings extends ListRecords
{
    protected static string $resource = BuildingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
