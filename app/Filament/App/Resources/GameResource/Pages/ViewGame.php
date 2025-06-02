<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\GameResource\Pages;

use App\Filament\App\Resources\GameResource;
use App\Livewire\GameBoard;
use App\Livewire\GameTopNavigation;
use App\Models\Building;
use Filament\Actions;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ViewField;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

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
                ->modalHeading('What should we build?')
                ->modalDescription('We are ready for your order!')
                ->modalSubmitActionLabel('Let\'s build!')
                ->modalIcon('heroicon-o-home')
                ->modalWidth(MaxWidth::Medium)
                ->form([
                    Select::make('buildings')
                        ->searchable()
                        ->selectablePlaceholder(false)
                        ->label('Buildings')
//                        ->multiple()
                        ->options(
                            Building::query()
                                ->get()
                                ->mapWithKeys(function ($building) {
                                    return [
                                        $building->id => $building->icon . ' ' . $building->name,
                                    ];
                                })
                        )
                        ->required(),
                    Radio::make('buildings')
                        ->label('Choose your building')
                        ->options(
                            Building::query()
                                ->get()
                                ->mapWithKeys(function ($building) {
                                    return [$building->id => $building->icon];
                                })
                        )
                        ->descriptions(
                            Building::query()
                                ->get()
                                ->mapWithKeys(function ($building) {
                                    return [$building->id => $building->name];
                                })
                        )
                        ->columns(3)
                        ->inlineLabel(false)
                        //use this when there is not enough resources.
//                        ->disableOptionWhen(fn (string $value): bool => $value === 'published')
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

    #[On('open-build-modal')]
    public function openBuildModal($fieldId)
    {
        $this->fieldId = $fieldId;
        $this->mountAction('build');
    }
}
