<?php

namespace App\Filament\Resources\LugarTuristicoResource\Pages;

use App\Filament\Resources\LugarTuristicoResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageLugarTuristicos extends ManageRecords
{
    protected static string $resource = LugarTuristicoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
