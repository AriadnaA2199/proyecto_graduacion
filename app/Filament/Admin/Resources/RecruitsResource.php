<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RecruitsResource\Pages;
use App\Models\Recruits;
use App\Models\Roster;
use App\Models\Trainings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RecruitsResource extends Resource
{
    protected static ?string $model = Recruits::class;

    protected static ?string $navigationIcon = 'phosphor-student-fill';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('training_id')
                    ->label('Training')
                    ->options(Trainings::all()->pluck('training_id', 'training_id'))
                    ->required(),

                Forms\Components\Select::make('roster_id')
                    ->label('Roster (Recluta)')
                    ->options(Roster::where('profile', 'recluta')->pluck('full_name', 'employee_id'))
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $roster = Roster::find($state);
                        if ($roster) {
                            $set('full_name', $roster->full_name); // Establecer el nombre completo
                            $set('hiring_date', $roster->hiring_date); // Establecer la fecha de contratación
                        }
                    }),

                // Campo de full_name que se autocompleta y se deshidrata para ser enviado
                Forms\Components\TextInput::make('full_name')
                    ->label('Full Name')
                    ->required()
                    ->disabled() // Solo lectura
                    ->dehydrated(true), // Asegurarse de que se envíe al servidor

                // Campo de hiring_date que se autocompleta y se deshidrata para ser enviado
                Forms\Components\DatePicker::make('hiring_date')
                    ->label('Hiring Date')
                    ->required()
                    ->disabled() // Solo lectura
                    ->dehydrated(true), // Asegurarse de que se envíe al servidor

                // Campo para recruit_id, generado automáticamente con training_id y roster_id
                Forms\Components\TextInput::make('recruit_id')
                    ->label('Recruit ID')
                    ->disabled() // Generado automáticamente, no editable por el usuario
                    ->default(function ($get) {
                        $trainingId = $get('training_id');
                        $rosterId = $get('roster_id');
                        if ($trainingId && $rosterId) {
                            // Generar Recruit ID concatenando training_id + roster_id
                            return $trainingId.'-'.$rosterId;
                        }

                        return '';
                    })
                    ->dehydrated(true), // Asegurarse de que se envíe al servidor
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('recruit_id')
                    ->label('Recruit ID')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('roster.full_name')
                    ->label('Roster Full Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('training.training_id')
                    ->label('Training ID')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('hiring_date')
                    ->label('Hiring Date')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                // Agrega filtros si es necesario
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageRecruits::route('/'),
        ];
    }
}
