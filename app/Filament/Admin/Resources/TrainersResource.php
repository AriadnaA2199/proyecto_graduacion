<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TrainersResource\Pages;
use App\Models\Trainers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TrainersResource extends Resource
{
    protected static ?string $model = Trainers::class;

    protected static ?string $navigationIcon = 'phosphor-graduation-cap-fill';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('trainer_id')->required(),
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('program')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('trainer_id')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('program')->sortable()->searchable(), // Cambiamos a 'program'
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->url(fn ($record) => route('filament.admin.resources.rosters.index', ['edit' => $record->trainer_id]))  // Redirige a la vista de rosters con el parámetro de edición (trainer_id)
                    ->label('Edit Roster'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTrainers::route('/'),
        ];
    }
}
