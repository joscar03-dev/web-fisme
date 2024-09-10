<?php

namespace App\Filament\Resources\PatrocinadoresResource\Pages;

use App\Filament\Resources\PatrocinadoresResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePatrocinadores extends ManageRecords
{
    protected static string $resource = PatrocinadoresResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
