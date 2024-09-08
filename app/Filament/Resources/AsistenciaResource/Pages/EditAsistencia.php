<?php

namespace App\Filament\Resources\AsistenciaResource\Pages;

use App\Filament\Resources\AsistenciaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAsistencia extends EditRecord
{
    protected static string $resource = AsistenciaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
