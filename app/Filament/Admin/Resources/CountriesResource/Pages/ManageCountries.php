<?php

namespace App\Filament\Admin\Resources\CountriesResource\Pages;

use App\Filament\Admin\Resources\CountriesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCountries extends ManageRecords
{
    protected static string $resource = CountriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
