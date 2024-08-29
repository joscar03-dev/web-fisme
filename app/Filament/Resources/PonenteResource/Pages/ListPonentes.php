<?php

namespace App\Filament\Resources\PonenteResource\Pages;

use App\Filament\Resources\PonenteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPonentes extends ListRecords
{
    protected static string $resource = PonenteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
