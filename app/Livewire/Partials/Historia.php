<?php

namespace App\Livewire\Partials;

use App\Models\Evento;
use Carbon\Carbon;
use Livewire\Component;

class Historia extends Component
{
    public $eventos;
    public $currentIndex = 0;
    public $tipo = '';
    public $area = '';
    public $eventCount;
    public $selectedTema = null;
    public $ponentes = [];

    public function mount()
    {
        $this->loadEvents(); // Carga inicial de eventos
    }

    public function loadEvents()
    {
        // Cargar eventos con temas y ponentes, aplicando filtros si es necesario
        $this->eventos = Evento::with(['temas', 'temas.ponentes'])
            ->when($this->tipo, function ($query) {
                return $query->where('tipo_evento', $this->tipo);
            })
            ->when($this->area, function ($query) {
                return $query->where('area_evento', $this->area);
            })
            ->upcoming()
            ->take(3) // Limitar a 3 eventos
            ->get()
            ->map(function ($evento) {
                // Formatear la fecha de inicio
                $evento->fecha_inicio = $evento->fecha_inicio ? Carbon::parse($evento->fecha_inicio)->format('d M Y') : null;
                return $evento->toArray(); // Convertir a array
            });

        $this->eventCount = $this->eventos->count(); // Contar eventos
    }

    public function nextSlide()
    {
        if ($this->eventCount > 0) {
            // Avanzar al siguiente evento
            $this->currentIndex = ($this->currentIndex + 1) % $this->eventCount;
            $this->emit('slide-changed');
        }
    }

    public function prevSlide()
    {
        if ($this->eventCount > 0) {
            // Retroceder al evento anterior
            $this->currentIndex = ($this->currentIndex - 1 + $this->eventCount) % $this->eventCount;
            $this->emit('slide-changed');
        }
    }

    
    public function render()
    {
        return view('livewire.partials.historia');
    }
}
