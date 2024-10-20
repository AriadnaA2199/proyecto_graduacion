<?php

namespace App\Filament\Admin\Resources\ProgramsResource\Pages;

use App\Filament\Admin\Resources\ProgramsResource;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManagePrograms extends ManageRecords
{
    protected static string $resource = ProgramsResource::class;

    // Asegurar que la acción de creación esté disponible en el encabezado
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Agregar Nuevo Programa'),
        ];
    }
}
