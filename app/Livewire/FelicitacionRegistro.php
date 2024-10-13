<?php

namespace App\Livewire;

use Livewire\Component;

class FelicitacionRegistro extends Component
{
    public $nombreEvento;
    public $nombreCompleto;

    public function mount($evento, $nombre)
    {
        $this->nombreEvento = $evento;
        $this->nombreCompleto = $nombre;
    }
    public function render()
    {
        return view('livewire.felicitacion-registro');
    }
}
