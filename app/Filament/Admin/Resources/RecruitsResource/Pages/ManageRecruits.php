<?php

namespace App\Filament\Admin\Resources\RecruitsResource\Pages;

use App\Filament\Admin\Resources\RecruitsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageRecruits extends ManageRecords
{
    protected static string $resource = RecruitsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
