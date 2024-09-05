<?php

namespace App\Filament\Resources\ResgistroResource\Pages;

use App\Filament\Resources\ResgistroResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageResgistros extends ManageRecords
{
    protected static string $resource = ResgistroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
