<?php

namespace App\Filament\Resources\OrganizadoresResource\Pages;

use App\Filament\Resources\OrganizadoresResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrganizadores extends ListRecords
{
    protected static string $resource = OrganizadoresResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
