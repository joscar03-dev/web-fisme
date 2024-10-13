<?php

namespace App\Filament\Resources\InscripcionConcursoResource\Pages;

use App\Filament\Resources\InscripcionConcursoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInscripcionConcursos extends ListRecords
{
    protected static string $resource = InscripcionConcursoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
