<?php

namespace App\Livewire;

use App\Models\Evento;
use App\Models\Concurso;
use Livewire\Component;

class FelicitacionRegistro extends Component
{
    public $nombreRegistro;
    public $nombreCompleto;
    public $tipo;

    public function mount($modelo, $slug, $nombre)
    {
        $this->nombreCompleto = $nombre;

        // Determina si buscar en Evento o Concurso
        if ($modelo === 'evento') {
            $registro = Evento::where('slug', $slug)->firstOrFail();
            $this->tipo = 'evento';
            $this->nombreRegistro = $registro ? $registro->nombre_evento : 'Evento no encontrado';
        } elseif ($modelo === 'concurso') {
            $registro = Concurso::where('slug', $slug)->firstOrFail();
            $this->tipo = 'concurso';
            $this->nombreRegistro = $registro ? $registro->nombre : 'Concurso no encontrado';
        } else {
            abort(404, 'Modelo no válido.');
        }

        if (!$registro) {
            abort(404, 'No se encontró el registro.');
        }

        
    }

    public function render()
    {
        return view('livewire.felicitacion-registro');
    }
}
