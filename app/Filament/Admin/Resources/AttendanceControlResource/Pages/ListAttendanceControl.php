<?php

namespace App\Filament\Admin\Resources\AttendanceControlResource\Pages;

use App\Filament\Admin\Resources\AttendanceControlResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAttendanceControl extends ListRecords
{
    protected static string $resource = AttendanceControlResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Agregar Asistencia'),
        ];
    }
}
