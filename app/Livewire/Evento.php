<?php

namespace App\Livewire;

use App\Models\Evento as EventoModel; // Importa el modelo Evento correctamente
use App\Models\Temas;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Livewire\Component;

class Evento extends Component
{
    public $evento;
    public $fechas = [];
    public $temasPorFecha = [];
    public $fechaSeleccionada;
    public $temasDelDia = [];

    public function mount($id)
    {
        $this->evento = EventoModel::findOrFail($id);
        $this->generarFechas();
        $this->cargarTemas();
        $this->fechaSeleccionada = $this->fechas[0]->format('Y-m-d');
        $this->actualizarTemasDelDia();
    }

    private function generarFechas()
    {
        $periodo = CarbonPeriod::create($this->evento->fecha_inicio, $this->evento->fecha_fin);
        $this->fechas = $periodo->toArray();
    }

    private function cargarTemas()
    {
        $temas = $this->evento->temas()->orderBy('fecha')->orderBy('hora_inicio')->get();
        foreach ($temas as $tema) {
            $fecha = Carbon::parse($tema->fecha)->format('Y-m-d');
            $this->temasPorFecha[$fecha][] = $tema;
        }
    }

    public function seleccionarFecha($fecha)
    {
        $this->fechaSeleccionada = $fecha;
        $this->actualizarTemasDelDia();
    }

    private function actualizarTemasDelDia()
    {
        $this->temasDelDia = $this->temasPorFecha[$this->fechaSeleccionada] ?? [];
    }

    public function prevDate()
    {
        $currentIndex = array_search($this->fechaSeleccionada, array_column($this->fechas, 'date'));
        if ($currentIndex > 0) {
            $this->fechaSeleccionada = $this->fechas[$currentIndex - 1]->format('Y-m-d');
            $this->actualizarTemasDelDia();
        }
        $this->emit('dateChanged');
    }

    public function nextDate()
    {
        $currentIndex = array_search($this->fechaSeleccionada, array_column($this->fechas, 'date'));
        if ($currentIndex < count($this->fechas) - 1) {
            $this->fechaSeleccionada = $this->fechas[$currentIndex + 1]->format('Y-m-d');
            $this->actualizarTemasDelDia();
        }
        $this->emit('dateChanged');
    }

    public function refreshDates()
    {
        $this->actualizarTemasDelDia();
        $this->emit('dateChanged');
    }

    public function render()
    {
        return view('livewire.evento', [
            'fechas' => $this->fechas,
            'temasDelDia' => $this->temasDelDia,
        ]);
    }
}
