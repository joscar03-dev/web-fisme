<?php

namespace App\Filament\Resources\LugarEventoResource\Pages;

use App\Filament\Resources\LugarEventoResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageLugarEventos extends ManageRecords
{
    protected static string $resource = LugarEventoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
