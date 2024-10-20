<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SupervisorsResource\Pages;
use App\Models\Roster;
use App\Models\Supervisors;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SupervisorsResource extends Resource
{
    protected static ?string $model = Supervisors::class;

    protected static ?string $navigationIcon = 'phosphor-eyeglasses-fill';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('supervisor_id')->required(),
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('roster_id')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('supervisor_id')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('roster_id')
                    ->label('Program')
                    ->getStateUsing(function ($record) {
                        // Buscar el Roster y retornar el programa asociado
                        $roster = Roster::find($record->roster_id);

                        return $roster ? $roster->program : 'N/A'; // Devuelve el programa o 'N/A' si no hay programa
                    })
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->url(fn ($record) => route('filament.admin.resources.rosters.index', ['edit' => $record->roster_id]))
                    ->label('Edit in Roster'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSupervisors::route('/'),
        ];
    }
}
