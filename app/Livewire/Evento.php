<?php

namespace App\Livewire;

use App\Models\Evento as EventoModel; // Importa el modelo Evento correctamente
use App\Models\Temas;
use Livewire\Component;

class Evento extends Component
{
    public $evento;
    public $temas;
    public $eventosRelacionados;

    // El método mount recibe el ID del evento y carga los datos necesarios
    public function mount($id)
    {
        // Buscar el evento en la base de datos usando el ID proporcionado
        $this->evento = EventoModel::findOrFail($id); // Usar el modelo Evento

        // Cargar los temas relacionados con el evento, incluyendo la relación con los ponentes
        $this->temas = Temas::where('id', $this->evento->id)->with('ponente')->get();

        // Cargar eventos relacionados que tengan el mismo tipo que el evento actual
        $this->eventosRelacionados = EventoModel::where('tipo_evento', $this->evento->tipo_evento)
                                            ->where('id', '!=', $this->evento->id) // Excluir el evento actual
                                            ->take(3) // Limitar a 3 eventos relacionados
                                            ->get();
    }

    public function render()
    {
        return view(
            'livewire.evento',
            [
                'evento' => $this->evento,
                'temas' => $this->temas,
                'eventosRelacionados' => $this->eventosRelacionados,
            ]
        );
    }
}
