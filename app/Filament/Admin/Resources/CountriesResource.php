<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CountriesResource\Pages;
use App\Models\Countries;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CountriesResource extends Resource
{
    protected static ?string $model = Countries::class;

    protected static ?string $navigationIcon = 'phosphor-globe-fill'; // Blade Heroicons

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Country Name')
                    ->required()
                    ->maxLength(100)
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set, $state) => $set('slug', \Str::slug($state)))
                    ->placeholder('Enter country name')
                    ->helperText('Please enter the official name of the country.')
                    ->rules(['unique:countries,name']) // Verifica si el país ya existe exactamente
                    ->rule(function ($state) {
                        return function ($attribute, $value, $fail) {
                            // Buscar un país con un nombre similar
                            $existingCountry = Countries::where('name', 'LIKE', "%{$value}%")->first();
                            if ($existingCountry) {
                                $fail('Este país ya está en el catálogo.');
                            }
                        };
                    }),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Country Name')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('recent')
                    ->label('Recently Added')
                    ->query(fn (Builder $query) => $query->where('created_at', '>=', now()->subMonth()))
                    ->toggle(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->icon('heroicon-o-eye'), // Aquí usamos un Blade Heroicon para el ícono de vista
                Tables\Actions\EditAction::make()
                    ->icon('heroicon-o-pencil'), // Blade Heroicon para la acción de editar
                Tables\Actions\Action::make('view_on_map')
                    ->label('View on Map')
                    ->icon('heroicon-o-globe-americas') // Blade Heroicon para la acción de ver en el mapa
                    ->url(fn ($record) => 'https://www.google.com/maps/search/?api=1&query='.urlencode($record->name)),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->icon('heroicon-o-trash'), // Blade Heroicon para la acción de borrar en masa
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCountries::route('/'),
        ];
    }
}
