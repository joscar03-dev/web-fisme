<?php

namespace App\Filament\Resources\OrganizadoresResource\Pages;

use App\Filament\Resources\OrganizadoresResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrganizadores extends EditRecord
{
    protected static string $resource = OrganizadoresResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
