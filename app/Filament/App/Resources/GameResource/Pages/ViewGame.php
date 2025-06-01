<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\GameResource\Pages;

use App\Filament\App\Resources\GameResource;
use App\Livewire\GameBoard;
use App\Livewire\GameTopNavigation;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

final class ViewGame extends ViewRecord
{
    protected static string $resource = GameResource::class;

    public function getFooterWidgets(): array
    {
        return [
            GameTopNavigation::make([
                'game' => $this->record,
            ]),
            GameBoard::make([
                'game' => $this->record,
            ]),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
//            Actions\EditAction::make(),
        ];
    }
}
