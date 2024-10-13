<?php

namespace App\Filament\Resources\InscripcionConcursoResource\Pages;

use App\Filament\Resources\InscripcionConcursoResource;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateInscripcionConcurso extends CreateRecord
{
    protected static string $resource = InscripcionConcursoResource::class;
    
    protected function beforeSave(): void
    {
        // Asignar siempre la fecha de registro al crear el registro
        $this->record->fecha_registro = now();

        // Verificar el estado del toggle de verificación
        if ($this->data['verificado'] ?? false) {
            // Si está marcado, asignar la fecha y el usuario logueado
            $this->record->fecha_verificacion = now();
            $this->record->usuario_verificacion = Auth::user()->name;
        } else {
            // Si no está marcado, limpiar los campos de verificación
            $this->record->fecha_verificacion = null;
            $this->record->usuario_verificacion = null;
        }
    }
}
