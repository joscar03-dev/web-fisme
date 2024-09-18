<?php

namespace App\Filament\Resources\TematicaResource\Pages;

use App\Filament\Resources\TematicaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTematicas extends ManageRecords
{
    protected static string $resource = TematicaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
