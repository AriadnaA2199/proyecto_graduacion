<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RosterResource\Pages;
use App\Models\Programs;
use App\Models\Roster;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RosterResource extends Resource
{
    protected static ?string $model = Roster::class;

    protected static ?string $navigationIcon = 'phosphor-users-four-fill';

    // Sobrescribe las etiquetas (labels) de singular y plural
    public static function getLabel(): string
    {
        return 'Empleado';
    }

    public static function getPluralLabel(): string
    {
        return 'Empleados';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('employee_id')
                    ->label('Employee ID')
                    ->required()
                    ->default(function () {
                        $lastEmployee = Roster::orderBy('employee_id', 'desc')->first();
                        $nextNumber = $lastEmployee ? (int) substr($lastEmployee->employee_id, 3) + 1 : 1;

                        return 'CW-'.str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
                    })
                    ->disabled()
                    ->dehydrated(true),

                Forms\Components\TextInput::make('full_name')
                    ->label('Full Name')
                    ->required(),

                Forms\Components\Select::make('profile')
                    ->label('Profile')
                    ->options([
                        'recluta' => 'Recluta',
                        'supervisor' => 'Supervisor',
                        'entrenador' => 'Entrenador',
                        'asesor' => 'Asesor',
                    ])
                    ->required(),

                Forms\Components\Select::make('program')
                    ->label('Program')
                    ->options(Programs::all()->pluck('name', 'program_id'))
                    ->required()
                    ->helperText('Selecciona el programa al que pertenece el empleado.')
                    ->dehydrated(true),

                Forms\Components\DatePicker::make('hiring_date')
                    ->label('Hiring Date')
                    ->required()
                    ->rule('after_or_equal:today')
                    ->helperText('La fecha debe ser igual o mayor al día de hoy.'),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'Active' => 'Active',
                        'Terminated' => 'Terminated',
                    ])
                    ->required(),

                Forms\Components\DatePicker::make('termination_date')
                    ->label('Termination Date')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee_id')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('full_name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('profile')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('program')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('hiring_date')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('status')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('termination_date')->sortable()->searchable(),
            ])
            ->defaultSort('employee_id', 'asc')
            ->filters([
                //
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
            'index' => Pages\ManageRosters::route('/'),
        ];
    }
}
