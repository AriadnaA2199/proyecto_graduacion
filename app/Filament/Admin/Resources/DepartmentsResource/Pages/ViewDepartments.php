<?php

namespace App\Filament\Admin\Resources\DepartmentsResource\Pages;

use App\Filament\Admin\Resources\DepartmentsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDepartments extends ViewRecord
{
    protected static string $resource = DepartmentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
