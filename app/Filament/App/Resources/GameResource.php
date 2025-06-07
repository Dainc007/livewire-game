<?php

declare(strict_types=1);

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\GameResource\Pages;
use App\Models\Game;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

final class GameResource extends Resource
{
    protected static ?string $model = Game::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('status')
                    ->default('lobbying')
                    ->readOnly(),
                Forms\Components\Select::make('visibility')->options([
                    'public' => 'Public',
                    'private' => 'Private',
                ])
                    ->hiddenOn('view')
                    ->default('public'),
                Forms\Components\Select::make('users')
                    ->default(fn (): array => [auth()->id()])
                    ->required()
                    ->hiddenOn('view')
                    ->multiple()
                    ->preload()
            ->relationship('users', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('3s')
            ->modifyQueryUsing(function () {
                $games = Auth::user()->games;
                return $games && $games->isNotEmpty() ? $games->toQuery() : null;
            })
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('users.name'),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
//                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('No Games Yet')
            ->emptyStateDescription(__('Create one and join the fun!'))
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageGames::route('/'),
            'view' => Pages\ViewGame::route('/{record}'),
        ];
    }
}
