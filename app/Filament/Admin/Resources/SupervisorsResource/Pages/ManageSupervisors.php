<?php

namespace App\Filament\Admin\Resources\SupervisorsResource\Pages;

use App\Filament\Admin\Resources\SupervisorsResource;
use Filament\Resources\Pages\ManageRecords;

class ManageSupervisors extends ManageRecords
{
    protected static string $resource = SupervisorsResource::class;

    // Eliminamos el botón de "Create" en el encabezado
    protected function getHeaderActions(): array
    {
        return [
            // El botón de crear queda vacío, ya no se permite crear nuevos supervisores desde aquí.
        ];
    }
}
