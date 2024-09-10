<?php

namespace App\Livewire;

use Livewire\Component;

class LectorAsistencias extends Component
{
    public $numero_documento;

    protected $rules = [
        'numero_documento' => 'required',
    ];

    public function registrarAsistencia()
    {
        $this->validate();

        // Aquí iría la lógica para registrar la asistencia en la base de datos.
        // Por ejemplo:
        // Asistencia::create(['numero_documento' => $this->numero_documento]);

        session()->flash('message', 'Asistencia registrada exitosamente.');

        // Resetea el valor después de registrar
        $this->reset('numero_documento');
    }

    
    public function render()
    {
        return view('livewire.lector-asistencias');
    }
}
