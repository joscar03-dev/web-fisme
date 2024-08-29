<?php

namespace App\Filament\Resources\TemasResource\Pages;

use App\Filament\Resources\TemasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTemas extends ListRecords
{
    protected static string $resource = TemasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
