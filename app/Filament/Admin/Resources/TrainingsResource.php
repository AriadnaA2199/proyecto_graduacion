<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TrainingsResource\Pages;
use App\Models\Departments; // Importamos el modelo Programs
use App\Models\Programs;
use App\Models\Trainers;
use App\Models\Trainings;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TrainingsResource extends Resource
{
    protected static ?string $model = Trainings::class;

    protected static ?string $navigationIcon = 'phosphor-chalkboard-teacher-fill';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Mostrar el campo training_id como sólo lectura (visible pero no editable)
                Forms\Components\TextInput::make('training_id')
                    ->label('Training ID')
                    ->disabled()
                    ->visible(fn ($record) => $record != null) // Solo visible si hay un registro
                    ->required(),

                Forms\Components\DatePicker::make('start_training_date')
                    ->label('Start Training Date')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function (callable $set, $state) {
                        if ($state) {
                            $startDate = Carbon::parse($state);
                            $set('end_training_date', $startDate->copy()->addDays(5)->toDateString());
                            $set('start_transition_date', $startDate->copy()->addDays(5)->toDateString());
                            $set('end_transition_date', $startDate->copy()->addDays(10)->toDateString());
                            $set('start_production_date', $startDate->copy()->addDays(11)->toDateString());
                        }
                    }),

                Forms\Components\DatePicker::make('end_training_date')
                    ->label('End Training Date')
                    ->required(),

                Forms\Components\DatePicker::make('start_transition_date')
                    ->label('Start Transition Date')
                    ->required(),

                Forms\Components\DatePicker::make('end_transition_date')
                    ->label('End Transition Date')
                    ->required(),

                Forms\Components\DatePicker::make('start_production_date')
                    ->label('Start Production Date')
                    ->required(),

                // Guardar el program_id en lugar del nombre del programa
                Forms\Components\Select::make('program')
                    ->label('Program')
                    ->options(Programs::all()->pluck('name', 'program_id')) // Mostrar el nombre pero guardar el program_id
                    ->required(),

                Forms\Components\Select::make('trainer_name')
                    ->label('Trainer')
                    ->options(Trainers::all()->pluck('name', 'name'))
                    ->required(),

                Forms\Components\TextInput::make('class_type')->required(),

                // Guardar el id del departamento
                Forms\Components\Select::make('department_id')
                    ->label('Department')
                    ->options(Departments::all()->pluck('department_name', 'id')) // Mostrar el nombre pero guardar el id
                    ->required()
                    ->helperText('Selecciona el departamento utilizando su nombre.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('training_id')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('start_training_date')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('end_training_date')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('start_transition_date')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('end_transition_date')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('start_production_date')->sortable()->searchable(),

                Tables\Columns\TextColumn::make('program.name')->sortable()->searchable(), // Mostrar el nombre del programa

                Tables\Columns\TextColumn::make('trainer_name')->sortable()->searchable(),

                Tables\Columns\TextColumn::make('class_type')->sortable()->searchable(),

                Tables\Columns\TextColumn::make('department.department_name')->sortable()->searchable(),
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

    public static function getRelations(): array
    {
        return [
            // Define relaciones si es necesario
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrainings::route('/'),
            'create' => Pages\CreateTrainings::route('/create'),
            'view' => Pages\ViewTrainings::route('/{record}'),
            'edit' => Pages\EditTrainings::route('/{record}/edit'),
        ];
    }
}
