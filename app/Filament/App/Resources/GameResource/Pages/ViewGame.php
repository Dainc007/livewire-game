<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\GameResource\Pages;

use App\Filament\App\Resources\GameResource;
use App\Livewire\GameBoard;
use App\Livewire\GameTopNavigation;
use App\Models\Building;
use App\Models\Field;
use Filament\Actions;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

final class ViewGame extends ViewRecord
{
    public int $selectedField = 0;

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

    #[On('open-build-modal')]
    public function openBuildModal(int $fieldId): void
    {
        $this->selectedField = $fieldId;
        $this->mountAction('build');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('build')
                ->extraAttributes(['style' => 'display: none;'])
                ->slideOver()
                ->modalHeading(function () {
                    $field = Field::findOrFail($this->selectedField);

                    return mb_strtoupper($field->field_type);
                })
                ->modalDescription(function ($record) {
                    $resources = $record
                        ->resources()
                        ->where('field_id', $this->selectedField)
                        ->with('resourceable')
                        ->get();

                    if ($resources->isEmpty()) {
                        return '';
                    }

                    return $resources
                        ->map(function ($resource): string {
                            return $resource->resourceable->icon.' '.$resource->resourceable->name;
                        })->join(PHP_EOL);
                })
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
                                        $building->id => $building->icon.' '.$building->name,
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
                        // use this when there is not enough resources.
//                        ->disableOptionWhen(fn (string $value): bool => $value === 'published')
                        ->required(),
                ])
                ->action(function (array $data, $record, $livewire): Notification {
                    $record->resources()->where('user_id', Auth::id())
                        ->where('resourceable_type', Building::class)
                        ->where('resourceable_id', $data['buildings'])
                        ->update([
                            'value' => 1,
                            'field_id' => $livewire->selectedField,
                        ]);

                    return Notification::make()
                        ->title(__('brawo!'))
                        ->body('budynek zbudowany')
                        ->success()->send();
                }),
        ];
    }
}
