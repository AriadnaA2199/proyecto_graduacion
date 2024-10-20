<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DepartmentsResource\Pages;
use App\Models\Departments;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;

class DepartmentsResource extends Resource
{
    protected static ?string $model = Departments::class;

    protected static ?string $navigationIcon = 'heroicon-c-presentation-chart-line';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('department_name')
                    ->label('Department Name')
                    ->required()
                    ->maxLength(100) // Limitar la longitud a 100 caracteres
                    ->placeholder('Enter the department name')
                    ->helperText('Maximum of 100 characters.'),

                Forms\Components\TextInput::make('department_code')
                    ->label('Department Code')
                    ->required()
                    ->maxLength(10) // Código con máximo 10 caracteres
                    ->placeholder('Enter the department code')
                    ->helperText('Alphanumeric code with a max of 10 characters.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('department_code')
                    ->label('Department Code')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('department_name')
                    ->label('Department Name')
                    ->sortable()
                    ->searchable(),

            ])
            ->filters([
                // Puedes agregar filtros si es necesario en el futuro
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),

                // Nueva acción para redirigir al dashboard de Trainings
                Action::make('go_to_trainings')
                    ->label('Go to Trainings')
                    ->icon('heroicon-o-academic-cap') // Ícono representativo
                    ->url(fn () => route('filament.admin.resources.trainings.index')) // Ruta al dashboard de Trainings
                    ->color('success') // Color para destacar
                    ->tooltip('Go to the Trainings dashboard'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDepartments::route('/'),
            'create' => Pages\CreateDepartments::route('/create'),
            'view' => Pages\ViewDepartments::route('/{record}'),
            'edit' => Pages\EditDepartments::route('/{record}/edit'),
        ];
    }
}
