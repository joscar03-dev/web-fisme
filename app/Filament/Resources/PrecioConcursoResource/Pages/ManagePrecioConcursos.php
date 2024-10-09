<?php

namespace App\Filament\Resources\PrecioConcursoResource\Pages;

use App\Filament\Resources\PrecioConcursoResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePrecioConcursos extends ManageRecords
{
    protected static string $resource = PrecioConcursoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
