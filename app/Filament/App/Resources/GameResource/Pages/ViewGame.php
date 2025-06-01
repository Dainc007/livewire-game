<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\GameResource\Pages;

use App\Filament\App\Resources\GameResource;
use App\Livewire\GameBoard;
use App\Livewire\GameTopNavigation;
use App\Models\Building;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Support\Facades\Auth;

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
            Actions\Action::make('build')
                ->slideOver()
                ->modalWidth(MaxWidth::Medium)
                ->form([
                    Select::make('buildings')
                        ->label('Buildings')
                        ->options(Building::query()->pluck('name', 'id'))
                        ->required(),
                ])
                ->action(function (array $data, $record): void {
                    $record->resources()->where('user_id', Auth::id())
                        ->where('resourceable_type', Building::class)
                        ->where('resourceable_id', $data['buildings'])
                        ->update(['value' => 1]);
                })
        ];
    }
}
