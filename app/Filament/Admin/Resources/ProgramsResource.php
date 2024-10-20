<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProgramsResource\Pages;
use App\Models\Programs;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Table;

class ProgramsResource extends Resource
{
    protected static ?string $model = Programs::class;

    protected static ?string $navigationIcon = 'phosphor-folder-plus-fill';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('program_id')
                    ->label('Program ID')
                    ->disabled()
                    ->helperText('Este campo se generará automáticamente como las dos primeras letras del país + el nombre del programa.'),

                Forms\Components\TextInput::make('name')
                    ->label('Program Name')
                    ->required()
                    ->helperText('Introduce el nombre completo del programa.'),

                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->required()
                    ->helperText('Añade una breve descripción del programa.'),

                Forms\Components\Select::make('country_id')
                    ->label('Country')
                    ->relationship('country', 'name')
                    ->required()
                    ->helperText('Selecciona el país al que pertenece este programa.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('program_id')
                    ->label('Program ID')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Program Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('country.name')
                    ->label('Country')
                    ->sortable()
                    ->searchable(),
            ])
            ->defaultSort('program_id', 'asc')
            ->actions([
                ViewAction::make()->tooltip('Ver detalles'),
                EditAction::make()->tooltip('Editar'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePrograms::route('/'),
            // Elimina la ruta de 'create'
            'edit' => Pages\EditPrograms::route('/{record}/edit'),
            'view' => Pages\ViewPrograms::route('/{record}'),
        ];
    }
}
