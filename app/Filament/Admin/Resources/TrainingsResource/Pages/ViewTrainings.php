<?php

namespace App\Filament\Admin\Resources\TrainingsResource\Pages;

use App\Filament\Admin\Resources\TrainingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTrainings extends ViewRecord
{
    protected static string $resource = TrainingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
