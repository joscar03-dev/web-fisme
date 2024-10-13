<?php

namespace App\Filament\Resources\InscripcionConcursoResource\Pages;

use App\Filament\Resources\InscripcionConcursoResource;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EditInscripcionConcurso extends EditRecord
{
    protected static string $resource = InscripcionConcursoResource::class;

    protected function beforeSave(): void
    {
        
        if ($this->data['verificado']) {
            $this->record->fecha_verificacion = now();
            $this->record->usuario_verificacion = Auth::user()->id;
        } else {
            
            $this->record->fecha_verificacion = null;
            $this->record->usuario_verificacion = null;
        }
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
