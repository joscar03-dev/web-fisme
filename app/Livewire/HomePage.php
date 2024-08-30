<?php

namespace App\Livewire;

use App\Models\Evento;
use Livewire\Component;

class HomePage extends Component
{
    public $eventos;
    public $currentIndex = 0;
    public $tipo = '';
    public $area = '';

    public function mount()
    {
        // Cargar todos los eventos
        $this->eventos = Evento::all();
    }

    public function nextSlide()
    {
        $this->currentIndex = ($this->currentIndex + 1) % count($this->eventos);
    }

    public function prevSlide()
    {
        $this->currentIndex = ($this->currentIndex - 1 + count($this->eventos)) % count($this->eventos);
    }

    public function setSlide($index)
    {
        $this->currentIndex = $index;
    }

    public function updated($field)
    {
        $this->eventos = Evento::when($this->tipo, function ($query) {
            return $query->where('tipo_evento', $this->tipo);
        })->when($this->area, function ($query) {
            return $query->where('area_evento', $this->area);
        })->upcoming()->get();
    }

  public function render()
    {
        // Obtener todos los eventos
        $eventos = Evento::all();
        $eventCount = $eventos->count();

        // Pasar los eventos y el contador de eventos a la vista
        return view('livewire.home-page', 
        [ 'eventos' => $this->eventos,
        'eventCount' => $this->eventos->count(),]
    );
    }
}
