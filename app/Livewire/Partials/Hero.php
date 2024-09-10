<?php

namespace App\Livewire\Partials;

use App\Models\Evento;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Hero extends Component
{  public $eventos;
    public $currentIndex = 0;
    public $tipo = '';
    public $area = '';
    public $eventCount;
    public $selectedTema = null;
    public $ponentes = [];

  

    public function loadEvents()
    {
        $this->eventos = Evento::with(['temas', 'temas.ponentes'])
            ->when($this->tipo, function ($query) {
                return $query->where('tipo_evento', $this->tipo);
            })
            ->when($this->area, function ($query) {
                return $query->where('area_evento', $this->area);
            })
            ->upcoming()
            ->get();

        $this->eventCount = $this->eventos->count();
    }

    public function nextSlide()
    {
        $this->currentIndex = ($this->currentIndex + 1) % $this->eventCount;
        $this->emit('slide-changed');
    }
    
    public function prevSlide()
    {
        $this->currentIndex = ($this->currentIndex - 1 + $this->eventCount) % $this->eventCount;
        $this->emit('slide-changed');
    }
  


    public function mount()
    {
        $this->eventos = Evento::upcoming()->take(3)->get()->map(function ($evento) {
            $evento->fecha_inicio = $evento->fecha_inicio ? Carbon::parse($evento->fecha_inicio) : null;
            return $evento;
        });
    }
    public function render()
    {
        return view('livewire.partials.hero');
    }
}
