<?php

namespace App\Filament\Resources\PonenteResource\Pages;

use App\Filament\Resources\PonenteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPonente extends EditRecord
{
    protected static string $resource = PonenteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
