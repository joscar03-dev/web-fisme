<?php

namespace App\Filament\Resources\ConcursoResource\Pages;

use App\Filament\Resources\ConcursoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConcursos extends ListRecords
{
    protected static string $resource = ConcursoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
