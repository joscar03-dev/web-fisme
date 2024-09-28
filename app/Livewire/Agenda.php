<?php

namespace App\Livewire;

use App\Models\Evento;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class Agenda extends Component
{
    public $events = [];
    public $currentMonth;
    public $currentYear;
    public $calendar;
    public $upcomingEvents;
    public $vista = 'mes';

    public function mount()
    {
        $this->currentYear = now()->year;
        $this->currentMonth = now()->month;
        $this->loadEvents();
        $this->loadUpcomingEvents();
    }

    public function loadEvents()
    {
        $startOfMonth = Carbon::create($this->currentYear, $this->currentMonth, 1)->startOfDay();
        $endOfMonth = $startOfMonth->copy()->endOfMonth()->endOfDay();

        $this->events = Evento::whereBetween('fecha_inicio', [$startOfMonth, $endOfMonth])
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->nombre_evento,
                    'start' => $event->fecha_inicio->toDateTimeString(),
                    'end' => $event->fecha_fin->toDateTimeString(),
                    'color' => $this->getEventColor($event->tipo_evento),
                ];
            })
            ->toArray();

        $this->generateCalendar();
    }

    public function loadUpcomingEvents()
    {
        $this->upcomingEvents = Evento::where('fecha_inicio', '>=', now())
            ->orderBy('fecha_inicio')
            ->take(5)
            ->get();
    }

    public function generateCalendar()
    {
        $startOfMonth = Carbon::create($this->currentYear, $this->currentMonth, 1)->startOfWeek();
        $endOfMonth = Carbon::create($this->currentYear, $this->currentMonth, 1)->endOfMonth()->endOfWeek();

        $calendar = collect();
        $currentDate = $startOfMonth->copy();

        while ($currentDate <= $endOfMonth) {
            $week = collect();
            for ($i = 0; $i < 7; $i++) {
                $date = $currentDate->copy();
                $week->push([
                    'date' => $date,
                    'events' => $this->getEventsForDate($date),
                    'has_events' => $this->hasEventsForDate($date),
                ]);
                $currentDate->addDay();
            }
            $calendar->push($week);
        }

        $this->calendar = $calendar;
    }

    private function getEventsForDate($date)
    {
        return collect($this->events)->filter(function ($event) use ($date) {
            $start = Carbon::parse($event['start']);
            $end = Carbon::parse($event['end']);
            return $date->between($start->startOfDay(), $end->endOfDay());
        })->values()->all();
    }

    private function hasEventsForDate($date)
    {
        return !empty($this->getEventsForDate($date));
    }

    public function mesAnterior()
    {
        $this->currentMonth--;
        if ($this->currentMonth < 1) {
            $this->currentMonth = 12;
            $this->currentYear--;
        }
        $this->loadEvents();
    }
    
    public function mesSiguiente()
    {
        $this->currentMonth++;
        if ($this->currentMonth > 12) {
            $this->currentMonth = 1;
            $this->currentYear++;
        }
        $this->loadEvents();
    }

    public function irAHoy()
    {
        $this->currentYear = now()->year;
        $this->currentMonth = now()->month;
        $this->loadEvents();
    }

    public function cambiarVista($vista)
    {
        $this->vista = $vista;
    }

    public function refreshEvents()
    {
        $this->loadEvents();
        $this->emit('refreshCalendar');
    }

    public function registerForEvent($eventId)
    {
        // Implementa tu lógica de registro aquí
        session()->flash('message', 'Te has registrado exitosamente para el evento.');
    }

    private function getEventColor($tipoEvento)
    {
        // Implementa tu lógica de colores aquí
        $colores = [
            'conferencia' => 'bg-blue-500',
            'Congreso' => 'bg-green-500',
            'seminario' => 'bg-yellow-500',
            'otro' => 'bg-purple-500',
        ];

        return $colores[$tipoEvento] ?? 'bg-gray-500';
    }
    
    public function render()
    {
        return view('livewire.agenda');
    }
}
