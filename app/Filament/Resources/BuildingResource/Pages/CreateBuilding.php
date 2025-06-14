<?php

declare(strict_types=1);

namespace App\Filament\Resources\BuildingResource\Pages;

use App\Filament\Resources\BuildingResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateBuilding extends CreateRecord
{
    protected static string $resource = BuildingResource::class;
}
