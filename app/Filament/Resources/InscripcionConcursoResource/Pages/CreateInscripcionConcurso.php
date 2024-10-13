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
        
        $this->record->fecha_registro = now();

      
        if ($this->data['verificado'] ?? false) {
           
            $this->record->fecha_verificacion = now();
            $this->record->usuario_verificacion = Auth::user()->name;
        } else {
            
            $this->record->fecha_verificacion = null;
            $this->record->usuario_verificacion = null;
        }
    }
}
