<?php

namespace App\Filament\Admin\Resources\TrainingsResource\Pages;

use App\Filament\Admin\Resources\TrainingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTrainings extends EditRecord
{
    protected static string $resource = TrainingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
