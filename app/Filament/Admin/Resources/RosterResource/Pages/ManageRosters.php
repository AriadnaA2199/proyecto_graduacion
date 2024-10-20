<?php

namespace App\Filament\Admin\Resources\RosterResource\Pages;

use App\Filament\Admin\Resources\RosterResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageRosters extends ManageRecords
{
    protected static string $resource = RosterResource::class;

    // Habilitar la acción de crear nuevos empleados
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Agregar Nuevo Empleado'), // Personaliza la etiqueta del botón
        ];
    }
}
