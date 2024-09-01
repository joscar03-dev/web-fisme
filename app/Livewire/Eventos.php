<?php

namespace App\Livewire;

use App\Models\Evento;
use Livewire\Component;

class Eventos extends Component
{

    public function render()
    {
        $eventos = Evento::upcoming()->paginate(8); // Cargar solo los próximos eventos paginados

        return view('livewire.eventos', compact('eventos'));
    }
}
