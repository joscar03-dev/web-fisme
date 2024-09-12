<?php

namespace App\Livewire;

use App\Models\Evento;
use Illuminate\Support\Carbon;
use Livewire\Component;

class HomePage extends Component
{

    public $eventos;
    public $currentIndex = 0;
    public $tipo = '';
    public $area = '';
    public $eventCount;
    public $selectedTema = null;
    public $ponentes = [];
    public $fechaInicioEvento;
    public $eventosOrdenados;
    public $eventoProximo;




    public function mount()
    {
        $this->loadEvents(); // Carga inicial de eventos
        $this->showEventos();
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
            ->get();

        $this->eventCount = $this->eventos->count(); // Contar eventos
    }

    public function showEventos()
    {
        $this->eventosOrdenados = Evento::orderBy('fecha_inicio', 'asc')->get();

        if ($this->eventosOrdenados->isNotEmpty()) {
            $this->eventoProximo = $this->eventosOrdenados->first();

            // Asegurarse de que 'fecha_inicio' sea un objeto Carbon
            if ($this->eventoProximo->fecha_inicio instanceof \Carbon\Carbon) {
                $this->fechaInicioEvento = $this->eventoProximo->fecha_inicio->toIso8601String();
            } else {
                // Si no es un objeto Carbon, intenta convertirlo manualmente
                $this->fechaInicioEvento = Carbon::parse($this->eventoProximo->fecha_inicio)->toIso8601String();
            }
        } else {
            $this->eventoProximo = null;
            $this->fechaInicioEvento = null;
        }
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

    public function setTema($temaId)
    {
        // Obtener el tema seleccionado junto con sus ponentes
        $this->selectedTema = Temas::with('ponentes')->find($temaId);
        $this->ponentes = $this->selectedTema ? $this->selectedTema->ponentes : collect(); // Asegurarse de que sea una colección
        $this->emit('tema-changed');
    }

    public function render()
    {
        return view(
            'livewire.home-page'
        );
    }
}
